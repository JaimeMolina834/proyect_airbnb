<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblCancellationPolicy extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idCancellationPolicy' => [
                'type'             => 'INT',
                'constraint'       => 12,
                'unsigned'         => true,
                'auto_increment'   => true,
                'null' => false,
            ],
            'cancellationPolicy'       => [
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
        $this->forge->addKey('idCancellationPolicy', true);
        $this->forge->createTable('tbl_cancellation_policy');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_cancellation_policy');
    }
}
