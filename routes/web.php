<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('landing');
})->name('landing');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/send-code', [AuthController::class, 'sendCode'])->name('send.code');
Route::post('/verify-login', [AuthController::class, 'verifyAndLogin'])->name('verify.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [FormController::class, 'dashboard'])->name('dashboard');
    Route::post('/form/save', [FormController::class, 'save'])->name('form.save');
    Route::get('/form/export', [FormController::class, 'exportJson'])->name('form.export');
    Route::post('/form/import', [FormController::class, 'importJson'])->name('form.import');
    Route::post('/form/new', [FormController::class, 'newEntry'])->name('form.new');
    Route::post('/form/generate-pdf', [FormController::class, 'generatePdf'])->name('form.generate.pdf');
});
