<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovimentiRicaricaController;
use App\Http\Controllers\OpzioniRicaricaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TipiInterventoController;
use App\Http\Controllers\DettagliContoController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\InterventoController;
use App\Http\Controllers\BraintreePaymentController;
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

// Rotte per la tabella della lista degli utenti
Route::resource('logins', LoginController::class);

// Rotte per la tabella della lista delle opzioni delle ricariche
Route::resource('opzioni_ricarica', OpzioniRicaricaController::class);

// Rotte per la tabella della lista dei tipi di interventi
Route::resource('tipi_intervento', TipiInterventoController::class);

// Rotte per la tabella della lista dei tipi di interventi
Route::resource('dettagli_conto', DettagliContoController::class);

Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');

Route::get('/account', [AccountController::class, 'show'])->name('account.show')->middleware('auth');

Route::post('/intervento/store', [InterventoController::class, 'store'])->name('intervento.store');
Route::get('/registra-intervento', [InterventoController::class, 'create'])->name('intervento.create');

Route::get('/ricarica', function () {
    $user = auth()->user(); // Ottieni l'utente autenticato
    return view('ricarica_intervento.edit', compact('user'));
})->name('editRicaricaIntervento');

Route::post('/ricarica', [PaymentController::class, 'processPayment'])->name('processPayment');

Route::get('users/{user}/movimenti', [MovimentiRicaricaController::class, 'showUserMovimenti'])->name('users.movimenti');

Route::resource('movimenti_ricarica', MovimentiRicaricaController::class);

Route::get('pagamenti', [BraintreePaymentController::class, 'showPaymentForm'])->name('braintree.form');
Route::post('pagamenti', [BraintreePaymentController::class, 'processPayment'])->name('braintree.process');



require __DIR__.'/auth.php';
