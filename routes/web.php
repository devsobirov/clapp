<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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

Route::middleware('auth')->group(function () {
    Route::view('/', 'welcome');
    Route::get('/home', HomeController::class)->name('home');
});

Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    Route::view('/', 'admin.home')->name('home');
});

Auth::routes(['verify' => false, 'reset' => false, 'register' => false]);
