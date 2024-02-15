<?php

use App\Http\Controllers\Api\InstrumentsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/user/register', [UserController::class, 'store'])->name('register_user');
Route::post('/user/login', [UserController::class, 'login'])->name('login_user');

Route::middleware('auth:sanctum')->get('/instruments', [InstrumentsController::class, 'index'])->name('instruments_index');
Route::middleware('auth:sanctum')->get('/instruments/{id}', [InstrumentsController::class, 'show'])->name('instruments_show');
Route::middleware('auth:sanctum')->post('/instruments/store', [InstrumentsController::class, 'store'])->name('instruments_store');
Route::middleware('auth:sanctum')->delete('/instruments/destroy/{id}', [InstrumentsController::class, 'destroy'])->name('instruments_destroy');