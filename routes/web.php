<?php

use App\Http\Controllers\FundingController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','FundingController');

Route::get('/', [FundingController::class, 'index']);
//Route::post('/webhook', [FundingController::class, 'webhook2']);
Route::match(['get', 'post'], '/webhook', [FundingController::class, 'testWebhook']);



//Route::post('/webhook', [FundingController::class, 'handleWebhook']);
