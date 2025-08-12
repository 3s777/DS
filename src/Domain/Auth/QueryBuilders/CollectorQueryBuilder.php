<?php

namespace Domain\Auth\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Support\Traits\QueryFiltered;
use Support\Traits\QuerySorted;

class CollectorQueryBuilder extends Builder
{
    use QueryFiltered;
    use QuerySorted;
}
