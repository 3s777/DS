<?php

namespace Support\Traits;

use Illuminate\Pipeline\Pipeline;

trait QueryFiltered
{
    public function filtered(?array $filters = null, ?string $key = 'filters', bool $is_admin = false)
    {

        if($is_admin) {
            $filters = $filters ?? $this->model->availableFilters(true);
        } else {
            $filters = $filters ?? $this->model->availableFilters();
        }

        if (request($key)) {
            return app(Pipeline::class)
                ->send($this)
                ->through(filters($filters))
                ->thenReturn();
        }

        // Add filters for rendering filter->view()
        filters($this->model->availableFilters());
        return $this;
    }


}
