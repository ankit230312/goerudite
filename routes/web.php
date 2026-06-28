<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublisherController;

Route::get('/', function () {
    return view('home');
});



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('solutions', [HomeController::class, 'solutions'])->name('solutions');
Route::get('pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('about-us', [HomeController::class, 'about'])->name('about');
Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('catalog-detail/{id}', [HomeController::class, 'catalog_detail'])->name('catalog.detail');
// Route::get('catalog-detail', [HomeController::class, 'catalog_detail'])->name('catalog.detail');


Route::get('login-register', [HomeController::class, 'login_register'])->name('login-register');
Route::post('register-user', [HomeController::class, 'store'])->name('user.register');

Route::get('login', [HomeController::class, 'login'])->name('login');
Route::post('login-submit', [HomeController::class, 'login_submit'])->name('login.submit');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');



// admin panel
Route::get('/get-mediums/{board_id}', [DashboardController::class, 'getMediums'])
    ->middleware('auth');
Route::get('/get-mediums/{board_id}', [DashboardController::class, 'getMediums']);
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

    Route::get('/admin/mediums', [DashboardController::class, 'mediums'])->name('admin.mediums');
    Route::post('/admin/save-medium', [DashboardController::class, 'save_medium'])->name('admin.save-medium');
    Route::post('/admin/delete-medium', [DashboardController::class, 'delete_medium'])->name('admin.medium.delete');
    Route::post('/admin/update-medium', [DashboardController::class, 'update_medium'])->name('admin.medium.update');


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
    Route::post('/distributor/delete-catalogue', [DashboardController::class, 'delete_catalogue'])->name('distributor.delete_catalogue');

    Route::get('/distributor/profile', [DashboardController::class, 'distributor_profile'])->name('distributor.profile');
    Route::post('/distributor/profile/update', [DashboardController::class, 'distributor_update_profile'])->name('distributor.profile.update');

    Route::get('/distributor/rfq-inbox', [DashboardController::class, 'distributor_rfq_inbox'])->name('distributor.rfq_inbox');
    Route::post('/distributor/store-rfq', [DashboardController::class, 'distributor_store_rfq'])->name('distributor.store_rfq');
    Route::post('/distributor/send-rfq/{id}', [DashboardController::class, 'distributor_send_rfq'])->name('distributor.send_rfq');
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


    Route::get('/distributor/boards', [DashboardController::class, 'distributor_boards'])->name('distributor.boards');
    Route::post('/distributor/save-board', [DashboardController::class, 'distributor_save_board'])->name('distributor.save-board');
    Route::post('/distributor/update-board', [DashboardController::class, 'distributor_update_board'])->name('distributor.board.update');
    Route::post('/distributor/delete-board', [DashboardController::class, 'distributor_delete_board'])->name('distributor.board.delete');



    Route::get('/distributor/academic-sessions', [DashboardController::class, 'distributor_academic_sessions'])->name('distributor.academic_sessions');
    Route::post('/distributor/save-academic-session', [DashboardController::class, 'distributor_save_academic_session'])->name('distributor.save-academic-session');
    Route::post('/distributor/update-academic-session', [DashboardController::class, 'distributor_update_academic_session'])->name('distributor.academic-session.update');
    Route::post('/distributor/delete-academic-session', [DashboardController::class, 'distributor_delete_academic_session'])->name('distributor.academic-session.delete');


    Route::get('/distributor/mediums', [DashboardController::class, 'distributor_mediums'])->name('distributor.mediums');
    Route::post('/distributor/save-medium', [DashboardController::class, 'distributor_save_medium'])->name('distributor.save-medium');
    Route::post('/distributor/delete-medium', [DashboardController::class, 'distributor_delete_medium'])->name('distributor.medium.delete');
    Route::post('/distributor/update-medium', [DashboardController::class, 'distributor_update_medium'])->name('distributor.medium.update');



});

