<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SaludSeguridadSeeder extends Seeder
{
    public function run()
    {
        $salud=[
            [
                'saludSeguridad'=>'Se aplican las prácticas de seguridad relacionadas con la COVID-19',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'saludSeguridad'=>'No se puede estacionar en el alojamiento',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'saludSeguridad'=>'Hay espacios compartidos',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'saludSeguridad'=>'Alarma de monóxido de carbono',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'saludSeguridad'=>'Detector de humo',
                'date_create'=>date('Y-m-d H:i:s'),
            ],

        ];
        $builder = $this->db->table('tbl_salud_y_seguridad');
        $builder->insertBatch($salud);
    }
}