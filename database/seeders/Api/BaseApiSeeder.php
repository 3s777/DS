<?php

namespace Database\Seeders\Api;

use Illuminate\Database\Seeder;

class BaseApiSeeder extends Seeder
{
    public function __construct(
        protected ?string $host = null,
        protected ?string $key = null
    ) {
        $this->host = config('api.games_host');
        $this->key = config('api.games_key');
    }
}
