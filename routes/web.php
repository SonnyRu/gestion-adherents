<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\DecryptUserData;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\TrombinoscopeController;
use App\Http\Middleware\CheckRole;

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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('list', [ProfileController::class, 'index'])->name('list')->middleware(['checkRole:president,secretaire']);

Route::get('annuaire', [ProfileController::class, 'indexannuaire'])->name('annuaire');

Route::get('trombinoscope', [TrombinoscopeController::class, 'index'])->name('trombinoscope');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('editad')->middleware('decryptUserData');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('decryptUserData');
Route::delete('/archive/{userId}', [ArchiveController::class, 'archive'])->name('user.archive');

require __DIR__.'/auth.php';


