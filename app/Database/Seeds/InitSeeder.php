<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
    public function run()
    {
        $this->call('RolesSeeder');
        $this->call('CountriesSeeder');
        $this->call('StatesSeeder');
        $this->call('CitySeeder');
        $this->call('LanguagesSeeder');
    }
}
