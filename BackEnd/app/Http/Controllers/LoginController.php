<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Create
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

        return response()->json($login, 201);
    }

    public function index()
    {
        $logins = Login::all();
        return view('subpages.users.index', compact('logins'));
    }

    public function show($id)
    {
        $logins = Login::findOrFail($id);
        return view('subpages.users.show', compact('logins'));
    }

    // Update
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

        return response()->json($login);
    }

    // Delete
    public function destroy($id)
    {
        $login = Login::findOrFail($id);
        $login->delete();

        return response()->json(null, 204);
    }
}
