<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PoliticasCancelacionSeeder extends Seeder
{
    public function run()
    {
        $politicas=[
            [
                'politicaCancelacion'=>'Sin reembolso',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
        ];
        $builder = $this->db->table('tbl_politicas_de_cancelacion');
        $builder->insertBatch($politicas);
    }
}