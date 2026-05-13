<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeModel extends Model
{
    protected $table = 'employes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'prenom',
        'email',
        'password',
        'role',
        'departement_id',
        'date_embauche',
        'actif'
    ];

    protected $validationRules = [
        'email'    => 'required|valid_email|is_unique[employes.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'nom'      => 'required|min_length[2]',
        'prenom'   => 'required|min_length[2]',
        'role'     => 'required|in_list[admin,rh,employe]',
        'departement_id' => 'required|integer',
        'date_embauche' => 'required|valid_date',
    ];

    protected $validationMessages = [
        'email' => [
            'required'        => 'L\'email est requis',
            'valid_email'     => 'Format email invalide',
            'is_unique'       => 'Cet email existe déjà',
        ],
        'password' => [
            'required'        => 'Le mot de passe est requis',
            'min_length'      => 'Le mot de passe doit contenir au moins 6 caractères',
        ],
        'nom' => [
            'required'        => 'Le nom est requis',
            'min_length'      => 'Le nom doit contenir au moins 2 caractères',
        ],
        'prenom' => [
            'required'        => 'Le prénom est requis',
            'min_length'      => 'Le prénom doit contenir au moins 2 caractères',
        ],
        'role' => [
            'required'        => 'Le rôle est requis',
            'in_list'         => 'Rôle invalide',
        ],
    ];
}