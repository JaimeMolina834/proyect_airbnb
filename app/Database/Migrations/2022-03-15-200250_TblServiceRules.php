<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblServiceRules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idServiceRules' => [
                'type'             => 'INT',
                'constraint'       => 12,
                'unsigned'         => true,
                'auto_increment'   => true,
                'null' => false,
            ],
            'serviceRules'       => [
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
        $this->forge->addKey('idServiceRules', true);
        $this->forge->createTable('tbl_service_rules');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_service_rules');
    }
}
