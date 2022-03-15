<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblHealthAndSecurity extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idHealthSecurity' => [
                'type'             => 'INT',
                'constraint'       => 12,
                'unsigned'         => true,
                'auto_increment'   => true,
                'null' => false,
            ],
            'healthSecurity'       => [
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
        $this->forge->addKey('idHealthSecurity', true);
        $this->forge->createTable('tbl_health_and_security');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_health_and_security');
    }
}
