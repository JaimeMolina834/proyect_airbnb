<?php

namespace App\Controllers\Auth;
use App\Entities\Usuario;
use App\Entities\Anfitrion;

use App\Controllers\BaseController;

class Vistas extends BaseController{
/*--Funcin para vista de registro de usuario-------------------------------------------------------------*/
    public function index(){
        /*Muestra la vista de registro*/
        return view('auth/registro');
    }
/*--Funcion para vista de registro de anfitri-----------------------------------------------------------*/
    public function registrarAnfitrion(){
        /*Carga el modelo IdiomasModel*/
        $model = model('IdiomasModel');

        /*Muestra la vista de registro del anfitrión y se pasa los parametros de todos los idiomas*/
        return view ('auth/registroAnfitrion',[
            'idiomas' => $model->findAll()
        ]);
    }
    
    
/*--Funcin para vista de iniciar sesion-----------------------------------------------------------------*/
    public function login(){
        /*Muestra la vista de registro*/
        return view ('auth/login');
    }
}