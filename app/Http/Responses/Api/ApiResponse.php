<?php

namespace App\Http\Responses\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Support\Enums\ApiErrorCode;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiResponse implements Responsable, Arrayable
{
    private array $data = [];
    private int $status = Response::HTTP_OK;

    public function __construct(
        private readonly ResponseFactory $response
    ) {
    }

    abstract public function type(): string;

    abstract public function links(): array;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function toSuccess(ApiData $data, int $status = Response::HTTP_OK): static
    {
        $this->status = $status;
        $this->data = array_filter([
            'data' => $data->toArray(),
            'links' => $this->links() === [] ? null : $this->links(),
        ]);

        return $this;
    }

    public function toFailure(ApiErrorCode $code, int $status = Response::HTTP_BAD_REQUEST): static
    {
        $this->status = $status;
        $this->data = [
            'errors' => [
                [
                    'id' => $this->type(),
                    'code' => $code->value,
                    'title' => $code->toString()
                ]
            ]
        ];
        return $this;
    }

    /**
     * @param Collection<array-key, ApiData> $items
     * @param int $status
     * @return ApiResponse
     */
    public function toCollection(Collection $items, int $status = Response::HTTP_OK): static
    {
        $this->status = $status;
        $this->data = array_filter([
            'data' => $items->toArray(),
            'links' => $this->links() === [] ? null : $this->links(),
        ]);

        return $this;
    }

    public function toResponse($request): Response
    {
        return $this->response->json(
            $this->data,
            $this->getStatus(),
        );
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
