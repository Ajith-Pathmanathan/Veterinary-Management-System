<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\VaccineController;
use App\Http\Controllers\VeterinarianController;
use Illuminate\Support\Facades\Route;



Route::get('/', [\App\Http\Controllers\FirstPageController::class, 'view'])->name('firstPage');

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/farms/pdf/export', [FarmController::class, 'exportPdf'])->name("farms.pdf");
    Route::get('/pets/pdf/export', [PetController::class, 'exportPdf'])->name("pets.pdf");

    Route::get('/users/pdf/export', [UserController::class, 'exportPdf'])->name("users.pdf");;

    Route::get('/pets/petsByUser', [PetController::class, 'getPetsByUserId'])->name("pets.getByUserId");

    Route::resource('farms', FarmController::class);
    Route::resource('pets', PetController::class);
    Route::resource('vaccinations', VaccinationController::class);
    Route::resource('veterinarians', veterinarianController::class);
    Route::resource('vaccines', VaccineController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('hospitals', HospitalController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('medical_histories', MedicalHistoryController::class);
    Route::resource('medical_histories', MedicalHistoryController::class);
    Route::resource('labtests', \App\Http\Controllers\LabtestController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::get('register', [RegisteredUserController::class]);
    Route::get('/veterinarians/{veterinarian}/edit', [VeterinarianController::class, 'edit'])
        ->name('veterinarians.edit');


    Route::put('/notifications/{id}', [NotificationController::class, 'update']);
    Route::get('/checkNIC', [FarmController::class, 'checkNIC']);


});


Route::get('/dashboard', [DashboardController::class, 'view'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [\App\Http\Controllers\FirstPageController::class, 'view'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
