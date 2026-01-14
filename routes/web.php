<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EbisPlanningController;
use App\Http\Controllers\EbisManualInputController;

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
    Route::get('/deployment/rekap', [EbisPlanningController::class, 'rekap'])
    ->name('deployment.rekap');

    Route::get('/deployment/update', [EbisPlanningController::class, 'updateList'])
        ->name('deployment.update.list');

    // ================= DEPLOYMENT - EDIT & UPDATE =================
    Route::get('/deployment/{id}/edit', [EbisPlanningController::class, 'edit'])
        ->name('deployment.edit');

    Route::put('/deployment/{id}', [EbisPlanningController::class, 'update'])
        ->name('deployment.update');




    Route::post('/ebis/import', [EbisPlanningController::class, 'import'])
        ->name('ebis.import');

    Route::get('/ebis/export', [EbisPlanningController::class, 'export'])
        ->name('ebis.export');

    //menampilkan deployment upload
    Route::get('/deployment/upload', [EbisPlanningController::class, 'index'])
        ->name('deployment.upload');
});

Route::get('/ebis/manual/input', [EbisManualInputController::class, 'index'])->name('deployment.input');
Route::post('/ebis/manual/store', [EbisManualInputController::class, 'store'])->name('ebis.manual.store');
Route::get('/ebis/manual/list', [EbisManualInputController::class, 'list'])->name('deployment.input');
Route::delete('/ebis/manual/{id}', [EbisManualInputController::class, 'destroy'])->name('ebis.manual.delete');

Route::get('/deployment/input', [EbisManualInputController::class, 'index'])
    ->name('ebis.manual.input');

Route::post('/deployment/input', [EbisManualInputController::class, 'store'])
    ->name('ebis.manual.store');

require __DIR__ . '/auth.php';
