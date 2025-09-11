<?php

namespace App\Admin\Http\Controllers\Auth;

use Admin\Auth\DTOs\FillPermissionDTO;
use Admin\Auth\Services\PermissionService;
use Admin\Auth\ViewModels\PermissionIndexViewModel;
use App\Admin\Http\Requests\Auth\CreatePermissionRequest;
use App\Admin\Http\Requests\Auth\UpdatePermissionRequest;
use App\Http\Controllers\Controller;
use Domain\Auth\Models\Permission;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PermissionController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.permission.index', new PermissionIndexViewModel());
    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.permission.create');
    }

    public function store(CreatePermissionRequest $request, PermissionService $permissionService): RedirectResponse
    {
        $permissionService->create(FillPermissionDTO::fromRequest($request));

        flash()->info(__('user.permission.created'));

        return to_route('admin.permissions.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Permission $permission): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.user.permission.edit', compact(['permission']));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission, PermissionService $permissionService): RedirectResponse
    {
        $permissionService->update($permission, FillPermissionDTO::fromRequest($request));

        flash()->info(__('user.permission.updated'));

        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        flash()->info(__('user.permission.deleted'));

        return to_route('admin.permissions.index');
    }
}
