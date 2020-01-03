<?php

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

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
//Auth::routes(['verify' => true]);
Route::group(['prefix' => 'administrator', 'middleware' => 'admin'], function() {
    Route::get('/', 'admin\DashboardController@index');
    Route::get('dashboard', 'admin\DashboardController@index');
    Route::get('dashboard/monthly/fetch_data' , 'admin\DashboardController@fetch_data');
    Route::get('dashboard/date-wise/fetch_data' , 'admin\DashboardController@season_fetch_data');
    Route::get('dashboard/course-wise/fetch_data' , 'admin\DashboardController@course_fetch_data');
    Route::resource('users', 'admin\UserController');
    Route::get('users_destroy/{id}', 'admin\UserController@destroy');
    Route::resource('invoice', 'admin\InvoiceController');
    //Route::get('invoice','admin\InvoiceController@index');
    Route::get('invoice/create/{id}','admin\InvoiceController@create');
    Route::get('invoice/pdf/{id}','admin\InvoiceController@pdf');
    Route::get('invoice/view-all/{id}','admin\InvoiceController@viewAll');
    Route::post('invoice/store/{id}','admin\InvoiceController@store');
    Route::resource('customer', 'admin\CustomerController');
    Route::post('/invoice-pdf', 'admin\InvoiceController@pdfdownload');
    Route::get('invoice-pdf/{invoice_no}', 'admin\InvoiceController@pdfdownload');
    //Route::get('pdf', 'InvoiceController@pdfdownload');
    Route::get('users/{id}/view', 'admin\UserController@view');
    Route::get('invoice/pagination/fetch_data' , 'admin\InvoiceController@fetch_data');
    Route::get('customer/pagination/fetch_data' , 'admin\CustomerController@fetch_data');
    //Route::resource('contact-us', 'admin\forms\ContactUsController');

    Route::group(['prefix' => 'edu-anannt'], function() {

        Route::resource('invoice', 'admin\edu-anannt\InvoiceController');
        //Route::get('invoice','admin\edu-anannt\InvoiceController@index');
        Route::get('invoice/create/{id}','admin\edu-anannt\InvoiceController@create');
        Route::get('invoice/pdf/{id}','admin\edu-anannt\InvoiceController@pdf');
        Route::get('invoice/view-all/{id}','admin\edu-anannt\InvoiceController@viewAll');
        Route::post('invoice/store/{id}','admin\edu-anannt\InvoiceController@store');
        Route::resource('customer', 'admin\edu-anannt\CustomerController');
        Route::post('/invoice-pdf', 'admin\edu-anannt\InvoiceController@pdfdownload');
        Route::get('invoice-pdf/{invoice_no}', 'admin\edu-anannt\InvoiceController@pdfdownload');
        //Route::get('pdf', 'InvoiceController@pdfdownload');
        Route::get('users/{id}/view', 'admin\edu-anannt\UserController@view');
        Route::get('invoice/pagination/fetch_data' , 'admin\edu-anannt\InvoiceController@fetch_data');
        Route::get('customer/pagination/fetch_data' , 'admin\edu-anannt\CustomerController@fetch_data');
    });
    

   
});

