<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubServiciosSeeder extends Seeder
{
    public function run()
    {
        $subServicio=[
            [
                'subServicio'=>'Cocina',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Wifi',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Televisor',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Refrigerador',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Secadora de pelo',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Ventilador',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Aire acondicionado',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Extintor de incendios',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Cafetera',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Cocina',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Lavadora',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Calefacción',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'subServicio'=>'Detector de humo',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
        ];
        $builder = $this->db->table('tbl_sub_servicios');
        $builder->insertBatch($subServicio);
    }
}