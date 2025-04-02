<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Role\CreateRoleRequest;
use App\Http\Requests\Auth\Role\UpdateRoleRequest;
use Domain\Auth\DTOs\FillRoleDTO;
use Domain\Auth\Models\Role;
use Domain\Auth\Services\RoleService;
use Domain\Auth\ViewModels\Admin\RoleIndexViewModel;
use Domain\Auth\ViewModels\Admin\RoleUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.role.index', new RoleIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.role.create', new RoleUpdateViewModel());
    }

    public function store(CreateRoleRequest $request, RoleService $roleService): RedirectResponse
    {
        $roleService->create(FillRoleDTO::fromRequest($request));

        flash()->info(__('user.role.created'));

        return to_route('admin.roles.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Role $role): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.role.edit', new RoleUpdateViewModel($role));
    }

    public function update(UpdateRoleRequest $request, Role $role, RoleService $roleService): RedirectResponse
    {
        $roleService->update($role, FillRoleDTO::fromRequest($request));

        flash()->info(__('user.role.updated'));

        return to_route('admin.roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();

        flash()->info(__('user.role.deleted'));

        return to_route('admin.roles.index');
    }
}
