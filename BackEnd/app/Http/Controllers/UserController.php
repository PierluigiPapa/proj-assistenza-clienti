<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Read: mostra tutti gli utenti
    public function index()
    {
        $users = Login::with('movimentiRicarica')->get();
        $totalUsers = $users->count();
        return view('pages.index', compact('users', 'totalUsers'));
    }

    // Create: mostra il form per creare un nuovo utente
    public function create()
    {
        return view('pages.create');
    }

    // Store: salva un nuovo utente nel database
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

    // Show: mostra un singolo utente
    public function show($id)
    {
        $user = Login::find($id);
        if (!$user) {
            return redirect('/users')->with('error', 'User not found!');
        }
        return view('pages.show', compact('user'));
    }

    // Edit: mostra il form per modificare un utente esistente
    public function edit($id)
    {
        $user = Login::findOrFail($id);
        return view('pages.edit', compact('user'));
    }

    // Update: aggiorna un utente esistente nel database
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

    // Delete: elimina un utente dal database
    public function destroy($id)
    {
        $user = Login::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }
}
