<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices', 'InvoicesController');

Route::resource('sections', 'SectionsController');

Route::resource('products', 'ProductsController');

Route::get('/section/{id}', 'InvoicesController@getproducts');

Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');
// زرار العرض في المرفقات
Route::get('/View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');
// زرار التحميل في المرفقات
Route::get('/download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');
// زرار الحذف في المرفقات

Route::resource('InvoicesDetails', 'InvoicesDetailsController');
// راوت المرفقات
Route::resource('InvoiceAttachments', 'InvoiceAttachmentsController');

// راوت لتعديل حاله الدفع
Route::post('/Status_Update/{id}', 'InvoicesController@Status_Update')->name('Status_Update');

Route::get('Invoice_Paid', 'InvoicesController@Invoice_Paid')->name('Invoice_Paid');
Route::get('Invoice_UnPaid', 'InvoicesController@Invoice_UnPaid')->name('Invoice_UnPaid');
Route::get('Invoice_Partial', 'InvoicesController@Invoice_Partial')->name('Invoice_Partial');

Route::resource('Archive', 'InvoiceArchiveController');

Route::get('print_invoice/{id}', 'InvoicesController@print_invoice')->name('print_invoice');

Route::get('export_invoices', 'InvoicesController@export');

//(spatie) دى خاصه بجزء باكدج 
Route::group(['middleware' => ['auth']], function() {
Route::resource('roles','RoleController');
Route::resource('users','UserController');
 });

//  دى خاصه بجزء التقاريرالفواتير
 Route::get('invoices_report', 'Invoices_ReportController@index')->name('invoices_report');
 Route::post('Search_invoices', 'Invoices_ReportController@Search_invoices');

//  دى خاصه بجزء التقارير العملاء
 Route::get('customers_report', 'Customers_ReportController@index')->name('customers_report');
 Route::post('Search_customers', 'Customers_ReportController@Search_customers');

 Route::get('MarkAsRead_all', 'InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');









Route::get('/{page}', 'AdminController@index'); // خلي دايما دة اخر حاجه 
