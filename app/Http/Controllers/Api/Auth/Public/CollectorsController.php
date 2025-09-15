<?php

namespace App\Http\Controllers\Api\Auth\Public;

use App\Http\Responses\Transformers\CollectorsTransformer;
use Domain\Auth\Models\Collector;
use Domain\Auth\ViewModels\CollectorsViewModel;

final class CollectorsController
{
    public function index(CollectorsViewModel $viewModel)
    {
        $collectors = $viewModel->collectors();
        //
        //        $col->getCollection()->transform(fn(Collector $collector) => new ApiData(
        //            'collector',
        //                $collector->getKey(),
        //            $collector->toArray()
        //        ));



        $collectors->getCollection()->transform(fn (Collector $collector) => (new CollectorsTransformer($collector)));

        return $collectors;
    }
}
