<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblCountries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idCountry'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'country'       => [
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
        ]);
        $this->forge->addKey('idCountry', true);
        $this->forge->createTable('tbl_countries');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_countries');
    }
}
