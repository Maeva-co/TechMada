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
                'password'       => password_hash('admin123', PASSWORD_DEFAULT),
                'role'           => 'admin',
                'departement_id' => 1,
                'date_embauche'  => '2023-01-01',
                'actif'          => 1
            ],
            [
                'nom'            => 'Responsable RH',
                'email'          => 'j.dupont@techmada.mg',
                'password'       => password_hash('rh123', PASSWORD_DEFAULT),
                'role'           => 'rh',
                'departement_id' => 2,
                'date_embauche'  => '2024-02-15',
                'actif'          => 1
            ],
            [
                'nom'            => 'Employe',
                'email'          => 'j.dupont@techmada.mg',
                'password'       => password_hash('emp123', PASSWORD_DEFAULT),
                'role'           => 'employe',
                'departement_id' => 2,
                'date_embauche'  => '2024-02-15',
                'actif'          => 1
            ],
        ];

        $this->db->table('employes')->insertBatch($data);
    }
}
