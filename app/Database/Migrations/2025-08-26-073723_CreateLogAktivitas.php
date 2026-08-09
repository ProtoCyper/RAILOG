<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLogAktivitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'id_admin' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['User', 'Admin', 'Super Admin', 'tidak terdaftar'],
            ],
            'aktivitas' => [
                'type' => 'TEXT',
            ],
            'ip_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 45,
            ],
            'user_agent' => [
                'type' => 'TEXT',
            ],
            // gunakan DATETIME nullable tanpa default
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_log', true);
        $this->forge->createTable('log_aktivitas');
    }

    public function down()
    {
        $this->forge->dropTable('log_aktivitas');
    }
}
