<?php

namespace App\Http\Controllers;

use App\Models\CollectableItem;
use Domain\Game\Models\Genre;
use Illuminate\Support\Facades\Http;
use Services\GamesDbApi\GamesDbApiContract;

class HomeController extends Controller
{
    public function __invoke() {



//        $response = Http::get(env('GAME_API_HOST')."/genres?key=".env('GAME_API_KEY'));

//        $c = CollectableItem::createOrFirst([
//            'name' => 'sdfdsf11',
//            'properties' => ['xxx', 'nn1n']
//        ]);
//
//        dd($c);

        $platforms = app(GamesDbApiContract::class);

        $games = $platforms->getGames();
        dd($games[0]);

        $genres = $response->json('results');
        foreach ($genres as $genre) {
            Genre::create([
                'name' => $genre['name'],
            ]);
        }

        dump($response->json('results'));

        return view('welcome');
    }
}
