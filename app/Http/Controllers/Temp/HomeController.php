<?php

namespace App\Http\Controllers\Temp;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}
