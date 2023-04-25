<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;


Route::middleware('auth')->group(function () {
    Route::view('/', 'home')->name('homepage');
    Route::get('/home', HomeController::class)->name('home');
    Route::controller(MenuController::class)->group(function () {
        Route::get('menu/{category}', 'category')->name('menu.category');
        Route::get('menu/category/{category}', 'menu')->name('menu.menu');
        Route::get('menu/item/{food}', 'menuItem')->name('menu.item');
    });
    Route::any('/search', SearchController::class)->name('search');
    Route::view('profile', 'profile')->name('profile.form');
    Route::post('profile', ProfileController::class)->name('profile.save');
});

Route::middleware('admin')->prefix('admin')->as('admin.')->group(function () {
    Route::view('/', 'admin.home')->name('home');
    Route::resource('users', UserController::class)->except(['show', 'delete'])->names('users');
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::resource('fields', FieldController::class)->only(['index', 'store'])->names('fields');
    Route::resource('food', FoodController::class)->except(['delete', 'show'])->names('food');
    Route::get('food/category/{category}', [FoodController::class, 'category'])->name('food.category');
});

Auth::routes(['verify' => false, 'reset' => false, 'register' => false]);
