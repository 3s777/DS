<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\CreateUserRequest;
use App\ViewModels\User\UserCreateViewModel;
use App\ViewModels\User\UserIndexViewModel;
use App\ViewModels\User\UserListSelectViewModel;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', new UserIndexViewModel());
    }

    public function create()
    {
        return view('admin.user.create', new UserCreateViewModel());
    }

    public function store(CreateUserRequest $request, RegisterNewUserContract $action): RedirectResponse
    {
        $action(NewUserDTO::fromRequest($request));

        flash()->info(__('crud.created', ['entity' => __('entity.user')]));

        return to_route('users.index');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', new UserCreateViewModel($user));
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
