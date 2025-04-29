<?php

namespace App\Console\Commands\Api;

use App\Console\BaseCommand;
use Database\Seeders\Api\GameStagingSeeder;
use Database\Seeders\Api\PlatformStagingSeeder;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class PlatformsSeederCommand extends BaseCommand implements PromptsForMissingInput
{
    protected $signature = 'ds:seed_platform';

    protected $description = 'Seed Platforms from Api to staging table';

    public function handle(): int
    {
        $startPage = $this->ask('Number of page');
        $endPage = $this->ask('Count of pages');

        $bar = $this->output->createProgressBar(($endPage + 1) - $startPage);

        $bar->start();

        $platformSeeder = new PlatformStagingSeeder();

        for ($page = $startPage; $page <= $endPage; $page++) {
            $platformSeeder->run($page);

            $bar->advance();
        }

        $bar->finish();

        return self::SUCCESS;
    }
}
