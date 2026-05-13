<?php

namespace App\Models;

use CodeIgniter\Model;

class CongeModel extends Model
{
    protected $table = 'conges';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employe_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'nb_jours',
        'motif',
        'statut',
        'commentaire_rh',
        'created_at',
        'traite_par'
    ];

    protected $useTimestamps = true;

    public function countByStatus($employeId, $status) {
        return $this->where('employe_id', $employeId)
                    ->where('statut', $status)
                    ->countAllResults();
    }

    public function getLatest($employeId, $limit = 5) {
        return $this->select('conges.*, types_conge.libelle')
            ->join('types_conge', 'types_conge.id = conges.type_conge_id')
            ->where('employe_id', $employeId)
            ->orderBy('date_debut', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getByEmploye($employeId) {
        return $this->where('employe_id', $employeId)
                    ->orderBy('date_debut', 'DESC')
                    ->findAll();
    }
}