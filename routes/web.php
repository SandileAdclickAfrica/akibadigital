<?php

use App\Http\Controllers\FundingController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','FundingController');

Route::post('/', [FundingController::class, 'webhook']);
