<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblSaveSubServices extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idSubServices' => [
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
        /*$this->forge->addForeignKey('idSubServices','tbl_sub_services','idSubServices','CASCADE','SET NULL');
        $this->forge->addForeignKey('idService','tbl_services','idService','CASCADE','CASCADE');*/
        $this->forge->createTable('tbl_save_sub_services');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_save_sub_services');
    }
}
