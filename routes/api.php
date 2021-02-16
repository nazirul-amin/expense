<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('accounts', [AccountController::class, 'index']);
Route::group(['prefix' => 'account'], function () {
    Route::post('add', [AccountController::class, 'store']);
    Route::get('edit/{id}', [AccountController::class, 'edit']);
    Route::post('update/{id}', [AccountController::class, 'update']);
    Route::delete('delete/{id}', [AccountController::class, 'destroy']);
});

Route::get('expenses', [ExpenseController::class, 'index']);
Route::group(['prefix' => 'expense'], function () {
    Route::post('add', [ExpenseController::class, 'store']);
    Route::get('edit/{id}', [ExpenseController::class, 'edit']);
    Route::post('update/{id}', [ExpenseController::class, 'update']);
    Route::delete('delete/{id}', [ExpenseController::class, 'destroy']);
});
