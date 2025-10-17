<?php

use Intervention\Image\Drivers\Gd\Driver;

return [
    'driver' => 'media_library',
    'disk' => 'images',
    'webp_quality' => 75,
    'fallback_quality' => 80,
    'allowed_sizes' => [
        '100x100',
        '300x300',
        '1000x1000'
    ],
    'fallback_size' => 1200,
    'full_size' => 2048,
    'intervention_driver' => Driver::class
];
