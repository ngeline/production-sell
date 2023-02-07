<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penj' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_et' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'marketplace' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'tgl_inp' => [
                'type' => 'DATETIME',
            ],
            'nm_pro' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'banyak_brg' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'total_penj' => [
                'type' => 'INT',
                'constraint' => 35,
            ],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id_penj', true);
        $this->forge->addForeignKey('id_et', 'etalase', 'id_et', 'CASCADE', '');
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan');
    }
}
