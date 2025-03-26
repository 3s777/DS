<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Permission\CreatePermissionRequest;
use App\Http\Requests\Auth\Permission\UpdatePermissionRequest;
use Domain\Auth\Models\Permission;
use Domain\Auth\ViewModels\PermissionIndexViewModel;
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

    public function store(CreatePermissionRequest $request): RedirectResponse
    {
        Permission::create($request->safe()->toArray());

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

    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $permission->fill($request->validated())->save();

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
