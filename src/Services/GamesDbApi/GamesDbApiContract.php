<?php

namespace Services\GamesDbApi;

interface GamesDbApiContract
{
    public function getGenres(): array;

    public function getPlatforms(): array;

    public function getGames(): array;

    public function getGame(string $name): array;
}
