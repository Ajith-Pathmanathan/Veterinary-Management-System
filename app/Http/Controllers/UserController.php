<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf; // Make sure this is at the top

use App\Mail\UserRegisteredMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('national_id')) {
            $query->where('national_id', 'like', '%' . $request->national_id . '%');
        }

        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->role . '%');
            });
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return view('layouts.users.index', compact('users', 'roles'));
    }


    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        return view('layouts.users.create', compact('roles'));
    }


    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'national_id'   => ['required', 'string', 'unique:users,national_id', 'regex:/^(\d{9}[vV]|\d{12})$/'],
            'phone_number'  => ['required', 'regex:/^(\+94|0)?7[0-9]{8}$/'],
            'date_of_birth' => ['required', 'date', 'before:' . now()->subYears(18)->format('Y-m-d')],
            'role_id'       => 'required|exists:roles,id',
        ], [
            'email.unique'            => 'Email already exists',
            'national_id.unique'      => 'NIC Number already exists',
            'national_id.regex'       => 'NIC format is invalid (e.g., 123456789V or 200012345678)',
            'phone_number.regex'      => 'Phone number must be a valid Sri Lankan number (e.g., 0712345678 or +94712345678)',
            'date_of_birth.before'    => 'You must be at least 18 years old.',
        ]);


        $password = Str::random(8);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'national_id' => $request->national_id,
            'street' => $request->street,
            'city' => $request->city,
            'district' => $request->district,
            'role_id' => $request->role_id,
        ]);

        Mail::to($user->email)->send(new UserRegisteredMail($user, $password));
        if ($user->role->name == 'Doctor') {
            return redirect()->route('veterinarians.create', ['user' => $user->id])
                ->with('success', 'User created successfully.');
        } else {
            return redirect()->route('users.index')
                ->with('success', 'User created successfully.');
        }


    }



    public function show(User $user)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $user->load('role', 'veterinarian');
        return view('layouts.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        return view('layouts.users.edit', compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'national_id'   => ['required', 'string', 'unique:users,national_id', 'regex:/^(\d{9}[vV]|\d{12})$/'],
            'phone_number'  => ['required', 'regex:/^(\+94|0)?7[0-9]{8}$/'],
            'date_of_birth' => ['required', 'date', 'before:' . now()->subYears(18)->format('Y-m-d')],
            'role_id'       => 'required|exists:roles,id',
        ], [
            'email.unique'            => 'Email already exists',
            'national_id.unique'      => 'NIC Number already exists',
            'national_id.regex'       => 'NIC format is invalid (e.g., 123456789V or 200012345678)',
            'phone_number.regex'      => 'Phone number must be a valid Sri Lankan number (e.g., 0712345678 or +94712345678)',
            'date_of_birth.before'    => 'You must be at least 18 years old.',
        ]);


        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_of_birth' => $request->date_of_birth,
            'phone_number' => $request->phone_number,
            'national_id' => $request->national_id,
            'street' => $request->street,
            'city' => $request->city,
            'district' => $request->district,
            'role_id' => $request->role_id,
        ]);
        $user->load('veterinarian');
        if ($user->role->name == 'Doctor') {
            return redirect()->route('veterinarians.edit', $user->veterinarian->id)
                ->with('success', 'User updated successfully.');
        } else {
            return redirect()->route('users.index')
                ->with('success', 'User updated successfully.');
        }

    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function exportPdf()
    {
        $users = User::with('role')->get(); // eager load role

        $pdf = Pdf::loadView('layouts.pdf.user-report', compact('users'));
        return $pdf->download('user_report.pdf');
    }

}
