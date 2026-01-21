<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EbisManualInputController;
use App\Http\Controllers\EbisPlanningController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /* ================= PROFILE ================= */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ================= MENU B2B ================= */
    Route::get('/deployment/b2b', function () {
        return view('deployment.b2b');
    })->name('deployment.b2b');

    /* ================= MANUAL INPUT ================= */
    Route::get('/deployment/input', [EbisManualInputController::class, 'index'])
        ->name('deployment.input');

    Route::post('/deployment/input', [EbisManualInputController::class, 'store'])
        ->name('deployment.input.store');

    /* ================= REKAP DATA ================= */
    Route::get('/deployment/rekap', [EbisPlanningController::class, 'rekap'])
        ->name('deployment.rekap');

    /* ================= UPDATE DATA (LIST) ================= */
    Route::get('/deployment/update', [EbisManualInputController::class, 'updateList'])
        ->name('deployment.update');

    /* ================= EDIT & UPDATE DEPLOYMENT ================= */
    Route::get('/deployment/{id}/edit', [EbisManualInputController::class, 'edit'])
        ->name('deployment.edit');

    Route::put('/deployment/{id}', [EbisManualInputController::class, 'update'])
        ->name('deployment.update.process');

    /* ================= UPLOAD / IMPORT / EXPORT ================= */
    Route::get('/deployment/upload', [EbisPlanningController::class, 'index'])
        ->name('deployment.upload');

    Route::post('/ebis/import', [EbisPlanningController::class, 'import'])
        ->name('ebis.import');

    Route::get('/ebis/export', [EbisPlanningController::class, 'export'])
        ->name('ebis.export');

        //route ebis manual store
    Route::post('/ebis/manual/store', [EbisManualInputController::class, 'store'])
        ->name('ebis.manual.store');
});

require __DIR__.'/auth.php';