// retailer panel
Route::middleware(['auth', 'role:retailer'])->group(function () {
    Route::get('/retailer/dashboard', [DashboardController::class, 'retailer'])->name('retailer.dashboard');
    Route::get('/retailer/profile', [DashboardController::class, 'retailer_profile'])->name('retailer.profile');
    Route::post('/retailer/profile/update', [DashboardController::class, 'retailer_update_profile'])->name('retailer.profile.update');


    Route::get('/retailer/rfq-inbox', [DashboardController::class, 'retailer_rfq_inbox'])->name('retailer.rfq_inbox');
    Route::post('/retailer/store-rfq', [DashboardController::class, 'retailer_store_rfq'])->name('retailer.store_rfq');
    Route::post('/retailer/send-rfq/{id}', [DashboardController::class, 'retailer_send_rfq'])->name('retailer.send_rfq');
    Route::post('/retailer/receive-rfq/{id}', [DashboardController::class, 'retailer_receive_rfq'])->name('retailer.receive_rfq');
    Route::post('/retailer/rfq-response', [DashboardController::class, 'retailer_store_rfq_response'])->name('retailer.rfq_response');
    Route::put('/retailer/update-rfq/{id}', [DashboardController::class, 'retailer_update_rfq'])->name('retailer.update_rfq');
    Route::post('/retailer/close-rfq/{id}', [DashboardController::class, 'retailer_close_rfq'])->name('retailer.close_rfq');
    Route::get('/retailer/rfq-details/{id}', [DashboardController::class, 'retailer_rfq_details'])->name('retailer.rfq_details');



    Route::get('/retailer/manage-catalogue', [DashboardController::class, 'retailer_manage_catalogue'])->name('retailer.manage_catalogue');
    Route::post('/retailer/save-catalogue', [DashboardController::class, 'retailer_save_catalogue'])->name('retailer.save_catalogue');
    Route::post('/retailer/update-catalogue', [DashboardController::class, 'retailer_update_catalogue'])->name('retailer.update_catalogue');
    Route::post('/retailer/delete-catalogue', [DashboardController::class, 'retailer_delete_catalogue'])->name('retailer.delete_catalogue');





    Route::get('/retailer/manage-records', [DashboardController::class, 'retailer_manage_records'])->name('retailer.manage_records');
    Route::post('/retailer/save-purchase-record', [DashboardController::class, 'retailer_save_purchase_record'])->name('retailer.save-purchase-record');
    Route::post('/retailer/update-purchase-record', [DashboardController::class, 'retailer_update_purchase_record'])->name('retailer.update-purchase-record');
    Route::post('/retailer/delete-purchase-record', [DashboardController::class, 'retailer_delete_purchase_record'])->name('retailer.delete-purchase-record');
    Route::get('/retailer/download-invoice/{id}', [DashboardController::class, 'retailer_download_invoice'])->name('retailer.download-invoice');




    Route::get('/retailer/boards', [DashboardController::class, 'retailer_boards'])->name('retailer.boards');
    Route::post('/retailer/save-board', [DashboardController::class, 'retailer_save_board'])->name('retailer.save-board');
    Route::post('/retailer/update-board', [DashboardController::class, 'retailer_update_board'])->name('retailer.board.update');
    Route::post('/retailer/delete-board', [DashboardController::class, 'retailer_delete_board'])->name('retailer.board.delete');


    Route::get('/retailer/academic-sessions', [DashboardController::class, 'retailer_academic_sessions'])->name('retailer.academic_sessions');
    Route::post('/retailer/save-academic-session', [DashboardController::class, 'retailer_save_academic_session'])->name('retailer.save-academic-session');
    Route::post('/retailer/update-academic-session', [DashboardController::class, 'retailer_update_academic_session'])->name('retailer.academic-session.update');
    Route::post('/retailer/delete-academic-session', [DashboardController::class, 'retailer_delete_academic_session'])->name('retailer.academic-session.delete');


    Route::get('/retailer/mediums', [DashboardController::class, 'retailer_mediums'])->name('retailer.mediums');
    Route::post('/retailer/save-medium', [DashboardController::class, 'retailer_save_medium'])->name('retailer.save-medium');
    Route::post('/retailer/delete-medium', [DashboardController::class, 'retailer_delete_medium'])->name('retailer.medium.delete');
    Route::post('/retailer/update-medium', [DashboardController::class, 'retailer_update_medium'])->name('retailer.medium.update');

});

