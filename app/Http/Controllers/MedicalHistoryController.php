<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\Pet;
use App\Models\Doctor;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalHistoryController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $medicalHistories = MedicalHistory::with([
            'pet',
            'user',

        ])->get();
        return view('layouts.medical_histories.index', compact('medicalHistories'));
    }

    public function create()
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $pets = Pet::all();
        $doctors = Veterinarian::where('occupation', 'doctor')->get();
        return view('layouts.medical_histories.create', compact('pets', 'doctors'));
    }

    public function store(Request $request){
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }

        $veterinarianId = Auth::user()->id;

        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'details' => 'required|string',
            'medicines' => 'required|string',
        ]);


        $request->merge(['doctor_id' => $veterinarianId]);

        MedicalHistory::create($request->all());
        return redirect()->route('medical_histories.index')->with('success', 'Medical history added successfully.');
    }

    public function show(MedicalHistory $medicalHistory)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $medicalHistory->load(['user']);
        return view('layouts.medical_histories.show', compact('medicalHistory'));
    }

    public function edit(MedicalHistory $medicalHistory)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $pets = Pet::all();
        $doctors = Veterinarian::all();
        return view('layouts.medical_histories.edit', compact('medicalHistory', 'pets', 'doctors'));
    }

    public function update(Request $request, MedicalHistory $medicalHistory)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $veterinarianId = Auth::user()->id;

        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'details' => 'required|string',
            'medicines' => 'required|string',
        ]);


        $request->merge(['doctor_id' => $veterinarianId]);

        $medicalHistory->update($request->all());
        return redirect()->route('medical_histories.index')->with('success', 'Medical history updated successfully.');
    }

    public function destroy(MedicalHistory $medicalHistory)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $medicalHistory->delete();
        return redirect()->route('medical_histories.index')->with('success', 'Medical history deleted successfully.');
    }
}

