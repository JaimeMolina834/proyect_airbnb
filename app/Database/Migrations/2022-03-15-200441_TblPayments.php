<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPayments extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idPayments'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'dateInput'       => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'dateOutput'       => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'total'       => [
                'type'       => 'INT',
                'constraint' => 12,
                'unsigned'     => true,
                'null' => false,
            ],
            'reserveManager'       => [
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
            'idService'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('idPayments', true);
        //$this->forge->addForeignKey('idService','tbl_services','idService','CASCADE','CASCADE');
        $this->forge->createTable('tbl_payments');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_payments');
    }
}
