<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Role\CreateRoleRequest;
use App\Http\Requests\Auth\Role\UpdateRoleRequest;
use App\ViewModels\User\RoleIndexViewModel;
use Domain\Auth\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class RoleController extends Controller
{

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.role.index', new RoleIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.role.create');
    }

    public function store(CreateRoleRequest $request): RedirectResponse
    {
        Role::create($request->safe()->toArray());

        flash()->info(__('crud.created', ['entity' => __('entity.role')]));

        return to_route('roles.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.role.edit', compact(['role']));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->fill($request->validated())->save();

        flash()->info(__('crud.updated', ['entity' => __('entity.role')]));

        return to_route('roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        flash()->info(__('crud.deleted', ['entity' => __('entity.role')]));

        return to_route('roles.index');
    }
}
