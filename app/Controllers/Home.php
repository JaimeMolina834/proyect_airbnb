<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('templates/header');
        echo view('templates/menu');
        echo view('inicio');
        echo view('templates/footer');
        
    }
    public function login()
    {
        echo view('templates/header');
        echo view('login');
        echo view('templates/footer');
        
    }

}
