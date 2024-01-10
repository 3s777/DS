<?php

namespace Services\GamesDbApi;

interface GamesDbApiContract
{
    public function getGenres(): array;

    public function getPlatforms(): array;
}
