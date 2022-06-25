<?php

namespace App\Controllers\Usuario;
use App\Entities\Usuario;
use App\Entities\Anfitrion;

use App\Controllers\BaseController;

class Usuarios extends BaseController{
    /*Variable global*/
    protected $configs;
    protected $modelUsuario;
    protected $modelAnfitrion;

    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct(){
        $this->configs=config('Airbnb');
        $this->modelUsuario = model('UsuarioModel');
        $this->modelAnfitrion = model('AnfitrionesModel');
    }

/*--Funcin para vista de inicio del usuario--------------------------------------------------------------*/
    public function index(){
        /*Muestra la vista del inicio del usuario*/
        return view('usuario/inicio');
    }
/*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/    
    public function perfil(){
        /*Muestra la vista de inicio del anfitrion*/
        return view('usuario/perfil',[
            'usuario' => $this->modelUsuario->find(session('idUsuario')),
            'anfitrion' => $this->modelAnfitrion->find(session('idAnfitrion')),
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/

/*--Funcin para vista de usuario hacerse anfitrion-------------------------------------------------------*/
    public function hazteAnfitrion(){
        /*Verificar que el rol de control sea igual a anfitrion*/
        if(session('rol2') == 'Anfitrion'){
            /*Se carga el model UsuarioModel*/
            $modelUsuario=model('UsuarioModel');
        
            /*Se agrega el nuevo rol*/
            $modelUsuario->agregarCambiarRol($this->configs->defaultRolAnfitrion);
            /*Se actualiza el rol del usuario*/
            $data=[
                'idUsuario' => session('idUsuario'),
                'idRol' => $modelUsuario->asignarCambiarRol
            ];
            /*Se guarda los datos actualizados del usuario*/
            $modelUsuario->save($data);

            /*Se busca el nuevo rol*/
            $modelUsuario->buscarRol($modelUsuario->asignarCambiarRol);
            /*Se asigna el nuevo rol en la session*/
            session()->set([
                'idRol' => $modelUsuario->asignarCambiarRol,
                'rol' => $modelUsuario->asignarVistaRol
            ]);
            
            /*Redirecciona al inicio de anfitrion ya que el usuario ya es anfitrion con un mensaje de bienvenida*/
            return redirect()->route('anfitrionInicio')->with('msg',[
                'type'=>'success',
                'body'=>'Bienvenido'
            ]);
        }

        /*Si no es anfitrion se carga la vista para hacerse anfitrion*/

        /*Se carga el modelo IdiomasModel*/
        $model = model('IdiomasModel');
        /*Se muestra la vista de hazte un anfitrion y se pasa los parametros de todos los idiomas*/
        return view('usuario/hazteAnfitrion',[
            'idiomas' => $model->findAll()
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/

/*--Funcion para cerrar sesion del usuario---------------------------------------------------------------*/
    public function cerrar(){
        /*Se destruye la session*/
        session()->destroy();
        /*Redirecciona a la vista login*/
        return redirect()->route('login');
    }
/*-------------------------------------------------------------------------------------------------------*/

/*--Funcion para registrarse como anfitrion--------------------------------------------------------------*/
    public function registrarAnfitrion(){
        /*Valida las reglas para registrarse como anfitrion*/
        $validar = service('validation');

        $validar->setRules([
            'descripcion'=>'required|alpha_space',
            'cuentaBanco'=>'required|numeric',
            'banco'=>'required|alpha_space',
            'idiomaPrimario'=>'required|is_not_unique[tbl_idiomas.idioma]',
        ],
        [
            'descripcion' => [
                    'required' => 'Digite una descipcion',
                    'alpha_space' => 'Caracteres no permitidos'
            ],
            'cuentaBanco' => [
                'required' => 'Digite una cuenta de banco',
                'numeric' => 'Solo numeros'
            ],
            'banco' => [
                'required' => 'Digite un banco',
                'alpha_space' => 'Caracteres no permitidos'
            ],
            'idiomaPrimario' => [
                'required' => 'Seleccione un idioma',
                'is_not_unique' => 'Idioma no disponible'
            ],
        ]
        );

        /*Si alguna regla falla vuelve a la vista y muestra el error*/
        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        /*$imageFile = $this->request->getFile('imagen');
        $validationRules = [
            'imagen' => [
                'rules' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/png,image/jpg,image/jpeg]',
                   /* 'max_size[imagePerfil,100]',
                    'max_dims[imagePerfil,1024,768]',*/
                /*],
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
        
        $direccion='C:/laragon/www/proyect_airbnb/public/img/perfiles/';
        $direccionGuardado='/img/perfiles/'.$newName;
        
        if(!$imageFile->move($direccion,$newName)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'Danger',
                'body'=>'Imagen no se pudo guardar.']);
        }*/

        /*Si ninguna regla falla obtiene todos los datos en la entidad anfitrion*/
        $anfitrion = new Anfitrion($this->request->getPost());
        
        /*Se carga el modelo AnfitrionesModel y el modelo UsuarioModel*/
        $model=model('AnfitrionesModel');
        $modelUsuario=model('UsuarioModel');

        /*Se agregan lo idiomas al anfitrion*/
        $model->agregarIdiomaPrimario($this->request->getPost('idiomaPrimario'));
        $model->agregarIdiomaSecundario($this->request->getPost('idiomaSecundario'));
        $model->agregarIdiomaExtra($this->request->getPost('idiomaExtra'));
        //$model->agregarFoto($direccionGuardado);

        /*Se cambia el rol a anfitrion*/
        $modelUsuario->agregarCambiarRol($this->configs->defaultRolAnfitrion);

        /*Se actualizan los roles del usuario*/
        $data=[
            'idUsuario' => session('idUsuario'),
            'idRol' => $modelUsuario->asignarCambiarRol,
            'idRol2' => $modelUsuario->asignarCambiarRol,
        ];
        /*Se guardan los datos actualizados del usuario*/
        $modelUsuario->save($data);
        
        /*Se agrega el usuario correspondiente al anfitrion*/
        $model->agregarElUsuario(session('email'));
        
        /*Se guardan los datos del anfitrion*/
        $model->save($anfitrion);

        /*Se buscan los roles para la vista de usuario*/
        $modelUsuario->buscarRol($modelUsuario->asignarCambiarRol);
        $modelUsuario->buscarRolDos($modelUsuario->asignarCambiarRol);

        $idAnfitrion = $model->where('idUsuario',session('idUsuario'))->findColumn('idAnfitrion');
        if($idAnfitrion == null){
            $idAnfitrion[0] = 0;
        }

        /*Se agregan los nuevos roles a la session*/
        session()->set([
            'idRol' => $modelUsuario->asignarCambiarRol,
            'idAnfitrion' => $idAnfitrion[0],
            'rol' => $modelUsuario->asignarVistaRol,
            'rol2' => $modelUsuario->asignarVistaDosRol
        ]);

        /*Redirecciona a la vista del inicio del anfitrion con un mensaje de que ya es anfitrion*/
        return redirect()->route('anfitrionInicio')->with('msg',[
            'type'=>'success',
            'body'=>'Ya eres anfitrión'
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/
}