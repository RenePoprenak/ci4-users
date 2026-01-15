<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\I18n\Time;

final class CreateAdminUser extends BaseCommand
{
    protected $group       = 'Auth';
    protected $name        = 'auth:create-admin';
    protected $description = 'Create admin user and assign admin role';

    public function run(array $params)
    {
        $email    = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (!$email || !$password) {
            CLI::error('Missing ADMIN_EMAIL or ADMIN_PASSWORD in .env');
            return;
        }

        $db  = db_connect();
        $now = Time::now()->toDateTimeString();

        // existuje user?
        $row = $db->table('auth_identities')
            ->select('user_id')
            ->where('type', 'email_password')
            ->where('secret', $email)
            ->get()
            ->getFirstRow('array');

        if ($row && isset($row['user_id'])) {
            $userId = (int) $row['user_id'];
            $this->ensureAdminRole($db, $userId, $now);
            CLI::write("Admin already exists: {$email}", 'yellow');
            return;
        }

        // users
        $db->table('users')->insert([
            'username'   => 'admin',
            'active'     => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $userId = (int) $db->insertID();

        // auth_identities
        $db->table('auth_identities')->insert([
            'user_id'     => $userId,
            'type'        => 'email_password',
            'name'        => null,
            'secret'      => $email,
            'secret2'     => password_hash($password, PASSWORD_DEFAULT),
            'force_reset' => 0,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]);

        // admin role
        $this->ensureAdminRole($db, $userId, $now);

        CLI::write("Admin created: {$email}", 'green');
    }

    private function ensureAdminRole($db, int $userId, string $now): void
    {
        $exists = $db->table('auth_groups_users')
            ->where('user_id', $userId)
            ->where('group', 'admin')
            ->countAllResults();

        if ($exists > 0) {
            return;
        }

        $db->table('auth_groups_users')->insert([
            'user_id'    => $userId,
            'group'      => 'admin',
            'created_at' => $now,
        ]);
    }
}