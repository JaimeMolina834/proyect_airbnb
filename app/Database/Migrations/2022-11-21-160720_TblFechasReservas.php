<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblFechasReservas extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idFecha'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'fechaEntrada' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'fechaSalida' => [
                'type' => 'DATETIME',
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
            'idServicio'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('idFecha', true);
        $this->forge->addForeignKey('idServicio','tbl_servicios','idServicio','CASCADE','CASCADE');
        $this->forge->createTable('tbl_fechas_reservas');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_fechas_reservas');
    }
}