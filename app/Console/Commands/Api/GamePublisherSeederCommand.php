<?php

namespace App\Console\Commands\Api;

use App\Console\BaseCommand;
use Database\Seeders\Api\GamePublisherToStagingSeeder;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Collection;
use Models\ApiStagingData;

class GamePublisherSeederCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:seed_game_publisher';

    protected $description = 'Seed Game Publishers from Api to staging table';

    public function handle(): int
    {
        $bar = $this->output->createProgressBar(ApiStagingData::query()->where('data_type', 'game')->count());

        $bar->start();

        $publisherSeeder = new GamePublisherToStagingSeeder();

        ApiStagingData::query()
            ->where('data_type', 'game')
            ->chunkById(100, function (Collection $games) use ($publisherSeeder, $bar) {
                foreach ($games as $game) {
                    if (isset($game['data']['publishers'])) {
                        foreach ($game['data']['publishers'] as $publisher) {
                            $publisherSeeder->runById($publisher['id']);
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
