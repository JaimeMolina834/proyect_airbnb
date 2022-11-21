<?php

namespace App\Controllers\Usuario;
use App\Entities\Usuario;
use App\Entities\Anfitrion;

use App\Controllers\BaseController;

class Vistas extends BaseController{
    /*Variable global*/
    protected $configs;
    protected $modelUsuario;
    protected $modelAnfitrion;
    protected $modelIdioma;

    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct(){
        $this->configs=config('Airbnb');
        $this->modelUsuario = model('UsuarioModel');
        $this->modelAnfitrion = model('AnfitrionesModel');
        $this->modelIdioma = model('IdiomasModel');
    }

/*--Funcin para vista de inicio del usuario--------------------------------------------------------------*/
    public function index(){
        /*Muestra la vista del inicio del usuario*/
        return view('usuario/inicio');
    }

/*--Funcin para vista de inicio del usuario--------------------------------------------------------------*/
    public function alojamiento(){
        /*Muestra la vista del inicio del usuario*/
        return view('usuario/alojamientos');
    }
/*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/    
    public function perfil(){
        /*Muestra la vista de inicio del anfitrion*/
        return view('usuario/perfil',[
            'usuario' => $this->modelUsuario->find(session('idUsuario')),
            'anfitrion' => $this->modelAnfitrion->find(session('idAnfitrion')),
        ]);
    }

/*--Funcin para vista de usuario hacerse anfitrion-------------------------------------------------------*/
    public function hazteAnfitrion(){
        /*Verificar que el rol de control sea igual a anfitrion*/
        if(session('rol2') == 'Anfitrion'){
        
            /*Se agrega el nuevo rol*/
            $this->modelUsuario->agregarCambiarRol($this->configs->defaultRolAnfitrion);
            /*Se actualiza el rol del usuario*/
            $data=[
                'idUsuario' => session('idUsuario'),
                'idRol' => $this->modelUsuario->asignarCambiarRol
            ];
            /*Se guarda los datos actualizados del usuario*/
            $this->modelUsuario->save($data);

            /*Se busca el nuevo rol*/
            $this->modelUsuario->buscarRol($this->modelUsuario->asignarCambiarRol);
            /*Se asigna el nuevo rol en la session*/
            session()->set([
                'idRol' => $this->modelUsuario->asignarCambiarRol,
                'rol' => $this->modelUsuario->asignarVistaRol
            ]);
            
            /*Redirecciona al inicio de anfitrion ya que el usuario ya es anfitrion con un mensaje de bienvenida*/
            return redirect()->route('anfitrionInicio')->with('msg',[
                'type'=>'success',
                'body'=>'Bienvenido'
            ]);
        }

        /*Si no es anfitrion se carga la vista para hacerse anfitrion*/
        
        /*Se muestra la vista de hazte un anfitrion y se pasa los parametros de todos los idiomas*/
        return view('usuario/hazteAnfitrion',[
            'idiomas' => $this->modelIdioma->findAll()
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/
}