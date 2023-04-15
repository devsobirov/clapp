<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;


Route::middleware('auth')->group(function () {
    Route::view('/', 'welcome')->name('homepage');
    Route::get('/home', HomeController::class)->name('home');
});

Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    Route::view('/', 'admin.home')->name('home');
    Route::resource('users', UserController::class)->except(['show', 'delete'])->names('users');
    Route::resource('categories', CategoryController::class)->names('categories');
});

Auth::routes(['verify' => false, 'reset' => false, 'register' => false]);
