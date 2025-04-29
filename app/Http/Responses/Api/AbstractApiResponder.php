<?php

namespace App\Http\Responses\Api;

use App\Contracts\Api\ResponderContract;

abstract class AbstractApiResponder implements ResponderContract
{
    abstract public function type(): string;

    abstract public function links(): array;

    public function successResponse(string $id, array $attributes): array
    {
        return [
            'data' => [
              'type' => $this->type(),
              'id' => $id,
              'attributes' =>$attributes,
            ],
            'links' => $this->links() === [] ? null : $this->links(),
        ];
    }

    public function errorResponse(string $code, string $title): array
    {
        return [
            'errors' => [
                [
                    'id' => $this->type(),
                    'code' => $code,
                    'title' => $title
                ]
            ]
        ];
    }
}
