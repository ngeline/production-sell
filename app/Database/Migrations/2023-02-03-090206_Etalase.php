<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Etalase extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_et' => [
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
            'tgl_et' => [
                'type' => 'DATE',
            ],
            'nama_et' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ],
            'jmlh_et' => [
                'type' => 'INT',
                'constraint' => 34,
            ],
            'ket_et' => [
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
        $this->forge->createTable('etalase');
    }

    public function down()
    {
        $this->forge->dropTable('etalase');
    }
}
