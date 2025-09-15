<?php

namespace App\Http\Controllers\Api\Auth\Public;

use App\Http\Responses\Transformers\CollectorsTransformer;
use App\Http\Responses\Transformers\ProfileCollectorTransformer;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Domain\Auth\ViewModels\CollectorProfileViewModel;
use Domain\Auth\ViewModels\CollectorsViewModel;
use Illuminate\Support\Facades\Auth;

final class ProfileController
{
    public function index()
    {

        $user = User::find(auth()->id());
        return new ProfileCollectorTransformer($user);
    }
}
