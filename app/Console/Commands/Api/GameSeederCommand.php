<?php

namespace App\Console\Commands\Api;

use App\Console\BaseCommand;
use Database\Seeders\Api\GameToStagingSeeder;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class GameSeederCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:seed_game';

    protected $description = 'Seed Games from Api to staging table';

    public function handle(): int
    {
        $startPage = $this->ask('Start page');
        $endPage = $this->ask('End page');

        $bar = $this->output->createProgressBar(($endPage + 1) - $startPage);

        $bar->start();

        $gameSeeder = new GameToStagingSeeder();

        for ($page = $startPage; $page <= $endPage; $page++) {
            $gameSeeder->run($page);

            $bar->advance();
        }

        $bar->finish();

        return self::SUCCESS;
    }
}
