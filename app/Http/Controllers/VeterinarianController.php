<?php

namespace App\Http\Controllers;

use App\Models\Veterinarian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VeterinarianController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $query = Veterinarian::with('user');

        // Apply filters if provided
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('occupation')) {
            $query->where('occupation', 'like', '%' . $request->occupation . '%');
        }

        $veterinarians = $query->paginate(10); // Pagination

        return view('layouts.veterinarian.index', compact('veterinarians'));
    }


    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::all();
        return view('layouts.veterinarian.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'education' => 'required|string|max:255',
            'experience' => 'required|integer',
            'education_certificate' => 'nullable|file|mimes:jpg,png,pdf',
            'NIC_copy'=>  'nullable|file|mimes:jpg,png,pdf',
            'profile_picture'=>  'nullable|file|mimes:jpg,png,pdf',
            'occupation' => 'required'
        ]);

        if ($request->hasFile('education_certificate')) {
            $validatedData['education_certificate'] = $request->file('education_certificate')->store('certificates');
        }
        if ($request->hasFile('NIC_copy')) {
            $validatedData['NIC_copy'] = $request->file('NIC_copy')->store('certificates');
        }
        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('certificates');
        }

        Veterinarian::create($validatedData);
        return redirect()->route('users.index');
    }

    public function show(Veterinarian $veterinarian)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        return view('layouts.veterinarian.show', compact('veterinarian'));
    }

    public function edit(Veterinarian $veterinarian)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::all();
        return view('layouts.veterinarian.edit', compact('veterinarian', 'users'));
    }

    public function update(Request $request, Veterinarian $veterinarian)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'education' => 'required|string|max:255',
            'experience' => 'required|integer',
            'education_certificate' => 'nullable|file|mimes:jpg,png,pdf',
            'NIC_copy'=>  'nullable|file|mimes:jpg,png,pdf',
            'profile_picture'=>  'nullable|file|mimes:jpg,png,pdf',
            'occupation' => 'required'

        ]);

        if ($request->hasFile('education_certificate')) {
            $validatedData['education_certificate'] = $request->file('education_certificate')->store('certificates');
        }
        if ($request->hasFile('NIC_copy')) {
            $validatedData['NIC_copy'] = $request->file('NIC_copy')->store('certificates');
        }
        if ($request->hasFile('profile_picture')) {
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('certificates');
        }

        $veterinarian->update($validatedData);
        return redirect()->route('users.index');
    }

    public function destroy(Veterinarian $veterinarian)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $veterinarian->delete();
        return redirect()->route('users.index');
    }
}
