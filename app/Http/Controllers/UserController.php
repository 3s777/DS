<?php

namespace App\Http\Controllers;

use App\ViewModels\User\UserListSelectViewModel;
use Domain\Auth\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('content.users.index', compact('users'));
    }

    public function getUsers(Request $request): UserListSelectViewModel
    {
        return new UserListSelectViewModel($request->input('query'));
    }

    public function findUsers($param = null)
    {
        $users = null;

        if ($param) {
            $users = User::where('name', 'LIKE', '%'.$param.'%')->get();
        } else {
            $users = User::all();
        }

        return response()->json($users);
    }
}
