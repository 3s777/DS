<?php

namespace Support\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FeaturedScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->select([
                'media.id',
                'media.model_type',
                'media.model_id',
                'media.collection_name',
                'media.created_at',
                'media.file_name',
                'media.disk',
                'media.generated_conversions'
            ]
        )
            ->where('collection_name', 'featured_image')
            ->limit(1);
    }
}
