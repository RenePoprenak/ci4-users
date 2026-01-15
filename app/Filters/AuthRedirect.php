<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

final class AuthRedirect implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('auth');

        if ($auth->loggedIn()) {
            return;
        }

        // set redirect_url to current url
        session()->set('redirect_url', current_url(true)->__toString());

        // shield login page
        return redirect()->to(route_to('login'))->withCookies();
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // now nothing
    }
}