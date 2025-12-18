<?php

namespace App\Controllers;

use App\Models\UserListModel;
use CodeIgniter\Exceptions\PageNotFoundException;

final class UsersController extends BaseController
{
    public function index()
    {
        $model = new UserListModel();

        $users = $model->baseWithEmail()
            ->orderBy('users.id', 'DESC')
            ->get(50) // jednoduché: top 50
            ->getResultArray();

        return view('users/index', [
            'title' => 'Users',
            'users' => $users,
        ]);
    }

    public function show(int $id)
    {
        $model = new UserListModel();

        $user = $model->baseWithEmail()
            ->where('users.id', $id)
            ->get()
            ->getFirstRow('array');

        if (! $user) {
            throw PageNotFoundException::forPageNotFound('User not found');
        }

        return view('users/show', [
            'title' => 'User #' . $user['id'],
            'user'  => $user,
        ]);
    }
}