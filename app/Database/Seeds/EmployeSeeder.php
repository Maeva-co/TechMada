<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom'            => 'Admin',
                'prenom'         => 'Système',
                'email'          => 'admin@entreprise.com',
                'password'       => 'admin123',
                'role'           => 'admin',
                'departement_id' => 1,
                'date_embauche'  => '2023-01-01',
                'actif'          => 1
            ],
            [
                'nom'            => 'Dupont',
                'prenom'         => 'Jean',
                'email'          => 'j.dupont@entreprise.com',
                'password'       => 'user123',
                'role'           => 'employe',
                'departement_id' => 2,
                'date_embauche'  => '2024-02-15',
                'actif'          => 1
            ],
        ];

        $this->db->table('employes')->insertBatch($data);
    }
}
