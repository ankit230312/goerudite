<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('home');
});



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('solutions', [HomeController::class, 'solutions'])->name('solutions');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('about-us', [HomeController::class, 'about'])->name('about');
Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('login', [HomeController::class, 'login'])->name('login');

Route::post('register-user', [HomeController::class, 'store'])->name('user.register');