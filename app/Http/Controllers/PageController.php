<?php

namespace App\Http\Controllers;

use Domain\Shelf\ViewModel\CollectibleUpdateViewModel;

class PageController extends Controller
{
    public function demoSelect()
    {
        return view('content.demo-select.create', new CollectibleUpdateViewModel());
    }
}
