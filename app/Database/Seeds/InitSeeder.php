<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $this->call('RolesSeeder');
        $this->call('PaisesSeeder');
        $this->call('DepartamentosSeeder');
        $this->call('MunicipiosSeeder');
        $this->call('IdiomasSeeder');
        $this->call('PoliticasCancelacionSeeder');
        $this->call('ReglasServiciosSeeder');
        $this->call('SaludSeguridadSeeder');
        $this->call('SubServiciosSeeder');
        $this->call('TipoHospedajesSeeder');
    }
}