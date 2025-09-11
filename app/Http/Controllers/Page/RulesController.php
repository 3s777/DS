<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Domain\Page\Models\Page;
use Domain\Page\ViewModels\QaViewModel;

class RulesController extends Controller
{
    public function show(Page $page)
    {
        return view('content.rules.index', compact(['page']));
    }

    public function qa()
    {
        return view('content.rules.qa', new QaViewModel());
    }
}
