<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblServices extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idService'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'photo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'description'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'available'       => [
                'type'       => 'INT',
                'constraint' => 12,
                'null' => false,
            ],
            'address'       => [
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
            'date_delete' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'idHost'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
            'idLodging'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
            'idPrice'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
            'idCity'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
            'idGuests'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idService', true);
        /*$this->forge->addForeignKey('idHost','tbl_host','idHost','CASCADE','CASCADE');
        $this->forge->addForeignKey('idLodging','tbl_lodging','idLodging','CASCADE','SET NULL');
        $this->forge->addForeignKey('idPrice','tbl_price_list','idPrice','CASCADE','SET NULL');
        $this->forge->addForeignKey('idCity','tbl_city','idCity','CASCADE','SET NULL');
        $this->forge->addForeignKey('idGuests','tbl_guests','idGuests','CASCADE','SET NULL');*/
        $this->forge->createTable('tbl_services');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_services');
    }
}
