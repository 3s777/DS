<?php

declare(strict_types=1);

namespace App\Http\Responses\Api;

use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;
use App\Contracts\Api\ResponderContract;
use App\Contracts\Api\ResponseResolverContract;
use Throwable;
use App\Http\Responses\Api\CollectorsCollectorsindexResolver;

/**
* @implements ResponderContract<CollectorsCollectorsindexResolver>
**/
class CollectorsCollectorsindexResponder implements ResponderContract
{
    public function __construct(private readonly ResponseFactory $response)
    {

    }

    public function respond(ResponseResolverContract $resolver): Response
    {
        return $this->response->json([]);
    }

    public function error(Throwable $e): Response
    {
        return $this->response->json([]);
    }
}
