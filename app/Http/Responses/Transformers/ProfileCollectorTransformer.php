<?php

namespace App\Http\Responses\Transformers;

use App\Http\Responses\Api\ApiData;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Illuminate\Contracts\Support\Arrayable;

final readonly class ProfileCollectorTransformer implements Arrayable
{
    public function __construct(
        private User $user
    ) {
    }

    public function toArray(): array
    {
        return (new ApiData(
            'collector',
            $this->user->getKey(),
            [
                'id' => $this->user->getKey(),
                'name' => $this->user->name,
                'slug' => $this->user->slug
            ]
        ))->toArray();
    }
}
