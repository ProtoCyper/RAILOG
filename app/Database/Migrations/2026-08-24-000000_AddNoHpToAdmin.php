<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNoHpToAdmin extends Migration
{
    public function up()
    {
        $this->forge->addColumn('admin', [
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
                'after'      => 'email',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('admin', 'no_hp');
    }
}
