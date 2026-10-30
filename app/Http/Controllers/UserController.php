<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }
}