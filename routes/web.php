<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
});



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('solutions', [HomeController::class, 'solutions'])->name('solutions');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('about-us', [HomeController::class, 'about'])->name('about');
Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('catalog', [HomeController::class, 'catalog'])->name('catalog');


Route::get('login-register', [HomeController::class, 'login_register'])->name('login-register');
Route::post('register-user', [HomeController::class, 'store'])->name('user.register');

Route::get('login', [HomeController::class, 'login'])->name('login');
Route::post('login-submit', [HomeController::class, 'login_submit'])->name('login.submit');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');


// admin panel
Route::middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/student-record', [DashboardController::class, 'student_record'])->name('admin.student_record');
    Route::post('/admin/save-class', [DashboardController::class, 'save_class'])->name('admin.save-class');
    Route::post('/admin/update-class', [DashboardController::class, 'update_class'])->name('admin.class.update');
    Route::post('/admin/delete-class', [DashboardController::class, 'delete_class'])->name('admin.class.delete');
    Route::get('/admin/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [DashboardController::class, 'update_profile'])->name('admin.profile.update');

        Route::get('/admin/rfq-inbox', [DashboardController::class, 'rfq_inbox'])->name('admin.rfq_inbox');
        Route::post('/admin/store-rfq', [DashboardController::class, 'store_rfq'])->name('admin.store_rfq');
        Route::put('/admin/update-rfq/{id}', [DashboardController::class, 'update_rfq'])->name('admin.update_rfq');
        Route::post('/admin/close-rfq/{id}', [DashboardController::class, 'close_rfq'])->name('admin.close_rfq');
        Route::get('/admin/rfq-details/{id}', [DashboardController::class, 'rfq_details'])->name('admin.rfq_details');
});

// distributor panel
Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::get('/distributor/dashboard', [DashboardController::class, 'distributor'])->name('distributor.dashboard');
});

// retailer panel
Route::middleware(['auth', 'role:retailer'])->group(function () {
    Route::get('/retailer/dashboard', [DashboardController::class, 'retailer'])->name('retailer.dashboard');
});

// publisher panel
Route::middleware(['auth', 'role:publisher'])->group(function () {
    Route::get('/publisher/dashboard', [DashboardController::class, 'publisher'])->name('publisher.dashboard');
});

