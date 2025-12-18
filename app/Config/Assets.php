<?php

namespace Config;

use Tatter\Assets\Config\Assets as BaseAssets;

class Assets extends BaseAssets
{
    /**
     * Assets groups mapped to routes.
     *
     * @var array<string, array<string, array<int, string>>>
     */
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