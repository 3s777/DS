<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;
use Throwable;
use App\Http\Responses\Api\CollectorsCollectorsshowResolver;
use App\Http\Responses\Api\CollectorsCollectorsshowResponder;

final class CollectorsController
{
    public function collectorsshow(string $slug,CollectorsCollectorsshowResolver $resolver, CollectorsCollectorsshowResponder $responder): Response
    {
        try {
            return $responder->respond(
                $resolver->with($slug,)
            );
        } catch (Throwable $e) {
            return $responder->error($e);
        }
    }

}
