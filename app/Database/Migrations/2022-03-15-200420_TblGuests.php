<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblGuests extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idGuests'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'adult'       => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => false,
            ],
            'babies'       => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
            'younger'       => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'null' => true,
            ],
            'pets'       => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
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
        $this->forge->addKey('idGuests', true);
        $this->forge->createTable('tbl_guests');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_guests');
    }
}
