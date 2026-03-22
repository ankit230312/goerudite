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
    Route::get('/admin/boards', [DashboardController::class, 'boards'])->name('admin.boards');
    Route::get('/admin/academic-sessions', [DashboardController::class, 'academic_sessions'])->name('admin.academic_sessions');
    Route::get('/admin/student-record', [DashboardController::class, 'student_record'])->name('admin.student_record');
    Route::post('/admin/save-class', [DashboardController::class, 'save_class'])->name('admin.save-class');
    Route::post('/admin/update-class', [DashboardController::class, 'update_class'])->name('admin.class.update');
    Route::post('/admin/delete-class', [DashboardController::class, 'delete_class'])->name('admin.class.delete');
    Route::post('/admin/save-board', [DashboardController::class, 'save_board'])->name('admin.save-board');
    Route::post('/admin/update-board', [DashboardController::class, 'update_board'])->name('admin.board.update');
    Route::post('/admin/delete-board', [DashboardController::class, 'delete_board'])->name('admin.board.delete');
    Route::post('/admin/save-academic-session', [DashboardController::class, 'save_academic_session'])->name('admin.save-academic-session');
    Route::post('/admin/update-academic-session', [DashboardController::class, 'update_academic_session'])->name('admin.academic-session.update');
    Route::post('/admin/delete-academic-session', [DashboardController::class, 'delete_academic_session'])->name('admin.academic-session.delete');
    Route::get('/admin/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [DashboardController::class, 'update_profile'])->name('admin.profile.update');

    Route::get('/admin/rfq-inbox', [DashboardController::class, 'rfq_inbox'])->name('admin.rfq_inbox');
    Route::post('/admin/store-rfq', [DashboardController::class, 'store_rfq'])->name('admin.store_rfq');
    Route::post('/admin/send-rfq/{id}', [DashboardController::class, 'send_rfq'])->name('admin.send_rfq');
    Route::put('/admin/update-rfq/{id}', [DashboardController::class, 'update_rfq'])->name('admin.update_rfq');
    Route::post('/admin/close-rfq/{id}', [DashboardController::class, 'close_rfq'])->name('admin.close_rfq');
    Route::get('/admin/rfq-details/{id}', [DashboardController::class, 'rfq_details'])->name('admin.rfq_details');
    Route::get('/admin/rfq-responses/{id}', [DashboardController::class, 'rfq_responses'])->name('admin.rfq_responses');

     Route::get('/admin/manage-records', [DashboardController::class, 'manage_records'])->name('admin.manage_records');
     Route::post('/admin/save-purchase-record', [DashboardController::class, 'save_purchase_record'])->name('admin.save-purchase-record');
     Route::post('/admin/update-purchase-record', [DashboardController::class, 'update_purchase_record'])->name('admin.update-purchase-record');
     Route::post('/admin/delete-purchase-record', [DashboardController::class, 'delete_purchase_record'])->name('admin.delete-purchase-record');
     Route::get('/admin/download-invoice/{id}', [DashboardController::class, 'download_invoice'])->name('admin.download-invoice');


});

// distributor panel
Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::get('/distributor/dashboard', [DashboardController::class, 'distributor'])->name('distributor.dashboard');
    Route::get('/distributor/manage-cateloge', [DashboardController::class, 'manage_cateloge'])->name('distributor.manage_cateloge');
    Route::post('/distributor/save-catalogue', [DashboardController::class, 'save_catalogue'])->name('distributor.save_catalogue');
    Route::post('/distributor/update-catalogue', [DashboardController::class, 'update_catalogue'])->name('distributor.update_catalogue');

    Route::get('/distributor/profile', [DashboardController::class, 'distributor_profile'])->name('distributor.profile');
    Route::post('/distributor/profile/update', [DashboardController::class, 'distributor_update_profile'])->name('distributor.profile.update');

    Route::get('/distributor/rfq-inbox', [DashboardController::class, 'distributor_rfq_inbox'])->name('distributor.rfq_inbox');
    Route::post('/distributor/store-rfq', [DashboardController::class, 'distributor_store_rfq'])->name('distributor.store_rfq');
    Route::post('/distributor/receive-rfq/{id}', [DashboardController::class, 'distributor_receive_rfq'])->name('distributor.receive_rfq');
    Route::post('/distributor/rfq-response', [DashboardController::class, 'distributor_store_rfq_response'])->name('distributor.rfq_response');
    Route::put('/distributor/update-rfq/{id}', [DashboardController::class, 'distributor_update_rfq'])->name('distributor.update_rfq');
    Route::post('/distributor/close-rfq/{id}', [DashboardController::class, 'distributor_close_rfq'])->name('distributor.close_rfq');
    Route::get('/distributor/rfq-details/{id}', [DashboardController::class, 'distributor_rfq_details'])->name('distributor.rfq_details');

     Route::get('/distributor/manage-records', [DashboardController::class, 'distributor_manage_records'])->name('distributor.manage_records');
     Route::post('/distributor/save-purchase-record', [DashboardController::class, 'distributor_save_purchase_record'])->name('distributor.save-purchase-record');
     Route::post('/distributor/update-purchase-record', [DashboardController::class, 'distributor_update_purchase_record'])->name('distributor.update-purchase-record');
     Route::post('/distributor/delete-purchase-record', [DashboardController::class, 'distributor_delete_purchase_record'])->name('distributor.delete-purchase-record');
     Route::get('/distributor/download-invoice/{id}', [DashboardController::class, 'distributor_download_invoice'])->name('distributor.download-invoice');
});

// retailer panel
Route::middleware(['auth', 'role:retailer'])->group(function () {
    Route::get('/retailer/dashboard', [DashboardController::class, 'retailer'])->name('retailer.dashboard');
    Route::get('/retailer/profile', [DashboardController::class, 'retailer_profile'])->name('retailer.profile');
    Route::post('/retailer/profile/update', [DashboardController::class, 'retailer_update_profile'])->name('retailer.profile.update');
    Route::post('/retailer/store-rfq', [DashboardController::class, 'retailer_store_rfq'])->name('retailer.store_rfq');
    Route::post('/retailer/close-rfq/{id}', [DashboardController::class, 'retailer_close_rfq'])->name('retailer.close_rfq');
    Route::get('/retailer/rfq-details/{id}', [DashboardController::class, 'retailer_rfq_details'])->name('retailer.rfq_details');
});

// publisher panel
Route::middleware(['auth', 'role:publisher'])->group(function () {
    Route::get('/publisher/dashboard', [DashboardController::class, 'publisher'])->name('publisher.dashboard');
    Route::get('/publisher/profile', [DashboardController::class, 'publisher_profile'])->name('publisher.profile');
    Route::post('/publisher/profile/update', [DashboardController::class, 'publisher_update_profile'])->name('publisher.profile.update');
});
