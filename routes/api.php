<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ReportController;



Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/createuser', [AuthController::class, 'createUser']);

Route::get('mytransactions', [TransactionController::class, 'userTransactions'])->middleware('auth:sanctum');

Route::prefix('admin')->middleware(['auth:sanctum','admin'])->group(function () {

  Route::get('/transactions', [TransactionController::class, 'index']);
  Route::post('/transactions/create', [TransactionController::class, 'store']);
  Route::put('/transactions/{transaction}', [TransactionController::class, 'updateStatus']);
  Route::post('payment/create', [PaymentController::class,'storePayments']);
  Route::get('reports/generate', [ReportController::class, 'generateReports']);

});

