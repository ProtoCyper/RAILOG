<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAdmin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '60'
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '50'
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255'
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['Admin', 'Super Admin']
            ],
            'aktif' => [
                'type'    => 'TINYINT',
                'default' => 0
            ],
            'aktivitas_terakhir' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);

        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
