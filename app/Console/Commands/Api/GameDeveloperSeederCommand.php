<?php

namespace App\Console\Commands\Api;

use App\Console\BaseCommand;
use App\Models\ApiStagingData;
use Database\Seeders\Api\GameDeveloperToStagingSeeder;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Collection;

class GameDeveloperSeederCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:seed_game_developer';

    protected $description = 'Seed Game Developers from Api to staging table';

    public function handle(): int
    {
        $bar = $this->output->createProgressBar(ApiStagingData::query()->where('data_type', 'game')->count());

        $bar->start();

        $developerSeeder = new GameDeveloperToStagingSeeder();

        ApiStagingData::query()
            ->where('data_type', 'game')
            ->chunkById(100, function (Collection $games) use ($developerSeeder, $bar) {
                foreach ($games as $game) {
                    if (isset($game['data']['developers'])) {
                        foreach ($game['data']['developers'] as $developer) {
                            $developerSeeder->runById($developer['id']);
                        }
                    }

                    $bar->advance();
                }

                sleep(1);
            });

        $bar->finish();

        return self::SUCCESS;
    }
}
