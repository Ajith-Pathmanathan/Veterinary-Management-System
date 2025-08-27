<?php


namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Labtest;
use App\Models\MedicalHistory;
use App\Models\Owner_history;
use App\Models\Pet;
use App\Models\vaccination;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $query = Pet::query();

        if ($request->has('id') && !empty($request->id)) {
            $query->where('pet_id', $request->id);
        }

        $pets = $query->paginate(10);

        return view('layouts.pet.index', compact('pets'));
    }

    public function getPetsByUserId()
    {
        if (Auth::user()->role_id !== 2) {
            abort(403, 'Unauthorized action.');
        }

        // Get the farm IDs associated with the user
        $farmIds = Farm::where('user_id', Auth::user()->id)->pluck('id');

        // Fetch pets that belong to those farms
        $pets = Pet::whereIn('farm_id', $farmIds)->paginate(10);

        return view('layouts.pet.index', compact('pets'));
    }



    public function create()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $farms = Farm::all();
        return view('layouts.pet.create', compact('farms'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $validated = $request->validate([
            'type' => 'required|string',
            'breed' => 'required|string',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:male,female',
            'farm_id' => 'required|exists:farms,id',
            'color' => 'required|string',
        ], [
            'type.required' => 'The animal type is required.',
            'type.string' => 'The animal type must be a valid string.',

            'breed.required' => 'The breed is required.',
            'breed.string' => 'The breed must be a valid string.',

            'date_of_birth.required' => 'The date of birth is required.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
            'date_of_birth.before_or_equal' => 'The date of birth must be today or a past date.',

            'gender.required' => 'The gender is required.',
            'gender.in' => 'The gender must be either male or female.',

            'farm_id.required' => 'The farm is required.',
            'farm_id.exists' => 'The selected farm does not exist.',

            'color.required' => 'The color is required.',
            'color.string' => 'The color must be a valid string.',
        ]);


        $registrationYear = date('Y');
        $farm = Farm::findOrFail($request->farm_id);
        $petId = $this->generatePetId($request->type, $farm->district, $registrationYear);

        Pet::create([
            'pet_id' => $petId,
            'type' => $request->type,
            'breed' => $request->breed,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'farm_id' => $request->farm_id,
            'color' => $request->color
        ]);

        return redirect()->route('pets.index')->with('success', 'Pet created successfully');
    }

    private function generatePetId($type, $district, $registrationYear)
    {
        $typeCode = [
            'cow' => 'C',
            'goat' => 'G',
            'other' => 'O'
        ];

        $districtCode = [
            'jaffna' => 'J',
            'kilinochchi' => 'K',
            'mannar' => 'M',
            'mullaitivu' => 'Mu',
            'vavuniya' => 'V'
        ];

        // Convert inputs to lowercase for consistency
        $type = strtolower($type);
        $district = strtolower($district);

        // Get mapped codes, default to 'X' if district/type is unknown
        $typePrefix = $typeCode[$type] ?? 'X';
        $districtPrefix = $districtCode[$district] ?? 'X';

        // Extract last two digits of the registration year
        $yearCode = substr($registrationYear, -2);

        // Build the prefix for filtering pets (e.g., CJ22)
        $idPrefix = "{$typePrefix}{$districtPrefix}{$yearCode}";

        // Retrieve the highest pet_id matching the prefix
        $lastPet = Pet::where('pet_id', 'LIKE', "{$idPrefix}%")
            ->orderByRaw("CAST(SUBSTRING(pet_id, LENGTH('{$idPrefix}') + 1) AS UNSIGNED) DESC")
            ->first();

        // Extract last sequence number and increment
        if ($lastPet) {
            $lastNumber = intval(substr($lastPet->pet_id, strlen($idPrefix)));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Format the next number to 4 digits (e.g., 0001, 0002)
        $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return "{$idPrefix}{$formattedNumber}";
    }


    public function show(Pet $pet)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $ownerHistories = Owner_history::where('pet_id', $pet->id)->with('farm.user')->get();
        $medicalHistory = MedicalHistory::where('pet_id', $pet->id)->get();
        $vaccinations = Vaccination::where('pet_id', $pet->id)->with('vaccine')->get();
        $labtests = Labtest::where('pet_id', $pet->id)->get();

        return view('layouts.pet.show', compact('pet', 'medicalHistory', 'vaccinations', 'labtests', 'ownerHistories'));
    }


    public function edit(Pet $pet)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $farms = Farm::all();
        return view('layouts.pet.edit', compact('pet', 'farms'));
    }

    public function update(Request $request, Pet $pet)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $oldfarmid = $pet->farm_id;
        $oldupdatedaat = $pet->updated_at;


        $validated = $request->validate([
            'type' => 'required|string',
            'breed' => 'required|string',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'gender' => 'required|in:male,female',
            'farm_id' => 'required|exists:farms,id',
            'color' => 'required|string',
        ], [
            'type.required' => 'The animal type is required.',
            'type.string' => 'The animal type must be a valid string.',

            'breed.required' => 'The breed is required.',
            'breed.string' => 'The breed must be a valid string.',

            'date_of_birth.required' => 'The date of birth is required.',
            'date_of_birth.date' => 'The date of birth must be a valid date.',
            'date_of_birth.before_or_equal' => 'The date of birth must be today or a past date.',

            'gender.required' => 'The gender is required.',
            'gender.in' => 'The gender must be either male or female.',

            'farm_id.required' => 'The farm is required.',
            'farm_id.exists' => 'The selected farm does not exist.',

            'color.required' => 'The color is required.',
            'color.string' => 'The color must be a valid string.',
        ]);




        $pet->update($request->all());
        if ($request->farm_id != $oldfarmid) {
            Owner_history::create([
                'pet_id' => $pet->id,
                'farm_id' => $oldfarmid, // Assuming pet has a user_id
                'from_date' => $oldupdatedaat, // When the previous owner started
                'to_date' => now() // Set the end date as now before updating
            ]);
        }

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully');
    }

    public function destroy(Pet $pet)
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized action.');
        }
        $pet->delete();
        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully');
    }

    public function exportPdf()
    {
        $pets = \App\Models\Pet::all();

        $pdf = Pdf::loadView('layouts.pdf.pet-report', compact('pets'));
        return $pdf->download('pet_report.pdf');
    }

}
