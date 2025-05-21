<?php

namespace App\Http\Controllers\Game\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\Admin\CreateGameMediaVariationRequest;
use App\Http\Requests\Game\Admin\FilterGameMediaVariationRequest;
use App\Http\Requests\Game\Admin\UpdateGameMediaVariationRequest;
use App\Http\Requests\MassDeletingRequest;
use Domain\Game\DTOs\FillGameMediaVariationDTO;
use Domain\Game\Models\GameMediaVariation;
use Domain\Game\Services\GameMediaVariationService;
use Domain\Game\ViewModels\Admin\GameMediaVariationIndexViewModel;
use Domain\Game\ViewModels\Admin\GameMediaVariationUpdateViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Support\Actions\MassDeletingAction;
use Support\DTOs\MassDeletingDTO;
use Support\Exceptions\MassDeletingException;
use Support\ViewModels\AsyncSelectByQueryViewModel;

class GameMediaVariationController extends Controller
{
    public function __construct()
    {
//        $this->authorizeResource(GameMediaVariation::class, 'game_media_variation');
    }

    public function show(string $id)
    {
        return view();
    }
}
