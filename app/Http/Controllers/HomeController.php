<?php

namespace App\Http\Controllers;

use Domain\Game\Models\Genre;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __invoke() {



        $response = Http::get(env('GAME_API_HOST')."/genres?key=".env('GAME_API_KEY'));

        dd($response->body());

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
