<?php

namespace App\Controllers;

use App\Models\CongeModel;
use App\Models\SoldeModel;
use App\Models\TypeCongeModel;

class EmployeController extends BaseController {
    public function index() {
        $userId = session()->get('user_id');
        $congeModel = new CongeModel();

        $data = [
            'demandes' => $congeModel->getByEmploye($userId)
        ];

        return view('employe/index', $data);
    }

    public function cancel($id) {
        $congeModel = new CongeModel();

        $demande = $congeModel->find($id);

        // sécurité : seulement propriétaire + statut en attente
        if ($demande && $demande['statut'] === 'en_attente') {
            $congeModel->update($id, [
                'statut' => 'annulee'
            ]);
        }

        return redirect()->back()->with('success', 'Demande annulée');
    }

    // affiche le formulaire de demande de congé
    public function create() {
        $userId = session()->get('user_id');

        $typeModel = new TypeCongeModel();
        $soldeModel = new SoldeModel();

        $data = [
            'types' => $typeModel->getAllTypes(),
            'soldes' => $soldeModel->getByEmploye($userId),
        ];

        return view('employe/create', $data);
    }

    // public function create() {
    //     $userId = session()->get('user_id');

    //     $typeModel = new TypeCongeModel();
    //     $soldeModel = new SoldeModel();

    //     $allSoldes = $soldeModel->getByEmploye($userId);
        
    //     $data = [
    //         'types' => $typeModel->getAllTypes(),
    //         'soldes' => $allSoldes,  // Pour affichage si besoin
    //         'solde' => $allSoldes[0] ?? [],  // Le solde principal à afficher
    //     ];

    //     return view('employe/create', $data);
    // }

    // traitement formulaire
    public function store() {
        $userId = session()->get('user_id');

        $rules = [
            'type_conge_id' => 'required',
            'date_debut'    => 'required',
            'date_fin'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $dateDebut = $this->request->getPost('date_debut');
        $dateFin   = $this->request->getPost('date_fin');

        // calcul jours
        $diff = (strtotime($dateFin) - strtotime($dateDebut)) / 86400 + 1;

        $model = new CongeModel();

        $model->save([
            'employe_id'     => $userId,
            'type_conge_id'  => $this->request->getPost('type_conge_id'),
            'date_debut'     => $dateDebut,
            'date_fin'       => $dateFin,
            'nb_jours'       => $diff,
            'motif'          => $this->request->getPost('motif'),
            'statut'         => 'en_attente',
        ]);

        return redirect()->to('/employe/dashboard')
            ->with('success', 'Demande envoyée avec succès');
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

