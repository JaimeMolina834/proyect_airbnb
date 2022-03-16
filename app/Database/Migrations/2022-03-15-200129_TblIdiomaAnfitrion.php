<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblIdiomaAnfitrion extends Migration
{
    public function up()
    {
        //$this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'idIdiomaAnfitrion'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'idiomaPrimario'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'idiomaSecundario'          => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'null' => true,
            ],
            'idiomaExtra'          => [
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
        $this->forge->addKey('idIdiomaAnfitrion', true);
        /*$this->forge->addForeignKey('idiomaPrimario','tbl_idiomas','idIdioma','CASCADE','SET NULL');
        $this->forge->addForeignKey('idiomaSecundario','tbl_idiomas','idIdioma','CASCADE','SET NULL');
        $this->forge->addForeignKey('idiomaExtra','tbl_idiomas','idIdioma','CASCADE','SET NULL');*/
        $this->forge->createTable('tbl_idioma_anfitrion');
        //$this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('tbl_idioma_anfitrion');
    }
}