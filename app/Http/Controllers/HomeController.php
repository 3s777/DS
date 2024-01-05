<?php

namespace App\Http\Controllers;

use App\Models\CollectableItem;

class HomeController extends Controller
{
    public function __invoke() {

        $collectableItem = CollectableItem::create([
            'name' => 'test',
            'properties' => ['num' => '11','ooo' => ['fff' => 'sfdsdf', 'asfdsadf' => 'asdfsdf'], 'ram' => '542']
        ]);

        dump($collectableItem->properties['ooo']['fff']);

        return view('welcome');
    }
}
