<?php

namespace App\Publishers;

use CodeIgniter\Publisher\Publisher;

final class TablerPublisher extends Publisher
{
    public function publish(): bool
    {
        $this->source      = ROOTPATH . 'app/ThirdParty/tabler';
        $this->destination = FCPATH . 'assets/tabler';

        $css = $this->source . '/tabler.min.css';
        $js  = $this->source . '/tabler.min.js';

        if (! is_file($css) || ! is_file($js)) {
            return false;
        }

        // addFile() dostane plnú cestu – FileCollection bude spokojný
        $this->addFile($css);
        $this->addFile($js);

        $this->merge(false);

        return parent::publish();
    }
}
