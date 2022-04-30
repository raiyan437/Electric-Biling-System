<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

// ------------------------ Admin Section -------------------------

Route::get('/admin/dashboard', 'AdminBasicController@dashboard')->name('admin_dashboard');
Route::get('/admin/changepassword', 'AdminBasicController@changepassword')->name('admin_changepassword');
Route::post('/admin/savepassword', 'AdminBasicController@savepassword')->name('admin_savepassword');

Route::get('/admin/connection/new', 'AdminBasicController@newconnection')->name('admin_newconnection');
Route::get('/admin/connection/list', 'AdminBasicController@connectionlist')->name('admin_connectionlist');
Route::post('/admin/connection/save', 'ConnectionController@saveconnection')->name('admin_saveconnection');
Route::post('/admin/connection/delete', 'ConnectionController@deleteconnection')->name('admin_deleteconnection');

Route::get('/admin/bill/entry', 'AdminBasicController@billentry')->name('admin_billentry');
Route::get('/admin/bill/due', 'AdminBasicController@duebills')->name('admin_duebills');
Route::post('/admin/bill/save', 'AdminBasicController@billsave')->name('admin_billsave');

Route::get('/admin/payment/requests', 'AdminBasicController@payrequests')->name('admin_payrequests');
Route::get('/admin/payment/history', 'AdminBasicController@payhistory')->name('admin_payhistory');
Route::post('/admin/payment/accept', 'PaymentController@acceptpayment')->name('admin_acceptpayment');
Route::post('/admin/payment/reject', 'PaymentController@rejectpayment')->name('admin_rejectpayment');


// ------------------------ Customer Section -------------------------

Route::get('/customer/dashboard', 'CustomerController@dashboard')->name('customer_dashboard');
Route::get('/customer/changepassword', 'CustomerController@changepassword')->name('customer_changepassword');
Route::post('/customer/savepassword', 'CustomerController@savepassword')->name('customer_savepassword');

Route::get('/customer/bills/due', 'CustomerController@duebills')->name('customer_duebills');
Route::get('/customer/payment/history', 'CustomerController@payhistory')->name('customer_payhistory');
Route::post('/customer/bills/pay', 'CustomerController@paybills')->name('customer_paybills');
