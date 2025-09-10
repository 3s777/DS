<?php

namespace App\Http\Controllers\Game\Public;

use App\Http\Controllers\Controller;
use Domain\Game\Models\GameMediaVariation;
use Domain\Game\ViewModels\GameVariationShowViewModel;

class GameMediaVariationController extends Controller
{
    public function __construct()
    {
        //        $this->authorizeResource(GameMediaVariation::class, 'game_media_variation');
    }

    public function show(GameMediaVariation $gameMediaVariation)
    {
        return view('content.variation.game', new GameVariationShowViewModel($gameMediaVariation));
    }
}
