<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::get('/remind', [UserController::class, 'remind_view'])->name('remind_pass');
Route::post('/remind', [UserController::class, 'send_mail'])->name('remind_pass');


