<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // PROFILE (DEFAULT BREEZE)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ DEPLOYMENT - B2B
    Route::get('/deployment/b2b', function () {
        return view('deployment.b2b');
    })->name('deployment.b2b');
    // ✅ DEPLOYMENT - input
    Route::get('/deployment/input', function () {
        return view('deployment.input');
    })->name('deployment.input');

    // ✅ DEPLOYMENT - Rekap
    Route::get('/deployment/rekap', function () {
        return view('deployment.rekap');
    })->name('deployment.rekap');

     // ✅ DEPLOYMENT - Upload
    Route::get('/deployment/upload', function () {
        return view('deployment.upload');
    })->name('deployment.upload');

});

require __DIR__.'/auth.php';
