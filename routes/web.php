<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\KategoriBukuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/databuku', [DataBukuController::class, 'index'])->name('databuku');
    Route::get('/databuku/add', [DataBukuController::class, 'add'])->name('databuku.add');
    Route::post('/databuku/store', [DataBukuController::class, 'store'])->name('databuku.store');
    Route::get('/databuku/edit/{id}', [DataBukuController::class, 'edit'])->name('databuku.edit');
    Route::put('/databuku/update/{id}', [DataBukuController::class, 'update'])->name('databuku.update');
    Route::get('/databuku/delete/{id}', [DataBukuController::class, 'delete'])->name('databuku.delete');
    Route::post('/databuku/excel', [DataBukuController::class, 'excel'])->name('databuku.export-excel');
    Route::post('/databuku/pdf', [DataBukuController::class, 'pdf'])->name('databuku.export-pdf');

    Route::get('/kategoribuku', [KategoriBukuController::class, 'index'])->name('kategoribuku');
    Route::get('/kategoribuku/add', [KategoriBukuController::class, 'add'])->name('kategoribuku.add');
    Route::post('/kategoribuku/store', [KategoriBukuController::class, 'store'])->name('kategoribuku.store');
    Route::get('/kategoribuku/edit/{id}', [KategoriBukuController::class, 'edit'])->name('kategoribuku.edit');
    Route::put('/kategoribuku/update/{id}', [KategoriBukuController::class, 'update'])->name('kategoribuku.update');
    Route::get('/kategoribuku/delete/{id}', [KategoriBukuController::class, 'delete'])->name('kategoribuku.delete');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/datauser', [DataUserController::class, 'index'])->name('datauser');
    Route::get('/datauser/add', [DataUserController::class, 'add'])->name('datauser.add');
    Route::post('/datauser/store', [DataUserController::class, 'store'])->name('datauser.store');
    Route::get('/datauser/edit/{id}', [DataUserController::class, 'edit'])->name('datauser.edit');
    Route::put('/datauser/update/{id}', [DataUserController::class, 'update'])->name('datauser.update');
    Route::get('/datauser/delete/{id}', [DataUserController::class, 'delete'])->name('datauser.delete');
});


require __DIR__.'/auth.php';
