<?php

namespace App\Http\Controllers\Api\Auth\Public;

use App\Http\Responses\Transformers\CollectorsTransformer;
use Domain\Auth\Models\Collector;
use Domain\Auth\ViewModels\Public\CollectorsViewModel;

final class CollectorsController
{
    public function index(CollectorsViewModel $viewModel)
    {
        $col = $viewModel->collectors();
        //
        //        $col->getCollection()->transform(fn(Collector $collector) => new ApiData(
        //            'collector',
        //                $collector->getKey(),
        //            $collector->toArray()
        //        ));



        $col->getCollection()->transform(fn (Collector $collector) => (new CollectorsTransformer($collector)));

        return $col;
    }
}
