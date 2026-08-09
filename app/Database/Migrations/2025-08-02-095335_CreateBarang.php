<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'jumlah' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'satuan' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true
            ],
            'tanggal_masuk' => [
                'type' => 'DATE'
            ],
            'barcode' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true
            ],
            'minimum_stok' => [
                'type'       => 'INT',
                'constraint' => 11
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
            'surat_jalan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
        ]);

        $this->forge->addKey('id_barang', true);
        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
