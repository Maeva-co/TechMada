<?php

namespace App\Controllers;

use App\Models\EmployeModel;
use App\Models\DepartementModel;
use App\Models\CongeModel;


class AdminController extends BaseController
{
    public function dashboard()
    {
        $congeModel = new CongeModel();
        $dataMonth = $congeModel->getCongeAllMonths();
        return view('admin/dashboard', [
            'dataMonth' => $dataMonth
        ]);
    }

    public function employes()
    {
        $model = new EmployeModel();
        $employes = $model->select('employes.id, employes.nom, employes.prenom, employes.email, employes.actif, employes.date_embauche, employes.role, departements.nom as departement')
                            ->join('departements', 'employes.departement_id = departements.id')
                            ->findAll();
        
        $deptModel = new DepartementModel();
        $departements = $deptModel->findAll();
        
        return view('admin/employes', [
            'employes' => $employes,
            'departements' => $departements,
            'edit_mode' => false
        ]);
    }

    public function createEmploye()
    {
        $data = [
            'nom'           => $this->request->getPost('nom'),
            'prenom'        => $this->request->getPost('prenom'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => $this->request->getPost('role'),
            'departement_id' => $this->request->getPost('departement_id'),
            'date_embauche' => $this->request->getPost('date_embauche'),
            'actif'         => 1,
        ];

        $model = new EmployeModel();

        if (!$model->validate($data)) {
            return redirect()->back()->with('errors', $model->errors());
        }

        $model->insert($data);

        return redirect()->to('/admin/employes')->with('success', 'Employé ajouté avec succès');
    }

    public function editEmploye($id)
    {
        $model = new EmployeModel();
        $employe = $model->find($id);

        if (!$employe) {
            return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé');
        }

        $deptModel = new DepartementModel();
        $departements = $deptModel->findAll();

        return view('admin/employes', [
            'employes' => [],
            'employe_edit' => $employe,
            'departements' => $departements,
            'edit_mode' => true
        ]);
    }

    public function updateEmploye($id)
    {
        $model = new EmployeModel();
        $employe = $model->find($id);

        if (!$employe) {
            return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé');
        }

        $data = [
            'nom'           => $this->request->getPost('nom'),
            'prenom'        => $this->request->getPost('prenom'),
            'email'         => $this->request->getPost('email'),
            'role'          => $this->request->getPost('role'),
            'departement_id' => $this->request->getPost('departement_id'),
            'date_embauche' => $this->request->getPost('date_embauche'),
        ];

        // Si un nouveau mot de passe est fourni
        if (!empty($this->request->getPost('password'))) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Valider uniquement les champs fournis
        if (!$model->validate($data)) {
            return redirect()->back()->with('errors', $model->errors());
        }

        $model->update($id, $data);

        return redirect()->to('/admin/employes')->with('success', 'Employé modifié avec succès');
    }

    public function deactivateEmploye($id)
    {
        $model = new EmployeModel();
        $employe = $model->find($id);

        if (!$employe) {
            return redirect()->to('/admin/employes')->with('error', 'Employé non trouvé');
        }

        $model->update($id, ['actif' => 0]);

        return redirect()->to('/admin/employes')->with('success', 'Employé désactivé');
    }
}