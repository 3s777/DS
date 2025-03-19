<?php

namespace Support\Traits;

use Illuminate\Pipeline\Pipeline;

trait QueryFiltered
{
    public function filtered()
    {
        if (request('filters')) {
            return app(Pipeline::class)
                ->send($this)
                ->through(filters($this->model->availableFilters()))
                ->thenReturn();
        }

        // Add filters for rendering filter->view()
        filters($this->model->availableFilters());
        return $this;
    }
}
