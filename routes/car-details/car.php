<?php

use App\Http\Controllers\CarDetail\CarController;
use App\Http\Controllers\Invoice\InvoiceController;

Route::get('/car', [CarController::class, 'index'])->name('car');
Route::get('/cars', [CarController::class, 'carList'])->name('car.list');
Route::GET('/car/form/{id}', [CarController::class, 'form'])->name('car.form');
Route::POST('/car/save', [CarController::class, 'save'])->name('car.save');
Route::GET('/car/invoice/{id}',[InvoiceController::class,'getInvoiceForm'])->name('invoice');
Route::POST('/car/invoice/save',[InvoiceController::class,'saveInvoice'])->name('invoice.save');
Route::GET('/discount',[InvoiceController::class,'hasDiscount'])->name('discount');
Route::get('/',function(){
    return view('welcome');
});