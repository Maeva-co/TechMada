<?php

namespace App\Controllers;

class AdminController extends BaseController {
    public function dashboard() {
        return view('admin/dashboard');
    }

    public function employes() {
        return view('admin/employes');
    }
}