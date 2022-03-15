<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSaveServiceRules extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idServiceRules' => [
                'type'             => 'INT',
                'constraint'       => 12,
                'unsigned'         => true,
                'null' => true,
            ],
            'idService' => [
                'type'             => 'INT',
                'constraint'       => 12,
                'unsigned'         => true,
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
        /*$this->forge->addForeignKey('idServiceRules','tbl_service_rules','idServiceRules','CASCADE','SET NULL');
        $this->forge->addForeignKey('idService','tbl_services','idService','CASCADE','CASCADE');*/
        $this->forge->createTable('tbl_save_service_rules');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_save_service_rules');
    }
}
