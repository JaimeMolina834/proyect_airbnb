<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoHospedajesSeeder extends Seeder
{
    public function run()
    {
        $tipoHospedaje=[
            [
                'tipoHospedaje'=>'Mini casa',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Casa alpina',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Casas subterráneas',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Hotel',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Mansion',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Casa rodante',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Cabaña',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Casa flotantes',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Casa frente a la playa',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'tipoHospedaje'=>'Casa rural',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
        ];
        $builder = $this->db->table('tbl_tipo_hospedajes');
        $builder->insertBatch($tipoHospedaje);
    }
}