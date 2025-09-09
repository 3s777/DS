<?php

namespace App\Http\Controllers\Temp;

use App\Http\Controllers\Controller;
use Domain\Shelf\ViewModels\CollectibleUpdateViewModel;

class PageController extends Controller
{
    public function demoSelect()
    {
        return view('content.demo-select.create', new CollectibleUpdateViewModel());
    }
}
