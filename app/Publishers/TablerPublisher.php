<?php

namespace App\Publishers;

use CodeIgniter\Publisher\Publisher;

final class TablerPublisher extends Publisher
{
    private const VERSION = '1.4.0';
    private const CDN     = 'https://cdn.jsdelivr.net/npm/@tabler/core@%s/dist/%s';

    public function publish(): bool
    {
        $this->destination = FCPATH . 'assets/tabler/';

        if (! is_dir($this->destination) && ! mkdir($this->destination, 0775, true) && ! is_dir($this->destination)) {
            return false;
        }

        $cssUrl = sprintf(self::CDN, self::VERSION, 'css/tabler.min.css');
        $jsUrl  = sprintf(self::CDN, self::VERSION, 'js/tabler.min.js');

        $this->addUri($cssUrl);
        $this->addUri($jsUrl);

        $this->merge(false);

        return $this->copy(true);
    }
}