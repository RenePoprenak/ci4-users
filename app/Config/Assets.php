<?php

namespace Config;

use Tatter\Assets\Config\Assets as BaseAssets;

class Assets extends BaseAssets
{
    public array $routes = [
        '*' => [
            'css' => [
                'assets/tabler/tabler.min.css',
            ],
            'js' => [
                'assets/tabler/tabler.min.js',
            ],
        ],
    ];
}
