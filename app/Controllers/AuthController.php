<?php

namespace App\Controllers;

use App\Models\EmployeModel;

class AuthController extends BaseController
{
    public function form()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new EmployeModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Rechercher l'employé par email
        $employe = $model->where('email', $email)->first();
        
        if (!$employe || !password_verify($password, $employe['password'])) {
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }

        if (!$employe['actif']) {
            return redirect()->back()->with('error', 'Votre compte est désactivé');
        }

        session()->set('user', [
            'id'    => $employe['id'],
            'nom'   => $employe['nom'],
            'prenom' => $employe['prenom'],
            'email' => $employe['email'],
            'role'  => $employe['role'],
        ]);

        return redirect()->to($employe['role'] . '/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}