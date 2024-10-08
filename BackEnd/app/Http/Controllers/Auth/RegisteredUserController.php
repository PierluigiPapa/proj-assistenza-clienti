<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\DettagliConto;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validazione dei dati in ingresso
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:login'], // Usare la tabella `login`
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Creazione del nuovo utente
        $user = Login::create([
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'admin' => $request->has('is_admin') ? 1 : 0, // Imposta il valore di admin
        ]);

        // Creazione del record nella tabella `dettagli_conto`
        DettagliConto::create([
            'IDLogin' => $user->id,
            'saldo' => '00:00:00', // Imposta il saldo iniziale
        ]);

        // Evento di registrazione
        event(new Registered($user));

        // Login dell'utente
        Auth::login($user);

        // Reindirizzamento basato sul ruolo dell'utente
        if ($user->admin) {
            // Se l'utente è amministratore, reindirizza all'area amministrativa
            return redirect('/index'); // Area amministratore
        } else {
            // Se l'utente è normale, reindirizza all'area utente
            return redirect('/account'); // Area utente
        }
    }
}
