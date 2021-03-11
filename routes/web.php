<?php

use App\Http\Controllers\AccountController;
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

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/accounts', [AccountController::class, 'index'])->name('accounts');
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');
Route::middleware(['auth:sanctum', 'verified'])->delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');
