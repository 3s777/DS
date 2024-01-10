<?php

namespace App\Http\Controllers;

use Domain\Game\Models\Genre;
use Illuminate\Support\Facades\Http;
use Services\GamesDbApi\GamesDbApiContract;

class HomeController extends Controller
{
    public function __invoke() {



//        $response = Http::get(env('GAME_API_HOST')."/genres?key=".env('GAME_API_KEY'));



        $platforms = app(GamesDbApiContract::class);
        dd($platforms->getPlatforms());

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
