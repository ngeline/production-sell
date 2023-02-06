<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Opname extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_opn' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_pro' => [
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => true,
            ],
            'tgl_opn' => [
                'type' => 'DATE',
            ],
            'nama_opn' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'jmlh_opn' => [
                'type' => 'INT',
                'constraint' => 34,
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 34,
            ],
            'ket_opn' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
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
        $this->forge->addKey('id_opn', true);
        $this->forge->addForeignKey('id_pro', 'produksi', 'id_pro', 'CASCADE', '');
        $this->forge->createTable('opname');
    }

    public function down()
    {
        $this->forge->dropTable('opname');
    }
}
