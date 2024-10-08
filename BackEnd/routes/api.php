<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NewPaymentController;
use App\Http\Controllers\LoginController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user-details', function (Request $request) {
    return $request->user();
});

Route::get('/user-details/{id}', [LoginController::class, 'getUserDetails']);


// Cambia la route di post per utilizzare il nuovo controller
Route::post('/process-payment', [NewPaymentController::class, 'handlePayment']);

Route::get('/authenticated-user', [LoginController::class, 'getAuthenticatedUser']);

