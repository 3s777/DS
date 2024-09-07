<?php

namespace Domain\Shelf\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Support\Traits\QueryFiltered;
use Support\Traits\QuerySorted;

class ShelfQueryBuilder extends Builder
{
    use QueryFiltered;
    use QuerySorted;
}
