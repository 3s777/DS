<?php

namespace Services\GamesDbApi;

interface GamesDbApiContract
{
    public function getGenres(int $page): array;

    public function getPlatforms(int $page): array;

    public function getGames(int $page): array;

    public function getGame(string $name): array;

    public function getGamesByPlatform(int $platform, int $page): array;
}
