<?php

namespace App\Controllers\Anfitrion;
use App\Entities\Usuario;

use App\Controllers\BaseController;

class Anfitrion extends BaseController{
    /*Variable global*/
    protected $configs;
    protected $modelAnfitrion;
    protected $modelUsuario;

    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct(){
        $this->configs=config('Airbnb');
        $this->modelAnfitrion = model('AnfitrionesModel');
        $this->modelUsuario = model('UsuarioModel');
    }

/*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/    
    public function index(){
        /*Muestra la vista de inicio del anfitrion*/
        return view('anfitrion/inicio');
    }

/*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/    
    public function perfil(){
        return view('anfitrion/perfil',[
            'usuario' => $this->modelUsuario->find(session('idUsuario')),
            'anfitrion' => $this->modelAnfitrion->find(session('idAnfitrion')),
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/

    public function buscar(){
        return view('anfitrion/buscar');
    }

/*--Funcion para cerrar sesion del anfitrion--------------------------------------------------------------*/ 
    public function cerrar(){
        /*Se destruye la session*/
        session()->destroy();
        /*Redirecciona a la vista de inicio de sesion*/
        return redirect()->route('login');
    }
/*--------------------------------------------------------------------------------------------------------*/  

/*--Funcion para regresar a la vista de usuario-----------------------------------------------------------*/
    public function regresarUsuario(){
        
        /*Se agrega el cambio del rol al usuario*/
        $this->modelUsuario->agregarCambiarRol($this->configs->defaultRolUsuario);
        /*Se actualizan los datos de rol del usuario*/
        $data=[
            'idUsuario' => session('idUsuario'),
            'idRol' => $this->modelUsuario->asignarCambiarRol
        ];
        /*Se guardan los datos actualizados del usuario*/
        $this->modelUsuario->save($data);

        /*Se busca los roles para la vista de los usuarios*/
        $this->modelUsuario->buscarRol($this->modelUsuario->asignarCambiarRol);
        /*Se carga las nuevas vista de roles en session*/
        session()->set([
            'idRol' => $this->modelUsuario->asignarCambiarRol,
            'rol' => $this->modelUsuario->asignarVistaRol
        ]);
        
        /*Redirecciona a la vista de incio de usuario con un mensaje*/
        return redirect()->route('usuarioInicio')->with('msg',[
            'type'=>'success',
            'body'=>'Has vuelto'
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/
}