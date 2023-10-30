<?php

namespace App\View\Components\Grid;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Col extends Component
{
    public bool $noGap;
    public int $xl;
    public int $ls;
    public int $lg;
    public int $md;
    public int $sm;

    public function __construct(
        bool $noGap = false,
        int $xl = 0,
        int $ls = 0,
        int $lg = 0,
        int $md = 0,
        int $sm = 0,
    )
    {
        $this->noGap = $noGap;
        $this->xl = $xl;
        $this->ls = $ls;
        $this->lg = $lg;
        $this->md = $md;
        $this->sm = $sm;
    }

    public function col (): string
    {
        $colName = 'col';

        if($this->noGap) {
            $colName = 'col-ng';
        }

        $sizes = [
            'xl' => $this->xl,
            'ls' => $this->ls,
            'lg' => $this->lg,
            'md' => $this->md,
            'sm' => $this->sm,
        ];

        $fullColName = '';

        foreach ($sizes as $name => $size) {
            if($size > 0) {
                $fullColName .= $colName . '-'.$name.'-' .$size.' ';
            }
        }

        return trim($fullColName);
    }

    public function render(): View|Closure|string
    {
        return view('components.grid.col');
    }
}
