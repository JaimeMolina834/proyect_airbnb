<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReglasServiciosSeeder extends Seeder
{
    public function run()
    {
        $reglas=[
            [
                'reglaServicio'=>'Check-in de 12:00 a 17:00',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'Salida a 15:00',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'No apto para niños o bebes',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'Prohibido fumar',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'No se admiten mascotas',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'Esta prohibido hacer fiestas o eventos',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'La lavadora y la secadora en la propiedad son solo para uso del personal, pero tenemos un servicio de lavandería disponible',
                'date_create'=>date('Y-m-d H:i:s'),
            ],
            [
                'reglaServicio'=>'No hay llegada anticipada ni salida después de la hora establecida',
                'date_create'=>date('Y-m-d H:i:s'),
            ],

        ];
        $builder = $this->db->table('tbl_reglas_servicios');
        $builder->insertBatch($reglas);
    }
}