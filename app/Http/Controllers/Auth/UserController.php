<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ViewModels\User\UserIndexViewModel;
use App\ViewModels\User\UserListSelectViewModel;
use Domain\Auth\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', new UserIndexViewModel());
    }

    public function publicIndex()
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

    public function destroy(User $user)
    {
        $user->forceDelete();

        flash()->info(__('game.developer.deleted'));

        return to_route('game-developers.index');
    }
}
