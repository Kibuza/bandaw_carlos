<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::get('/', HomeController::class)->name('home')->middleware('auth');
Route::post('/', HomeController::class)->name('home')->middleware('auth');

Route::get('/filter', [HomeController::class, 'filter'])->name('filter')->middleware('auth');
Route::post('/filter', [HomeController::class, 'filter'])->name('filter')->middleware('auth');

Route::get('/add', [HomeController::class, 'add_view'])->name('add_view')->middleware('auth');
Route::post('/add', [HomeController::class, 'add_instrument'])->name('add')->middleware('auth');

Route::get('/login', [UserController::class, 'login_view'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/register', [UserController::class, 'register_view'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Route::get('modificar/{id}', [ClientsController::class, 'llenar_modificar'])->name('llenar_modificar');
// // Route::get('modificar', [ClientsController::class, 'modificar'])->name('modificar');
// Route::post('modificar', [ClientsController::class, 'modificar'])->name('modificar');

