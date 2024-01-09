<?php

namespace Services\GamesDbApi;

use Illuminate\Support\Facades\Http;

class GamesApi implements GamesDbApiContract
{
    protected string $host;

    protected string $key;

    public function __construct() {
        $this->host = env('GAME_API_HOST');
        $this->key = env('GAME_API_KEY');
    }

    public function getGenres(): array
    {
        $response = Http::get($this->host."/genres?key=".$this->key);

        return $response->json('results');
    }
}
