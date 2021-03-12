<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
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

//----- account route -----//
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts', [AccountController::class, 'index'])->name('accounts');
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('/accounts/{account}', [AccountController::class, 'update'])->name('accounts.update');
Route::middleware(['auth:sanctum', 'verified'])->delete('/accounts/{account}', [AccountController::class, 'destroy'])->name('accounts.destroy');

//----- expense route -----//
Route::middleware(['auth:sanctum', 'verified'])->get('/expenses', [ExpenseController::class, 'index'])->name('expenses');
Route::middleware(['auth:sanctum', 'verified'])->get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])->name('expenses.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('/expenses/{expense}', [ExpenseController::class, 'update'])->name('expenses.update');
Route::middleware(['auth:sanctum', 'verified'])->delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])->name('expenses.destroy');

//----- income route -----//
Route::middleware(['auth:sanctum', 'verified'])->get('/incomes', [IncomeController::class, 'index'])->name('incomes');
Route::middleware(['auth:sanctum', 'verified'])->get('/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
Route::middleware(['auth:sanctum', 'verified'])->post('/incomes', [IncomeController::class, 'store'])->name('incomes.store');
Route::middleware(['auth:sanctum', 'verified'])->get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
Route::middleware(['auth:sanctum', 'verified'])->put('/incomes/{income}', [IncomeController::class, 'update'])->name('incomes.update');
Route::middleware(['auth:sanctum', 'verified'])->delete('/incomes/{income}', [IncomeController::class, 'destroy'])->name('incomes.destroy');
