<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblReserve extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idReserve'          => [
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
            'idPayments'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('idReserve', true);
        //$this->forge->addForeignKey('idPayments','tbl_payments','idPayments','CASCADE','CASCADE');
        $this->forge->createTable('tbl_Reserve');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_Reserve');
    }
}
