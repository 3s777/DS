<?php

namespace Services\GamesDbApi;

use Domain\Game\DTOs\ApiGamesDTO;
use Illuminate\Support\Facades\Http;

class GamesApi implements GamesDbApiContract
{
    protected string $host;

    protected string $key;

    public function __construct()
    {
        $this->host = env('GAME_API_HOST');
        $this->key = env('GAME_API_KEY');
    }

    public function getGenres($page): array
    {
        $response = Http::get($this->host."/genres?key=".$this->key);

        return $response->json('results');
    }

    public function getPlatforms($page): array
    {
        $response = Http::get($this->host."/platforms/lists/parents?key=".$this->key);

        return $response->json('results');
    }

    public function getGames(int $page): array
    {
        $games = [];
        for ($i = 1; $i <= $page; $i++) {

            $response = Http::get($this->host."/games?key=$this->key&page=$i");

            foreach ($response->json('results') as $game) {
                $currentGame = $this->getGame($game['id']);

                $games[] = ApiGamesDTO::make(
                    $currentGame['name'],
                    $currentGame['alternative_names'],
                    $currentGame['released'],
                    $currentGame['description'],
                    $currentGame['publishers'],
                    $currentGame['developers'],
                    $currentGame['genres'],
                    $currentGame['platforms'],
                );
            }


        }

        return $games;
    }

    public function getGame(string $name): array
    {
        $response = Http::get($this->host."/games/$name?key=$this->key");

        return $response->json();
    }

    public function getGamesByPlatform(int $platform, int $page): array
    {
        $games = [];

        $response = Http::get($this->host."/games?key=$this->key&platforms=$platform&page=$page");

        foreach ($response->json('results') as $game) {
            $currentGame = $this->getGame($game['id']);

            $games[] = ApiGamesDTO::make(
                $currentGame['name'],
                $currentGame['alternative_names'],
                $currentGame['released'],
                $currentGame['description'],
                $currentGame['publishers'],
                $currentGame['developers'],
                $currentGame['genres'],
                $currentGame['platforms'],
            );
        }


        return $games;
    }
}
