<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblGuardarSubServicios extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idGuardar'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
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
            'idSubServicio'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
            'idServicio'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('idGuardar', true);
        $this->forge->addForeignKey('idSubServicio','tbl_sub_servicios','idSubServicio','CASCADE','SET NULL');
        $this->forge->addForeignKey('idServicio','tbl_servicios','idServicio','CASCADE','CASCADE');
        $this->forge->createTable('tbl_guardar_sub_servicios');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_guardar_sub_servicios');
    }
}