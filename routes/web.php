<?php

use App\Http\Controllers\ProfileController;
use App\Models\Patient;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $patients = Patient::all();
    return Inertia::render('Dashboard', ['patients' => $patients]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('patient/testing/{patient_id}', [\App\Http\Controllers\PatientController::class, 'testing'])->name('patient.testing');
Route::post('patient/testing/submit', [\App\Http\Controllers\ResultController::class, 'submit'])->name('patient.testing.submit');
Route::get('patient/testing/result/{patient_id}', [\App\Http\Controllers\ResultController::class, 'index'])->name('patient.testing.result');
Route::get('patient/testing-second/{patient_id}', [\App\Http\Controllers\PatientController::class, 'testing_second'])->name('patient.testing-second');


Route::get('patient/create', [\App\Http\Controllers\PatientController::class, 'index'])->name('patient.create');
Route::get('patient/testParams', [\App\Http\Controllers\PatientController::class, 'testParams'])->name('patient.testParams');
Route::get('patient/testInstructions', [\App\Http\Controllers\PatientController::class, 'testInstruction'])->name('patient.testInstruction');
Route::post('patient/storeParams', [\App\Http\Controllers\PatientController::class, 'storeParams'])->name('patient.storeParams');

Route::post('patient/store', [\App\Http\Controllers\PatientController::class, 'store'])->name('patient.store');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
