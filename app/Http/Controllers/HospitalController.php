<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{

    public function index()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $hospitals = Hospital::all();
        return view('layouts.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.hospitals.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'district'        => 'required|string|max:255',
            'address'         => 'required|string|max:500',
            'contact_number'  => ['required', 'string', 'max:20', 'regex:/^(\+94|0)?7\d{8}$/'],
            'email_address'   => 'required|email|max:255',
        ], [
            'name.required'           => 'Name is required.',
            'district.required'       => 'District is required.',
            'address.required'        => 'Address is required.',
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex'    => 'Contact number must be a valid Sri Lankan mobile number.',
            'email_address.required'  => 'Email address is required.',
            'email_address.email'     => 'Please enter a valid email address.',
        ]);


        Hospital::create($validated);

        return redirect()->route('hospitals.index')->with('success', 'Hospital created successfully.');
    }

    public function show($id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $hospital = Hospital::findOrFail($id);
        return view('layouts.hospitals.show', compact('hospital'));
    }

    public function edit($id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $hospital = Hospital::findOrFail($id);
        return view('layouts.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'district'        => 'required|string|max:255',
            'address'         => 'required|string|max:500',
            'contact_number'  => ['required', 'string', 'max:20', 'regex:/^(\+94|0)?7\d{8}$/'],
            'email_address'   => 'required|email|max:255',
        ], [
            'name.required'           => 'Name is required.',
            'district.required'       => 'District is required.',
            'address.required'        => 'Address is required.',
            'contact_number.required' => 'Contact number is required.',
            'contact_number.regex'    => 'Contact number must be a valid Sri Lankan mobile number.',
            'email_address.required'  => 'Email address is required.',
            'email_address.email'     => 'Please enter a valid email address.',
        ]);


        $hospital = Hospital::findOrFail($id);
        $hospital->update($validated);

        return redirect()->route('hospitals.index')->with('success', 'Hospital Updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $hospital = Hospital::findOrFail($id);
        $hospital->delete();

        return redirect()->route('hospitals.index')->with('success', 'Hospital Deleted successfully.');
    }
}
