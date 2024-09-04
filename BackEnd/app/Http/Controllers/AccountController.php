<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class AccountController extends Controller
{
    /**
     * Mostra il profilo utente.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = Login::findOrFail($id);
        return view('account.show', compact('user'));
    }
}
