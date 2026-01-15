<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Shield\Models\UserModel;
final class UsersController extends BaseController
{
    public function index(): string
    {
        $users = model(UserModel::class)
            ->withIdentities()
            ->findAll();

        return view('users/index', ['users' => $users]);
    }

    public function show(int $id): string
    {
        $user = model(UserModel::class)
            ->withIdentities()
            ->findById($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('users/show', ['user' => $user]);
    }
}
