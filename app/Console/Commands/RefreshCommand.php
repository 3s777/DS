<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    protected $signature = 'ds:refresh';

    protected $description = 'Refresh';

    public function handle(): int
    {
        if (app()->isProduction()) {
            return self::FAILURE;
        }

        $this->call('cache:clear');

//        $this->call('migrate:fresh', [
//            '--seed' => true,
//        ]);

        $this->call('migrate:refresh', [
            '--seed' => true,
        ]);

        return self::SUCCESS;
    }
}
