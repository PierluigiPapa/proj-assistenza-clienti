<?php

namespace App\Http\Controllers;

use App\Models\User; // Assicurati di importare il modello User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.index', compact('users'));
    }
}

