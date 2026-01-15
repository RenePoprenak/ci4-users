<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

final class AdminOnly implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = service('auth');

        // not logged in -> redirect to login + set redirect_url
        if (! $auth->loggedIn()) {
            session()->set('redirect_url', current_url(true)->__toString());
            return redirect()->to(route_to('login'))->withCookies();
        }

        $user = $auth->user();
        if ($user === null) {
            session()->set('redirect_url', current_url(true)->__toString());
            return redirect()->to(route_to('login'))->withCookies();
        }

        // controle admin role
        $isAdmin = db_connect()
            ->table('auth_groups_users')
            ->where('user_id', (int) $user->id)
            ->where('group', 'admin')
            ->countAllResults() > 0;

        if ($isAdmin) {
            return;
        }

        // logged in but not admin -> logout + redirect to login
        $auth->logout();

        return redirect()->to(route_to('login'))->withCookies();
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing
    }
}