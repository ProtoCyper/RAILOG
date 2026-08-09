<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaporan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_barang' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'jumlah' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'jenis' => [
                'type'       => 'ENUM',
                'constraint' => ['Masuk', 'Dipakai']
            ],
            'tanggal' => [
                'type' => 'DATETIME'
            ],
            'id_user' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
        ]);

        $this->forge->addKey('id_laporan', true);
        $this->forge->createTable('laporan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan');
    }
}
