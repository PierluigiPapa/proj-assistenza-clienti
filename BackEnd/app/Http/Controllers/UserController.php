<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request) {
        // Ottieni il valore del parametro di ricerca
        $search = $request->input('search');

        // Filtra gli utenti in base al parametro di ricerca, se presente
        if ($search) {
            $users = Login::where('id', $search)->with('movimentiRicarica', 'dettagliConto')->get();
        } else {
            $users = Login::with('movimentiRicarica', 'dettagliConto')->get();
        }

        // Conta il numero totale di utenti
        $totalUsers = $users->count();

        // Passa i dati alla vista
        return view('pages.index', compact('users', 'totalUsers'));
    }


    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'username' => 'required|unique:login',
            'password' => 'required|min:6',
            'admin' => 'required|boolean',
        ]);

        $user = new Login([
            'nome' => $request->get('nome'),
            'cognome' => $request->get('cognome'),
            'username' => $request->get('username'),
            'password' => bcrypt($request->get('password')),
            'admin' => $request->get('admin'),
        ]);

        $user->save();

        return redirect('/users')->with('success', 'User saved!');
    }


    public function show($id) {
        $user = Login::find($id);

        if (!$user) {
            return redirect('/users')->with('error', 'User not found!');
        }

        // Genera un codice utente con uno zero davanti all'ID
        $userCode = '0' . str_pad($id, 2, '0', STR_PAD_LEFT);

        return view('pages.show', compact('user', 'userCode'));
    }


    public function edit($id)
    {
        $user = Login::findOrFail($id);
        return view('pages.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'username' => 'required|unique:login,username,'.$id,
            'admin' => 'required|boolean',
        ]);

        $user = Login::findOrFail($id);
        $user->nome = $request->get('nome');
        $user->cognome = $request->get('cognome');
        $user->username = $request->get('username');
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $user->admin = $request->get('admin');
        $user->save();

        return redirect('/users')->with('success', 'User updated!');
    }

    public function destroy($id)
    {
        $user = Login::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }
}
