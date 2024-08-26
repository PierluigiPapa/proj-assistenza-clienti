<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MovimentiRicaricaController;
use App\Http\Controllers\NewPaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/index', [UserController::class, 'index']);

Route::resource('users', UserController::class);

// Rotte per gestire le opzioni di ricarica //
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
Route::delete('/movimentiRicarica/{id}', [MovimentiRicaricaController::class, 'destroy'])->name('movimentiRicarica.destroy');
Route::post('/handlePayment', [NewPaymentController::class, 'handlePayment'])->name('handlePayment');





require __DIR__.'/auth.php';
