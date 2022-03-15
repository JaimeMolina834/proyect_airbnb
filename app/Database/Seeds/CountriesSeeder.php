<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run()
    {
        $countries=[
            [
                'country'=>'El Salvador',
                'date_create'=>date('Y-m-d H:i:s')
            ],
        ];
        $builder = $this->db->table('tbl_countries');
        $builder->insertBatch($countries);
    }
}
