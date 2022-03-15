<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblHostLanguages extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idHostLanguages'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'languagePrimary'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'languageSecond'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'languageOther'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
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
        $this->forge->addKey('idHostLanguages', true);
        /*$this->forge->addForeignKey('languagePrimary','tbl_languages','idLanguages','CASCADE','SET NULL');
        $this->forge->addForeignKey('languageSecond','tbl_languages','idLanguages','CASCADE','SET NULL');
        $this->forge->addForeignKey('languageOther','tbl_languages','idLanguages','CASCADE','SET NULL');*/
        $this->forge->createTable('tbl_host_languages');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_host_languages');
    }
}
