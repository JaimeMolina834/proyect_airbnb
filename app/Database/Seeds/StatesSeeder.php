<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatesSeeder extends Seeder
{
    public function run()
    {
        $states=[
            [
                'state'=>'Ahuachapán',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Cabañas',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Chalatenango',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Cuscatlán',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'La Libertad',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'La Paz',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'La Unión',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Morazán',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1 
            ],
            [
                'state'=>'San Miguel',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'San Salvador',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'San Vicente',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Santa Ana',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Sonsonate',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
            [
                'state'=>'Usulután',
                'date_create'=>date('Y-m-d H:i:s'),
                'idCountry'=> 1
            ],
        ];
        $builder = $this->db->table('tbl_states');
        $builder->insertBatch($states);
    }
}
