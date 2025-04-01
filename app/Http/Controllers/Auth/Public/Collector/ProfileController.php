<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Collector\UpdateCollectorProfileRequest;
use Domain\Auth\DTOs\UpdateCollectorProfileDTO;
use Domain\Auth\Services\CollectorProfileService;
use Domain\Auth\ViewModels\Public\CollectorProfileSettingsViewModel;
use Domain\Auth\ViewModels\Public\CollectorProfileViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;


class ProfileController extends Controller
{
    public function show(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.profile.index', new CollectorProfileViewModel());
    }

    public function settings(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.profile.settings', new CollectorProfileSettingsViewModel());
    }

    public function updateSettings(
        UpdateCollectorProfileRequest $request,
        CollectorProfileService $profileService
    ): RedirectResponse
    {
        $profileService->update(UpdateCollectorProfileDTO::fromRequest($request));

        flash()->info(__('user.profile.updated'));

        if($request->input('new_password')) {
            flash()->info(__('user.profile.updated').'. '.__('auth.password_updated'));
        }

        return to_route('profile.settings');
    }

    public function confidential()
    {
        return view('content.profile.confidential');
    }

    public function delete()
    {
        auth('collector')->user()->delete();

        auth('collector')->logout();

        flash()->info(__('user.profile.auth_deleted'));

        return to_route('collector.login');
    }
}