// publisher panel
Route::middleware(['auth', 'role:publisher'])->group(function () {
    Route::get('/publisher/dashboard', [PublisherController::class, 'dashboard'])->name('publisher.dashboard');
    Route::get('/publisher/profile', [PublisherController::class, 'profile'])->name('publisher.profile');
    Route::post('/publisher/profile/update', [PublisherController::class, 'update_profile'])->name('publisher.profile.update');

    Route::get('/publisher/rfq-inbox', [PublisherController::class, 'rfq_inbox'])->name('publisher.rfq_inbox');
    Route::post('/publisher/store-rfq', [PublisherController::class, 'store_rfq'])->name('publisher.store_rfq');
    Route::post('/publisher/send-rfq/{id}', [PublisherController::class, 'send_rfq'])->name('publisher.send_rfq');
    Route::post('/publisher/receive-rfq/{id}', [PublisherController::class, 'receive_rfq'])->name('publisher.receive_rfq');
    Route::post('/publisher/rfq-response', [PublisherController::class, 'store_rfq_response'])->name('publisher.rfq_response');
    Route::put('/publisher/update-rfq/{id}', [PublisherController::class, 'update_rfq'])->name('publisher.update_rfq');
    Route::post('/publisher/close-rfq/{id}', [PublisherController::class, 'close_rfq'])->name('publisher.close_rfq');
    Route::get('/publisher/rfq-details/{id}', [PublisherController::class, 'rfq_details'])->name('publisher.rfq_details');

    Route::get('/publisher/manage-records', [PublisherController::class, 'manage_records'])->name('publisher.manage_records');
    Route::post('/publisher/save-purchase-record', [PublisherController::class, 'save_purchase_record'])->name('publisher.save-purchase-record');
    Route::post('/publisher/update-purchase-record', [PublisherController::class, 'update_purchase_record'])->name('publisher.update-purchase-record');
    Route::post('/publisher/delete-purchase-record', [PublisherController::class, 'delete_purchase_record'])->name('publisher.delete-purchase-record');
    Route::get('/publisher/download-invoice/{id}', [PublisherController::class, 'download_invoice'])->name('publisher.download-invoice');


    Route::get('/publisher/manage-cateloge', [DashboardController::class, 'publisher_manage_cateloge'])->name('publisher.manage_cateloge');
    Route::post('/publisher/save-catalogue', [DashboardController::class, 'publisher_save_catalogue'])->name('publisher.save_catalogue');
    Route::post('/publisher/update-catalogue', [DashboardController::class, 'publisher_update_catalogue'])->name('publisher.update_catalogue');
    Route::post('/publisher/delete-catalogue', [DashboardController::class, 'publisher_delete_catalogue'])->name('publisher.delete_catalogue');

    Route::get('/publisher/boards', [DashboardController::class, 'publisher_boards'])->name('publisher.boards');
    Route::post('/publisher/save-board', [DashboardController::class, 'publisher_save_board'])->name('publisher.save-board');
    Route::post('/publisher/update-board', [DashboardController::class, 'publisher_update_board'])->name('publisher.board.update');
    Route::post('/publisher/delete-board', [DashboardController::class, 'publisher_delete_board'])->name('publisher.board.delete');

    Route::get('/publisher/academic-sessions', [DashboardController::class, 'publisher_academic_sessions'])->name('publisher.academic_sessions');
    Route::post('/publisher/save-academic-session', [DashboardController::class, 'publisher_save_academic_session'])->name('publisher.save-academic-session');
    Route::post('/publisher/update-academic-session', [DashboardController::class, 'publisher_update_academic_session'])->name('publisher.academic-session.update');
    Route::post('/publisher/delete-academic-session', [DashboardController::class, 'publisher_delete_academic_session'])->name('publisher.academic-session.delete');


    Route::get('/publisher/mediums', [DashboardController::class, 'publisher_mediums'])->name('publisher.mediums');
    Route::post('/publisher/save-medium', [DashboardController::class, 'publisher_save_medium'])->name('publisher.save-medium');
    Route::post('/publisher/delete-medium', [DashboardController::class, 'publisher_delete_medium'])->name('publisher.medium.delete');
    Route::post('/publisher/update-medium', [DashboardController::class, 'publisher_update_medium'])->name('publisher.medium.update');


});
