<?php

namespace App\Publishers;

use CodeIgniter\Publisher\Publisher;

final class VendorJsPublisher extends Publisher
{
    private const HTMX_VERSION   = '1.9.12';
    private const ALPINE_VERSION = '3.14.1';

    private const HTMX_CDN   = 'https://unpkg.com/htmx.org@%s/dist/htmx.min.js';
    private const ALPINE_CDN = 'https://cdn.jsdelivr.net/npm/alpinejs@%s/dist/cdn.min.js';

    public function publish(): bool
    {
        $this->destination = FCPATH . 'assets/vendor/';

        if (! is_dir($this->destination) && ! mkdir($this->destination, 0775, true) && ! is_dir($this->destination)) {
            return false;
        }

        $this->addUri(sprintf(self::HTMX_CDN, self::HTMX_VERSION));
        $this->addUri(sprintf(self::ALPINE_CDN, self::ALPINE_VERSION));

        $this->merge(false);

        return $this->copy(true);
    }
}