<?php

use App\Http\Controllers\FundingController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','FundingController');

Route::get('/', [FundingController::class, 'index']);
//Route::post('/webhook', [FundingController::class, 'webhook'])->name('form.submit');
Route::post('/webhook', [FundingController::class, 'handleWebhook']);
