<?php

namespace App\Http\Controllers\Auth\Public\Collector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Collector\UpdateCollectorProfileRequest;
use Domain\Auth\Actions\VerifyEmailAction;
use Domain\Auth\DTOs\UpdateCollectorProfileDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Collector;
use Domain\Auth\Services\CollectorProfileService;
use Domain\Auth\ViewModels\Public\CollectorProfileSettingsViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Throwable;


class ProfileController extends Controller
{
    public function show(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.profile.index');
    }

    public function settings(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('content.profile.index', new CollectorProfileSettingsViewModel());
    }

    public function updateSettings(UpdateCollectorProfileRequest $request, CollectorProfileService $profileService)
    {
        $profileService->update(UpdateCollectorProfileDTO::fromRequest($request));
//
//        $collector->first_name = 'xxx';


//        $test = Collector::find(1);
//        $test->first_name = 'sdsfff';
//        $test->save();
////        dd($test);

//        $new = Collector::find($collector->id);
//        $new->first_name = 'xxx';
//        $new->save();
//
        flash()->info(__('collector.updated'));
//
        return to_route('profile.settings');
    }
}
