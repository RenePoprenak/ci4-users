<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

final class UserSeeder extends Seeder
{
    public function run()
    {
        $db = db_connect();
        $now = Time::now()->toDateTimeString();

        $seedUsers = [
            [
                'username' => 'admin',
                'email'    => 'admin@example.com',
                'password' => 'password',
            ],
            [
                'username' => 'john',
                'email'    => 'john@example.com',
                'password' => 'password',
            ],
        ];

        foreach ($seedUsers as $u) {
            // už existuje user s týmto emailom?
            $exists = $db->table('auth_identities')
                ->where('type', 'email_password')
                ->where('secret', $u['email'])
                ->countAllResults();

            if ($exists > 0) {
                continue;
            }

            // 1) insert do users
            $db->table('users')->insert([
                'username'       => $u['username'],
                'active'         => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);

            $userId = (int) $db->insertID();

            // 2) insert do auth_identities (email_password)
            $db->table('auth_identities')->insert([
                'user_id'     => $userId,
                'type'        => 'email_password',
                'name'        => null,
                'secret'      => $u['email'],
                'secret2'     => password_hash($u['password'], PASSWORD_DEFAULT),
                'force_reset' => 0,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }
}