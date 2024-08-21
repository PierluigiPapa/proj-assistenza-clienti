<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = Login::all();
        return view('pages.index', compact('users'));
    }
}

