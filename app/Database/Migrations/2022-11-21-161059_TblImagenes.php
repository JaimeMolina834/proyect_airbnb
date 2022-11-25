<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblImagenes extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idImagen'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'url'       => [
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
            'idServicio'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('idImagen', true);
        //$this->forge->addForeignKey('idServicio','tbl_servicios','idServicio','CASCADE','CASCADE');
        $this->forge->createTable('tbl_imagenes');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_imagenes');
    }
}