<?php

namespace App\Controllers\Anfitrion;
use App\Entities\Usuario;

use App\Controllers\BaseController;

class Anfitrion extends BaseController{
    /*Variable global*/
    protected $configs;
    protected $modelAnfitrion;
    protected $modelUsuario;
    protected $modelServicio;


    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct(){
        $this->configs=config('Airbnb');
        $this->modelAnfitrion = model('AnfitrionesModel');
        $this->modelUsuario = model('UsuarioModel');
        $this->modelServicio = model('ServiciosModel');

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

/*--Funcion para publicar servicios del anfitrion-----------------------------------------------------------*/    
public function publicar(){
    return view('anfitrion/publicar');

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
public function RegistrarPublicacion(){
    /*Valida las diferentes reglas para los campos de registro de usuario*/
    $validar = service('validation');

    $validar->setRules([
        'foto'=>'required',
        'nombre'=>'required|alpha_space',
        'descripcion'=>'required|alpha_space',
        'idTipoHospedaje'=>'required',
        'direccion'=>'required',

        'idTarifa'=>'required',
        'idMunicipio'=>'required',
        'disponibilidad'=>'required',

    ],
    [
        'nombre' => [
                'required' => 'Digite un nombre',
                'alpha_space' => 'Caracteres no permitidos'
        ],
        'descripcion' => [
            'required' => 'Digite una descripcion',
            'alpha_space' => 'Caracteres no permitidos'
        ],
        'idTipoHospedaje' => [
            'required' => 'Digite un número',
          
        ],
        'direccion' => [
            'required' => 'Digite una direccion ',
        ],
        'idTarifa' => [
            'required' => 'Digite una tarifa  ',
        ],
        'idMunicipio' => [
            'required' => 'Digite un municipio ',
        ],
    ]
    );
    
    /*Si alguna regla falla vuelve a la vista y muestra el error*/
    if(!$validar->withRequest($this->request)->run()){
        return redirect()->back()->withInput()->with('errors',$validar->getErrors());
    }

    $imageFile = $this->request->getFile('foto');
    $validationRules = [
        'foto' => [
            'rules' => [
                'uploaded[foto]',
                'mime_in[foto,image/png,image/jpg,image/jpeg]',
               /* 'max_size[imagePerfil,100]',
                'max_dims[imagePerfil,1024,768]',*/
            ],
            'errors' => [
                'uploaded' => 'No ha subido imagen',
                'mime_in' => 'Tipo de imagen no disponible'
            ],
        ]
    ];
    if (! $this->validate($validationRules)) {
        return redirect()->back()->withInput()->with('errorImg',$this->validator->getErrors());
    }

    if(!$imageFile->isValid() && $imageFile->hasMoved()){
        return redirect()->back()->withInput()->with('errorImg',$this->validator->getErrors());
    }
    
    $imagen = \Config\Services::image()->withFile($imageFile)->fit(500,500)->save($imageFile);
    
    $newName=$imageFile->getRandomName();
    
    $direccion='C:/laragon/www/proyect_airbnb/public/img/publicaciones/';
    $direccionGuardado='/img/publicaciones/'.$newName;
    
    if(!$imageFile->move($direccion,$newName)){
        return redirect()->back()->withInput()->with('msg',[
            'type'=>'Danger',
            'body'=>'Imagen no se pudo guardar.']);
    }


    /*Si ninguna regla falla obtiene todos los datos en la entidad usuario*/
    $usuario = new Usuario($this->request->getPost());

    /*Genera un username
    $usuario->generarUsername();
    */
    
    /*Asigna un rol al usuario
    $this->modelUsuario->agregarUnRol($this->configs->defaultRolUsuario);
    //$model->agregarUnDosRol($this->configs->defaultRolUsuario);
    */

    $this->modelServicio->agregarFoto($direccionGuardado);

    /*Guarda los datos del usuario*/
    $this->modelServicio->save($usuario);

    /*Redirecciona a la vista login y muestra un mensaje de exito*/
    return redirect()->route('inicio')->with('msg',[
        'type'=>'success',
        'body'=>'Usuario registrado correctamente'
    ]);
}
}