<?php

namespace Support\Models;

use Illuminate\Database\Eloquent\Model;

class ApiStagingData extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'data' => 'json'
    ];
}
