<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartementSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nom' => 'Informatique', 'description' => 'Développement et infra'],
            ['nom' => 'Ressources Humaines', 'description' => 'Gestion du personnel'],
            ['nom' => 'Direction', 'description' => 'Administration générale'],
        ];

        $this->db->table('departements')->insertBatch($data);
    }
}
