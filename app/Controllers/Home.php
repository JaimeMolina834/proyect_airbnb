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
    public function inicio_sesion()
    {
        echo view('templates/header');
        echo view('inicio_sesion');
        echo view('templates/footer');
        
    }
    public function registro_usuario()
    {
        echo view('templates/header');
        echo view('registro_usuario');
        echo view('templates/footer');
        
    }

}
