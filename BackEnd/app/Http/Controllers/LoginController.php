<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

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

        return redirect('/logins');
    }

    public function edit($id)
    {
        $login = Login::findOrFail($id);
        return view('subpages.users.edit', compact('login'));

    }

    public function create () {
        return view('subpages.users.create');
    }

}

