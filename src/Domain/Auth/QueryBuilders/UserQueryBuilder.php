<?php

namespace Domain\Auth\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Support\Traits\QueryFiltered;
use Support\Traits\QuerySorted;

class UserQueryBuilder extends Builder
{
    use QueryFiltered;
    use QuerySorted;
}
