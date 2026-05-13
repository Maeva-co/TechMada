<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom'            => 'Administrateur',
                'email'          => 'admin@techmada.mg',
                'password'       => 'admin123',
                'role'           => 'admin',
                'departement_id' => 1,
                'date_embauche'  => '2023-01-01',
                'actif'          => 1
            ],
            [
                'nom'            => 'Responsable RH',
                'email'          => 'j.dupont@techmada.mg',
                'password'       => 'rh123',
                'role'           => 'rh',
                'departement_id' => 2,
                'date_embauche'  => '2024-02-15',
                'actif'          => 1
            ],
            [
                'nom'            => 'Employe',
                'email'          => 'j.dupont@techmada.mg',
                'password'       => 'emp123',
                'role'           => 'employe',
                'departement_id' => 2,
                'date_embauche'  => '2024-02-15',
                'actif'          => 1
            ],
        ];

        $this->db->table('employes')->insertBatch($data);
    }
}
