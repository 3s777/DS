<?php

namespace App\Http\Controllers;

use Domain\Auth\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('content.users.index', compact('users'));
    }
}
