<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VaccineController extends Controller
{




    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate(['name' => 'required|string|max:255']);
        Vaccine::create($request->all());
        return back()->with('success', 'Vaccine created successfully.');
    }




    public function update(Request $request, Vaccine $vaccine)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate(['name' => 'required|string|max:255']);
        $vaccine->update($request->all());
        return back()->with('success', 'Vaccine updated successfully.');
    }

    public function destroy(Vaccine $vaccine)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $vaccine->delete();
        return back()->with('success', 'Vaccine deleted successfully.');
    }
}
