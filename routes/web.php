<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisbursementController;




Route::get('/', [DisbursementController::class,'index'])->name('home'); //list of disbursements
Route::get('create',[DisbursementController::class,'create'])->name('create');
Route::post('create',[DisbursementController::class,'store']) ;
//Route::post('/webhook',[WebhookController::class,'SetUpWebhook']); //setup webhook {url : 'url'}
