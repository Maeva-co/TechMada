<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\SoldeModel;

class EmployeController extends BaseController {
    public function index() {
        return view('employe/index');
    }

    public function create() {
        return view('employe/create');
    }

    public function dashboard() {
        $userId = session()->get('user_id');

        $congeModel = new CongeModel();
        $soldeModel = new SoldeModel();

        $data = [
            // métriques
            'attente' => $congeModel->countByStatus($userId, 'en_attente'),
            'approuvee' => $congeModel->countByStatus($userId, 'approuvee'),
            'refusee' => $congeModel->countByStatus($userId, 'refusee'),

            // soldes
            'soldes' => $soldeModel->getByEmploye($userId),
            'joursRestants' => $soldeModel->getTotalRestant($userId),

            // demandes
            'demandes' => $congeModel->getLatest($userId),
        ];

        return view('employe/dashboard', $data);
    }
    
}

