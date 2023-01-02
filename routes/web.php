<?php

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

// Admin Panel Route

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['guest:admin'])->group(function() {
        Route::view('/login', 'admin.auth.login')->name('home');
        Route::post('/check', 'Admin\AdminController@check')->name('login.check');
    });
    Route::middleware(['auth:admin'])->group(function() {
        Route::get('/home', 'Admin\AdminController@home')->name('home');
        // Category
        Route::prefix('category')->name('category.')->group(function() {
            Route::get('/', 'Admin\CategoryController@index')->name('index');
            Route::post('/getcatWiseService', 'Admin\CategoryController@getcatWiseService')->name('getcatWiseService');
            Route::post('/store', 'Admin\CategoryController@store')->name('store');
            Route::post('/{id}/update', 'Admin\CategoryController@update')->name('update');
            Route::get('/{id}/status', 'Admin\CategoryController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\CategoryController@destroy')->name('delete');
        });
        // Service
        Route::prefix('service')->name('service.')->group(function() {
            Route::get('/', 'Admin\ServiceController@index')->name('index');
            Route::post('/store', 'Admin\ServiceController@store')->name('store');
            Route::post('/{id}/update', 'Admin\ServiceController@update')->name('update');
            Route::get('/{id}/status', 'Admin\ServiceController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\ServiceController@destroy')->name('delete');
        });
        // Customer
        Route::prefix('customer')->name('customer.')->group(function() {
            Route::get('/', 'Admin\CustomerController@index')->name('index');
            Route::get('/add', 'Admin\CustomerController@add')->name('add');
            Route::post('/store', 'Admin\CustomerController@store')->name('store');
            Route::get('/{id}/view', 'Admin\CustomerController@view')->name('view');
            Route::get('/{id}/edit', 'Admin\CustomerController@edit')->name('edit');
            Route::post('/{id}/update', 'Admin\CustomerController@update')->name('update');
            Route::get('/{id}/status', 'Admin\CustomerController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\CustomerController@destroy')->name('delete');
        });
        // Employee
        Route::prefix('employee')->name('employee.')->group(function() {
            Route::get('/', 'Admin\EmployeeController@index')->name('index');
            Route::get('/add', 'Admin\EmployeeController@add')->name('add');
            Route::post('/store', 'Admin\EmployeeController@store')->name('store');
            Route::get('/{id}/edit', 'Admin\EmployeeController@edit')->name('edit');
            Route::post('/{id}/update', 'Admin\EmployeeController@update')->name('update');
            Route::get('/{id}/status', 'Admin\EmployeeController@status')->name('status');
            Route::get('/{id}/delete', 'Admin\EmployeeController@destroy')->name('delete');
        });
        Route::prefix('invoice')->name('invoice.')->group(function(){
            Route::get('/', 'Admin\EnquiryController@allInvoice')->name('index');
        });
        // Enquiry
        Route::prefix('enquiry')->name('enquiry.')->group(function(){
            Route::get('/', 'Admin\EnquiryController@index')->name('index');
            Route::get('/add', 'Admin\EnquiryController@add')->name('add');
            Route::post('/ajaxsearch', 'Admin\EnquiryController@ajaxsearch')->name('ajaxsearch');
            Route::post('/employeesearch', 'Admin\EnquiryController@employeesearch')->name('employeesearch');
            Route::post('/category_wise_service', 'Admin\EnquiryController@category_wise_service')->name('category_wise_service');
            Route::post('/store', 'Admin\EnquiryController@store')->name('store');
            Route::post('/preview', 'Admin\EnquiryController@preview')->name('preview');
            Route::get('/{id}/view', 'Admin\EnquiryController@view')->name('view');
            Route::get('/{id}/edit', 'Admin\EnquiryController@edit')->name('edit');
            Route::post('/{id}/update', 'Admin\EnquiryController@update')->name('update');
            Route::get('/{id}/delete', 'Admin\EnquiryController@destroy')->name('delete');
            Route::get('/{id}/invoice', 'Admin\EnquiryController@invoice')->name('invoice');
            Route::get('/{id}/quotation', 'Admin\EnquiryController@quotation')->name('quotation');
            Route::post('/status', 'Admin\EnquiryController@status')->name('status');
            route::get('/{id}/detailsDelete', 'Admin\EnquiryController@detailsDelete')->name('detailsDelete');
            Route::get('/{id}/invoice-store', 'Admin\EnquiryController@InvoiceStore')->name('invoice-store');
            Route::get('/{id}/notes', 'Admin\EnquiryController@allNotes')->name('notes');
            Route::post('/add-notes', 'Admin\EnquiryController@addNotes')->name('add-notes');
            Route::post('/{id}/note-edit', 'Admin\EnquiryController@editNotes')->name('note-edit');
            Route::get('/{id}/note-delete', 'Admin\EnquiryController@deleteNotes')->name('note-delete');
            Route::post('/invoice-update', 'Admin\EnquiryController@InvoiceUpdate')->name('invoice-update');
            Route::get('/{id}/quotation-status', 'Admin\EnquiryController@QuotationStatus')->name('quotation-status');
            Route::post('/quotation-store', 'Admin\EnquiryController@QuotationStore')->name('quotation-store');
            Route::get('/report', 'Admin\EnquiryController@report')->name('report');
        });
    });
});





