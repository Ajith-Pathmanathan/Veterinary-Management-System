<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $vaccines = vaccine::all();
        $vaccineName = $request->input('vaccine_name'); // Get filter for vaccine name
        $ownerNic = $request->input('owner_nic');       // Get filter for owner NIC

        $vaccinations = Vaccination::with(['vaccine', 'pet.farm.user'])
            ->whereHas('vaccine', function ($query) use ($vaccineName) {
                if (!empty($vaccineName)) {
                    $query->where('name', 'like', '%' . $vaccineName . '%');
                }
            })
            ->whereHas('pet.farm.user', function ($query) use ($ownerNic) {
                if (!empty($ownerNic)) {
                    $query->where('national_id', 'like', '%' . $ownerNic . '%');
                }
            })
            ->paginate(10); // Adjust the number as needed for items per page

        return view('layouts.vaccination.index', compact('vaccinations','vaccines'));
    }


    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $vaccines = Vaccine::all();

        return view('layouts.vaccination.create',compact('vaccines'));
    }

    public function store(Request $request)

    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'pet_id' => 'required|exists:pets,pet_id',
            'vaccination_date' => 'required|date',
            'vaccine_id' => 'required|exists:vaccines,id',
            'dose' => 'required|integer'
        ]);
        $pet = Pet::where('pet_id', $request->pet_id)->first();
        $request->merge(['pet_id' => $pet->id]);
        Vaccination::create($request->all());
        return redirect()->route('vaccinations.index')->with('success', 'Vaccination record created successfully');
    }

    public function show($id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $vaccination = Vaccination::with('pet','vaccine')->findOrFail($id);

        return view('layouts.vaccination.show', compact('vaccination'));
    }


    public function edit(Vaccination $vaccination)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $vaccines =  Vaccine::all();
        return view('layouts.vaccination.edit', compact('vaccines','vaccination'));
    }

    public function update(Request $request, Vaccination $vaccination)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'pet_id' => 'required|exists:pets,pet_id',
            'vaccination_date' => 'required|date',
            'vaccine_id' => 'required|exists:vaccines,id',
            'dose' => 'required|integer'
        ]);
        $pet = Pet::where('pet_id', $request->pet_id)->first();
        $request->merge(['pet_id' => $pet->id]);
        $vaccination->update($request->all());
        return redirect()->route('vaccinations.index')->with('success', 'Vaccination record updated successfully');
    }

    public function destroy(Vaccination $vaccination)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $vaccination->delete();
        return redirect()->route('vaccinations.index')->with('success', 'Vaccination record deleted successfully');
    }
}
