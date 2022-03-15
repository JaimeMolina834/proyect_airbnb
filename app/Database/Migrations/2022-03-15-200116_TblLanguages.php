<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblLanguages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idLanguages'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'language' => [
                'type' => 'VARCHAR',
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
        $this->forge->addKey('idLanguages', true);
        $this->forge->createTable('tbl_languages');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_languages');
    }
}
