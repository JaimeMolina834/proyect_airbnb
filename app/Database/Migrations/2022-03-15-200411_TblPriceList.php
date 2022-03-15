<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPriceList extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idPrice'          => [
                'type'         => 'INT',
                'constraint'   => 12,
                'unsigned'     => true,
                'auto_increment' => true,
                'null' => false,
            ],
            'price'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => false,
            ],
            'discount'       => [
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
        $this->forge->addKey('idPrice', true);
        $this->forge->createTable('tbl_price_list');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_price_list');
    }
}
