<?php

namespace Domain\Game\Models\Traits;

use App\Contracts\HasProperties;

trait GameProperties
{
    public static function getProperties($values): ?array
    {
        if($values) {
            $jsonValue = json_decode($values);

            $properties = [];

            if(isset($jsonValue->is_digital)) {
                $properties['is_digital'] = true;
            }

            if(isset($jsonValue->is_done)) {
                $properties['is_done'] = true;
            }

            return $properties;
        }

        return null;
    }

    public static function setProperties($values): ?array
    {
        if($values) {
            $properties = [];

            if(isset($values['is_digital'])) {
                $properties['is_digital'] = true;
            }

            if(isset($values['is_done'])) {
                $properties['is_done'] = true;
            }

            return $properties;
        }

        return null;
    }
}
