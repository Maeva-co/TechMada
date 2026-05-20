<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainSeeder extends Seeder
{
    public function run()
    {
        $this->call('DepartementSeeder');
        $this->call('TypeCongeSeeder');
        $this->call('EmployeSeeder');
        $this->call('CongeSeeder');


    }
}
