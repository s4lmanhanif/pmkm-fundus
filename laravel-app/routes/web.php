<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::view('/auth', 'auth.auth')->name('auth.register');
Route::redirect('/register', '/auth');

Route::middleware('auth.session')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::redirect('/', '/beranda');
    Route::view('/beranda', 'layouts.beranda')->name('beranda');
    Route::view('/panduan', 'layouts.panduan')->name('panduan');
    Route::view('/bantuan', 'layouts.bantuan')->name('bantuan');
    Route::get('/pengukuran', [PatientController::class, 'index'])->name('pengukuran');

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::put('/patients/{mother}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{mother}', [PatientController::class, 'destroy'])->name('patients.destroy');
    Route::post('/patients/{mother}/measurements', [PatientController::class, 'storeMeasurement'])->name('measurements.store');
    Route::get('/patients/{mother}/chart', [PatientController::class, 'chart'])->name('patients.chart');
    Route::get('/patients/search/names', [PatientController::class, 'searchNames'])->name('patients.search');
});
