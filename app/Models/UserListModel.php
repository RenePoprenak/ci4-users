<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\BaseBuilder;

final class UserListModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    public function baseWithEmail(): BaseBuilder
    {
        return $this->builder()
            ->select('users.id, users.username, users.created_at, ai.secret AS email')
            ->join('auth_identities ai', "ai.user_id = users.id AND ai.type = 'email_password'", 'left');
    }
}
