<?php

namespace App\Controllers;

class AuthController extends BaseController {
    public function form()
    {
        return view('auth/login');
    }

    // public function login() {
    //     return view('auth/login');
    // }

    public function login()
    {
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();
        if (!$user || !password_verify($password, $user['password'])) {
            return view('auth/login', [
            'erreur' => 'Email ou mot de passe incorrect'
            ]);
        }
        // Stocker uniquement les données non sensibles en session
        session()->set('user', [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'email' => $user['email'],
            'role' => $user['role'],
        ]);
        return redirect()->to('/livres');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}