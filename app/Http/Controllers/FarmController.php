<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Farm_owner_history;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import the Farm model

class FarmController extends Controller
{

    public function index(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $query = Farm::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->join('users', 'users.id', '=', 'farms.user_id')
                ->where('users.national_id', 'LIKE', "%{$search}%")
                ->orWhere('users.first_name', 'LIKE', "%{$search}%")
                ->select('farms.*', 'users.national_id'); // Ensure you select the main table columns

        }

        $farms = $query->paginate(10); // Adjust pagination size if needed.
        $totalFarms = Farm::count();
        return view('layouts.farms.index', compact('farms', 'totalFarms'));
    }


    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.farms.create');

    }


    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|numeric',
            'type' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'national_id' => 'required|string|exists:users,national_id',
        ]);

        $user = User::where('national_id', $validated['national_id'])->first();

        Farm::create([
            'name' => $validated['name'],
            'user_id' => $user->id,
            'size' => $validated['size'],
            'type' => $validated['type'],
            'street' => $validated['street'],
            'city' => $validated['city'],
            'district' => $validated['district'],
        ]);


        return redirect()->route('farms.index')->with('success', 'Farm created successfully.');
    }

    public function checkNIC(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $exists = User::where('national_id', $request->national_id)->exists();
        return response()->json(['exists' => $exists]);
    }


    public function show(string $id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $ownerHistories = Farm_owner_history::where('farm_id', $id)->get();
        $farm = Farm::with('pets')->findOrFail($id);
        $totalCows = $farm->pets()->where('type', 'cow')->count();
        $totalGoats = $farm->pets()->where('type', 'goat')->count();
        $totalOthers = $farm->pets()->where('type', 'other')->count();
        $cows = $farm->pets()->where('type', 'cow')->get();
        $goats = $farm->pets()->where('type', 'goat')->get();
        $others = $farm->pets()->where('type', 'others')->get();


        return view('layouts.farms.show', compact('farm', 'totalCows', 'totalGoats', 'totalOthers', 'cows', 'goats', 'others', 'ownerHistories'));

    }


    public function edit(string $id)
    {
        $farm = Farm::findOrFail($id); // Retrieve farm by ID

        return view('layouts.farms.edit', compact('farm'));

    }


    public function update(Request $request, string $id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'size' => 'required|numeric',
            'type' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'national_id' => 'required|string|exists:users,national_id',
        ]);

        $user = User::where('national_id', $validated['national_id'])->first();

        $farm = Farm::findOrFail($id);
        $olduser = $farm->user_id;

        $farm->update([
            'name' => $validated['name'],
            'user_id' => $user->id,
            'size' => $validated['size'],
            'type' => $validated['type'],
            'street' => $validated['street'],
            'city' => $validated['city'],
            'district' => $validated['district'],
        ]);
        if ($user->id != $olduser) {
            Farm_owner_history::create([
                'user_id' => $farm->user_id,
                'farm_id' => $farm->id,
                'from_date' => $farm->created_at,
                'to_date' => now()
            ]);
        }
        return redirect()->route('farms.show', $farm->id)->with('success', 'farms Updated successfully.');


    }


    public function destroy(string $id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $farm = Farm::findOrFail($id);
        $farm->delete();

        return redirect()->route('farms.index')->with('success', 'farms deleted successfully.');
    }

    public function exportPdf()
    {
        $farms = \App\Models\Farm::with('user')->get(); // load user (owner)

        $pdf = Pdf::loadView('layouts.pdf.farm-report', compact('farms'));
        return $pdf->download('farm_report.pdf');
    }

}
