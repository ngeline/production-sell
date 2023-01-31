<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pro' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tgl_pro' => [
                'type' => 'DATETIME',
            ],
            'nama_brg' => [
                'type' => 'VARCHAR',
                'constraint' => 60,
            ],
            'bahan' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'ukuran' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jmlh_brg' => [
                'type' => 'INT',
                'constraint' => 12,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 35,
            ],
            'ket' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'proses1' => [
                'type' => 'date',
                'null' => true,
            ],
            'proses2' => [
                'type' => 'date',
                'null' => true,
            ],
            'proses3' => [
                'type' => 'date',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id_pro', true);
        $this->forge->createTable('produksi');
    }

    public function down()
    {
        $this->forge->dropTable('produksi');
    }
}
