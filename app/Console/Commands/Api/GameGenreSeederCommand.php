<?php

namespace App\Console\Commands\Api;

use App\Console\BaseCommand;
use Database\Seeders\Api\GameGenreToStagingSeeder;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class GameGenreSeederCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:seed_genre';

    protected $description = 'Seed Genres from Api to staging table';

    public function handle(): int
    {
        $bar = $this->output->createProgressBar(1);

        $bar->start();

        $genreSeeder = new GameGenreToStagingSeeder();

        $genreSeeder->run();

        $bar->advance();

        $bar->finish();

        return self::SUCCESS;
    }
}
