<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblHost extends Migration
{
    public function up(){
            //$this->db->disableForeignKeyChecks();
            $this->forge->addField([
                'idHost'          => [
                    'type'           => 'INT',
                    'constraint'     => 12,
                    'unsigned'       => true,
                    'auto_increment' => true,
                    'null' => false,
                ],
                'description'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'null' => false,
                ],
                'score'       => [
                    'type'       => 'INT',
                    'constraint' => 12,
                    'unsigned'   => true,
                    'null' => true,
                ],
                'totalScore'       => [
                    'type'       => 'INT',
                    'constraint' => 12,
                    'unsigned'   => true,
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
                'idUsers'          => [
                    'type'           => 'INT',
                    'constraint'     => 12,
                    'unsigned'       => true,
                    'null' => false,
                ],
                'idHostLanguages'          => [
                    'type'           => 'INT',
                    'constraint'     => 12,
                    'unsigned'       => true,
                    'null' => true,
                ],
            ]);
            $this->forge->addKey('idHost', true);
            /*$this->forge->addForeignKey('idUsers','tbl_users','idUsers','CASCADE','CASCADE');
            $this->forge->addForeignKey('idHostLanguages','tbl_host_languages','idHostLanguages','CASCADE','SET NULL');*/
            $this->forge->createTable('tbl_host');
            //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
    $this->forge->dropTable('tbl_host');
    }
}
