<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLodging extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idLodging'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'lodging'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'date_create' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'date_update' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idLodging', true);
        $this->forge->createTable('tbl_lodging');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_lodging');
    }
}
