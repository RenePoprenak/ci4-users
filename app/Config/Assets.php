<?php

namespace Config;

use Tatter\Assets\Config\Assets as BaseAssets;

class Assets extends BaseAssets
{
    public array $routes = [
        '*' => [
            'tabler/tabler.min.css',
            'tabler/tabler.min.js',
        ],
    ];
}
