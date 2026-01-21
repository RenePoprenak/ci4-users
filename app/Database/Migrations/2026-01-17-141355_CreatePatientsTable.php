<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'first_name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'last_name'  => ['type' => 'VARCHAR', 'constraint' => 100],
            'birth_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
                'null'       => false,
            ],
            'birth_date' => ['type' => 'DATE', 'null' => true],

            'email' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 50,  'null' => true],

            'address_line1' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'address_line2' => ['type' => 'VARCHAR', 'constraint' => 190, 'null' => true],
            'city'          => ['type' => 'VARCHAR', 'constraint' => 120, 'null' => true],
            'zip'           => ['type' => 'VARCHAR', 'constraint' => 20,  'null' => true],

            'note' => ['type' => 'TEXT', 'null' => true],

            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('birth_number', false, true);
        $this->forge->addKey(['last_name', 'first_name']);
        $this->forge->addKey('email');

        $this->forge->createTable('patients', true);
    }

    public function down()
    {
        $this->forge->dropTable('patients', true);
    }
}
