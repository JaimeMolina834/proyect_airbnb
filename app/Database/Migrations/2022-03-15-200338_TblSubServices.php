<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSubServices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idSubServices' => [
                'type'             => 'INT',
                'constraint'       => 12,
                'unsigned'         => true,
                'auto_increment'   => true,
                'null' => false,
            ],
            'subServices'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
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
        $this->forge->addKey('idSubServices', true);
        $this->forge->createTable('tbl_sub_services');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_sub_services');
    }
}
