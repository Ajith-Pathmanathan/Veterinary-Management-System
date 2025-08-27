<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentCreatedMail;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Notification;
use App\Models\Pet;
use App\Models\User;
use App\Models\Veterinarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 2) {
            $appointments = Appointment::where('user_id',Auth::user()->id)->get();
            return view('layouts.appointments.index', compact('appointments'));
        }

        else{
            $appointments = Appointment::all();

            return view('layouts.appointments.index', compact('appointments'));
        }
    }

    public function create()
    {
        $hospitals = Hospital::all();
        $doctors = Veterinarian::all();
        $pets = Pet::whereHas('farm', function ($query) {
            $query->where('user_id', auth()->id());
        })->select('id', 'pet_id')->get();
        return view('layouts.appointments.create', compact('hospitals', 'doctors', 'pets'));
    }

    public function store(Request $request)
    {
//        dd($request);

        $validated = $request->validate([
            'appointment_time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:08:00',
                'before_or_equal:16:00',
            ],
            'date' => 'required|date|after:today',
            'reason' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'hospital_id' => 'required|exists:hospitals,id',
        ], [
            'appointment_time.required' => 'Appointment time is required.',
            'appointment_time.date_format' => 'Appointment time must be in the format HH:MM.',
            'appointment_time.after_or_equal' => 'Appointments must start at or after 08:00 AM.',
            'appointment_time.before_or_equal' => 'Appointments must end by 04:00 PM.',
            'date.required' => 'Appointment date is required.',
            'date.date' => 'Invalid date format.',
            'date.after' => 'Appointments must be booked at least a day in advance.',
            'reason.required' => 'Reason is required.',
            'user_id.required' => 'User is required.',
            'user_id.exists' => 'Selected user does not exist.',
            'pet_id.required' => 'Pet is required.',
            'pet_id.exists' => 'Selected pet does not exist.',
            'hospital_id.required' => 'Hospital is required.',
            'hospital_id.exists' => 'Selected hospital does not exist.',
        ]);


        $validated['is_cancelled'] = false;
        $validated['viewed'] = false;


       $appointment = Appointment::create($validated);
        Notification::create([
            'doctor_id' => null,
            'user_id' => $request->user_id,
            'appointment_time' => $request->date,
            'discription' => $request->reason,
            'viewed' => false,
        ]);
        $user = User::find($request->user_id);
//        Mail::to($user->email)->send(new AppointmentCreatedMail($appointment));
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');

//        if (Auth::user()->role_id !== 2) {
//        }
//        else {
//            return redirect()->route('dashboard')->with('success', 'Appointment created successfully.');
//
//    }
    }

    public function show(Appointment $appointment)
    {
//        if (Auth::user()->role_id == 2) {
//            abort(403, 'Unauthorized action.');
//        }
        $appointment->load('pet');
        return view('layouts.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $hospitals = Hospital::all();
        $doctors = Veterinarian::all();
        $pets = Pet::all();
        return view('layouts.appointments.edit', compact('appointment', 'hospitals', 'doctors', 'pets'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'appointment_time' => 'required',
            'date' => 'required|date',
            'reason' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $appointment->delete();
        return back()->with('success', 'Appointment deleted successfully.');
    }
    public function getAppointmentById(){
        $appointments = Appointment::where('user_id',Auth::user()->role_id);
    }
}
