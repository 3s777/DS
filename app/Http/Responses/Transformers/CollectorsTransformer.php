<?php

namespace App\Http\Responses\Transformers;

use App\Http\Responses\Api\ApiData;
use Domain\Auth\Models\Collector;
use Illuminate\Contracts\Support\Arrayable;

final readonly class CollectorsTransformer implements Arrayable
{
    public function __construct(
        private Collector $collector
    ) {
    }

    public function toArray(): array
    {
        return (new ApiData(
            'collectors',
            $this->collector->getKey(),
            [
                'id' => $this->collector->getKey(),
                'name' => $this->collector->name,
            ]
        ))->toArray();
    }
}
