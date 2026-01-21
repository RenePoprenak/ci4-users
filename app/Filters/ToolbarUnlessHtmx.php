<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\DebugToolbar;

class ToolbarUnlessHtmx implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // nothing
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // HTMX request? -> don't add toolbar
        if ($request->hasHeader('HX-Request')) {
            return $response;
        }

        // but otherwise, add the toolbar
        $toolbar = new DebugToolbar();

        return $toolbar->after($request, $response, $arguments);
    }
}