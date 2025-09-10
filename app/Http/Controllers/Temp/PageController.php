<?php

namespace App\Http\Controllers\Temp;

use Admin\Shelf\ViewModels\CollectibleUpdateViewModel;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function demoSelect()
    {
        return view('content.demo-select.create', new CollectibleUpdateViewModel());
    }
}
