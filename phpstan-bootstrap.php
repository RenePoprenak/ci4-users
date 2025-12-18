<?php

declare(strict_types=1);

define('APPPATH', __DIR__ . '/app/');
define('ROOTPATH', __DIR__ . '/');
define('WRITEPATH', __DIR__ . '/writable/');
define('SYSTEMPATH', __DIR__ . '/vendor/codeigniter4/framework/system/');
define('FCPATH', __DIR__ . '/public/');
define('HOMEPATH', __DIR__ . '/');
define('ENVIRONMENT', 'testing');

require_once SYSTEMPATH . 'Common.php';
require_once SYSTEMPATH . 'Helpers/url_helper.php';
file_put_contents(__DIR__ . '/writable/cache/phpstan_bootstrap_ran', "ok\n");

if (! function_exists('setting')) {
    /**
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        return $default;
    }
}
