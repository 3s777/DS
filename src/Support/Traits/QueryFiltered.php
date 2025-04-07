<?php

namespace Support\Traits;

use Illuminate\Pipeline\Pipeline;

trait QueryFiltered
{
    public function filteredAdmin(?array $filters = null, ?string $key = 'filters')
    {
        $filters = $filters ?? $this->model->availableAdminFilters();

        if (request($key)) {
            return app(Pipeline::class)
                ->send($this)
                ->through(filters($filters))
                ->thenReturn();
        }

        // Add filters for rendering filter->view()
        filters($filters);
        return $this;
    }


    public function filtered(?array $filters = null, ?string $key = 'filters')
    {
        $filters = $filters ?? $this->model->availableFilters();

        if (request($key)) {
            return app(Pipeline::class)
                ->send($this)
                ->through(filters($filters))
                ->thenReturn();
        }

        filters($filters);
        return $this;
    }


}
