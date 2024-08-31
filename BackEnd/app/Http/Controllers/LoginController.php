<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'username' => 'required|unique:login',
            'password' => 'required|min:6',
            'admin' => 'required|boolean',
        ]);


        $validatedData['password'] = Hash::make($validatedData['password']);

        $login = Login::create($validatedData);

        return redirect()->route('logins.index');
    }

    public function index()
    {
        $logins = Login::all();

        $totalLogins= $logins->count();

        return view('subpages.users.index', compact('logins','totalLogins'));
    }

    public function show($id)
    {
        $logins = Login::findOrFail($id);
        return view('subpages.users.show', compact('logins'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'cognome' => 'required',
            'username' => 'required|unique:login,username,'.$id,
            'admin' => 'required|boolean',
        ]);

        $login = Login::findOrFail($id);
        $login->update($validatedData);

        return redirect()->route('logins.index');
    }

    public function destroy($id)
    {
        $login = Login::findOrFail($id);
        $login->delete();


        return redirect()->route('logins.index');
    }

    public function edit($id)
    {
        $login = Login::findOrFail($id);
        return view('subpages.users.edit', compact('login'));

    }

    public function create () {
        return view('subpages.users.create');
    }

    public function authenticated(Request $request, $user)
    {
        // Controlla il valore booleano e reindirizza
        if ($user->boolean_field == 1) {
            return redirect()->away('http://localhost:5174/user');
        }

        // Reindirizza alla dashboard o altra pagina se il booleano è diverso
        return redirect()->intended('/dashboard');
    }

    public function getUserDetails($id) {
        $login = Login::findOrFail($id);
        return response()->json($login);
    }
}

