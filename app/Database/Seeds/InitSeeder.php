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
    }
}