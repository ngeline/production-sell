<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Supplier extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sup'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_sup'            => ['type' => 'varchar', 'constraint' => 255],
            'alamat_sup'         => ['type' => 'varchar', 'constraint' => 255],
            'no_hp'            => ['type' => 'char', 'constraint' => 12],
            'created_at'       => ['type' => 'datetime', 'null' => true],
            'updated_at'       => ['type' => 'datetime', 'null' => true],
        ]);
        $this->forge->addKey('id_sup', true);
        $this->forge->createTable('supplier');
    }

    public function down()
    {
        $this->forge->dropTable('supplier');
    }
}
