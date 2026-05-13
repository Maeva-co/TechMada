<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'soldes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employe_id',
        'type_conge_id',
        'annee',
        'jours_attribues',
        'jours_pris'
    ];

    public function getByEmploye($employeId) {
        return $this->select('soldes.*, types_conge.libelle')
            ->join('types_conge', 'types_conge.id = soldes.type_conge_id')
            ->where('employe_id', $employeId)
            ->findAll();
    }

    public function getTotalRestant($employeId) {
        $result = $this->select('SUM(jours_attribues - jours_pris) as restant')
            ->where('employe_id', $employeId)
            ->first();

        return $result['restant'] ?? 0;
    }
}