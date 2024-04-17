<?php

namespace App\View\Components\Common\ActionTable;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectAll extends Component
{

    public function __construct(
        public $models,
        public string $ids = '',
        public string $names = '',
    )
    {
        foreach($models as $model) {
            $this->ids .= "'$model->id',";
            $this->names .= "'$model->name',";
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.common.action-table.select-all');
    }
}
