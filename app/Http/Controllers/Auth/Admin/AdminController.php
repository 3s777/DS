<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\CreateAdminRequest;
use App\Http\Requests\Auth\Admin\FilterAdminRequest;
use App\Http\Requests\Auth\Admin\UpdateAdminRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Auth\Actions\CreateAdminAction;
use Domain\Auth\Actions\UpdateAdminAction;
use Domain\Auth\DTOs\NewAdminDTO;
use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\User;
use Domain\Auth\ViewModels\AdminIndexViewModel;
use Domain\Auth\ViewModels\AdminUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    //    protected function resourceAbilityMap(): array
    //    {
    //        return array_merge(parent::resourceAbilityMap(), [
    //            'getForSelect' => 'getForSelect'
    //        ]);
    //    }

    public function index(FilterAdminRequest $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.user.index', new AdminIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.user.create', new AdminUpdateViewModel());
    }

    public function store(CreateAdminRequest $request, CreateAdminAction $action): RedirectResponse
    {
        $action(NewAdminDTO::fromRequest($request));

        flash()->info(__('user.created'));

        return to_route('admin.users.index');
    }

    public function show(User $user)
    {
        return view('admin.user.user.show', compact(['user']));
    }

    public function edit(User $user): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.user.edit', new AdminUpdateViewModel($user));
    }

    public function update(UpdateAdminRequest $request, User $user, UpdateAdminAction $action): RedirectResponse
    {
        $action(UpdateUserDTO::fromRequest($request), $user);

        flash()->info(__('user.updated'));

        return to_route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        flash()->info(__('user.deleted'));

        return to_route('admin.users.index');
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

        return to_route('admin.users.index');
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

        return to_route('admin.users.index');
    }


    public function publicIndex()
    {
        $users = User::all();

        return view('content.users.index', compact('users'));
    }

    public function getForSelect(Request $request): AsyncSelectByQueryViewModel
    {
        Gate::authorize('getForSelect', User::class);

        return new AsyncSelectByQueryViewModel(
            $request->input('query'),
            User::class,
            trans_choice('user.choose', 1)
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
