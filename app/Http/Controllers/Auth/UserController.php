<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\MassDeletingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\User\CreateUserRequest;
use App\Http\Requests\Auth\User\FilterUserRequest;
use App\Http\Requests\Auth\User\UpdateUserRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Auth\Actions\CreateUserAction;
use Domain\Auth\Actions\UpdateUserAction;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\User;
use Domain\Auth\ViewModels\UserCrudViewModel;
use Domain\Auth\ViewModels\UserIndexViewModel;
use Domain\Auth\ViewModels\UserListSelectViewModel;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\ViewModels\AsyncSelectViewModel;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(FilterUserRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.index', new UserIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.create', new UserCrudViewModel());
    }

    public function store(CreateUserRequest $request, CreateUserAction $action): RedirectResponse
    {
        $action(NewUserDTO::fromRequest($request));

        flash()->info(__('user.created'));

        return to_route('users.index');
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact(['user']));
    }

    public function edit(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.edit', new UserCrudViewModel($user));
    }

    public function update(UpdateUserRequest $request, User $user, UpdateUserAction $action): RedirectResponse
    {
        $action(UpdateUserDTO::fromRequest($request), $user);

        flash()->info(__('user.updated'));

        return to_route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        flash()->info(__('user.deleted'));

        return to_route('users.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function deleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Auth\Models\User',
                $request->input('ids')
            )
        );

        flash()->info(__('user.mass_deleted'));

        return to_route('users.index');
    }

    /**
     * @throws MassDeletingException
     */
    public function forceDeleteSelected(MassDeletingRequest $request, MassDeletingAction $deletingAction): RedirectResponse
    {
        $deletingAction(
            MassDeletingDTO::make(
                'Domain\Auth\Models\User',
                $request->input('ids'),
                true
            )
        );

        flash()->info(__('user.mass_force_deleted'));

        return to_route('users.index');
    }


    public function publicIndex()
    {
        $users = User::all();

        return view('content.users.index', compact('users'));
    }

    public function getForSelect(Request $request): AsyncSelectViewModel
    {
        return new AsyncSelectViewModel(
            $request->input('query'),
            User::class,
            'user.choose'
        );
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
