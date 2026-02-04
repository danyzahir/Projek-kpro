<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EbisManualInputController;
use App\Http\Controllers\EbisPlanningController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store']);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'role:user_optima,admin'])
->name('dashboard');

Route::get('/waiting', function () {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role !== 'waiting') {
        return redirect()->route('dashboard');
    }

    return view('waiting');

})->middleware('auth')->name('waiting');


Route::middleware('auth')->group(function () {

    /* ================= PROFILE ================= */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});  
Route::middleware(['auth', 'role:user_optima,admin'])->group(function () {

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
    //route deployment.update.list
    Route::get('/deployment/update/list', [EbisManualInputController::class, 'updateList'])
        ->name('deployment.update.list');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{id}/role', [UserController::class, 'updateRole']);
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


require __DIR__ . '/auth.php';
