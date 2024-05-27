<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\CreateUserRequest;
use App\Http\Requests\Auth\User\UpdateUserRequest;
use App\Http\Requests\MassDeletingRequest;
use App\ViewModels\User\UserCreateViewModel;
use App\ViewModels\User\UserIndexViewModel;
use App\ViewModels\User\UserListSelectViewModel;
use Domain\Auth\Actions\UpdateUserAction;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;

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

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $action)
    {
        $action(UpdateUserDTO::fromRequest($request), $user);

        flash()->info(__('crud.updated', ['entity' => __('entity.user')]));

        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->forceDelete();

        flash()->info(__('crud.deleted', ['entity' => __('entity.user')]));

        return to_route('users.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction)
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Auth\Models\User',
                $request->input('ids')
            )
        );

        flash()->info(__('crud.mass_deleted', ['entity' => __('entity.user_c')]));

        return to_route('users.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction)
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Auth\Models\User',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('crud.mass_force_deleted', ['entity' => __('entity.user_c')]));

        return to_route('users.index');
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

}
