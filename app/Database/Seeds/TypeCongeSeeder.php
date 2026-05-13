<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TypeCongeSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['libelle' => 'Congés Payés', 'jours_annuels' => 25, 'deductible' => 1],
            ['libelle' => 'RTT', 'jours_annuels' => 10, 'deductible' => 1],
            ['libelle' => 'Congé Maladie', 'jours_annuels' => 0, 'deductible' => 0],
        ];

        $this->db->table('types_conge')->insertBatch($data);
    }
}
