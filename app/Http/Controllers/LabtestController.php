<?php

namespace App\Http\Controllers;

use App\Models\Labtest;
use App\Models\Pet;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\LabTestResultMail;

class LabtestController extends Controller
{

    public function index()
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $labtests = Labtest::with('pet')->get();
       return view('layouts.labtests.index', compact('labtests'));
    }


    public function create()
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $pets = Pet::all();
        return view('layouts.labtests.create', compact('pets'));
    }


    public function store(Request $request)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $validatedData = $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'test_type' => 'required|string',
            'test_details' => 'required|array',
        ]);
        $pet = Pet::findOrFail($request->pet_id);
        $id = $pet->pet_id;

        $pdf = Pdf::loadView('layouts.pdf.labtest', [
            'pet_id' => $id,
            'test_type' => $request->test_type,
            'test_details' => $request->test_details,
        ]);

        $filename = 'test_detail_' . time() . '.pdf';
        $validatedData['test_details'] = 'test_details/' . $filename;
        Storage::put($validatedData['test_details'], $pdf->output());


        // Save lab test with pdf path
        $labtest = Labtest::create([
            'pet_id' => $request->pet_id,
            'test_type' => $request->test_type,
            'test_detail' => $filename,
        ]);
        // Fetch related data for email using Eloquent relationships
        $data = Labtest::with('pet.farm.user')->findOrFail($labtest->id);

        // Send email if user email exists
        if ($data->pet && $data->pet->farm && $data->pet->farm->user && $data->pet->farm->user->email) {
            try {
                Mail::to($data->pet->farm->user->email)->send(new LabTestResultMail($data));
            } catch (\Exception $e) {
                \Log::error('Email sending failed: ' . $e->getMessage());
            }
        }
        return redirect()->route('labtests.index')->with('success', 'Lab test created successfully.');
    }


    public function show(string $id)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $labtest = Labtest::findorfail($id);
        return view('layouts.labtests.show', compact('labtest'));
    }


    public function edit(string $id)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $labtest = Labtest::findorfail($id);
        $pets = Pet::all();

        return view('layouts.labtests.edit', compact('labtest', 'pets'));
    }


    public function update(Request $request, string $id)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'test_type' => 'required|string',
            'test_details' => 'required|array',
        ]);

        $testDetails = $request->input('test_details');

        // Regenerate the PDF
        $pdf = Pdf::loadView('layouts.pdf.labtest', [
            'pet_id' => $request->pet_id,
            'test_type' => $request->test_type,
            'test_details' => $testDetails,
        ]);
        $filename = 'test_detail_' . time() . '.pdf';
        $validatedData['test_details'] = 'test_details/' . $filename;
        Storage::put($validatedData['test_details'], $pdf->output());
        // Update Labtest
        $labtest = Labtest::findOrFail($id);
        $labtest->update([
            'pet_id' => $request->pet_id,
            'test_type' => $request->test_type,
            'test_detail' => $filename,
        ]);

        return redirect()->route('labtests.index')->with('success', 'Lab test updated successfully.');
    }


    public function destroy(string $id)
    {
        if (Auth::user()->role_id == 2) {
            abort(403, 'Unauthorized action.');
        }
        $labtest = Labtest::findOrFail($id);
        $labtest->delete();
        return redirect()->route('labtests.index')->with('success', 'Lab test deleted successfully.');
    }
}
