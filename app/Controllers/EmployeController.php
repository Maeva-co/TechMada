<?php

namespace App\Controllers;

class EmployeController extends BaseController {
    public function index() {
        return view('employe/index');
    }

    public function dashboard() {
        return view('employe/dashboard');
    }

    public function create() {
        return view('employe/create');
    }
}
