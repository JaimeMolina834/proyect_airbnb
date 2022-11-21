<?php

namespace App\Controllers\Usuario;
use App\Entities\Usuario;
use App\Entities\Anfitrion;

use App\Controllers\BaseController;

class Registro extends BaseController{
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

/*--Funcion para cerrar sesion del usuario---------------------------------------------------------------*/
    public function cerrar(){
        /*Se destruye la session*/
        session()->destroy();
        /*Redirecciona a la vista login*/
        return redirect()->route('login');
    }

/*--Funcion para registrarse como anfitrion--------------------------------------------------------------*/
    public function registrarAnfitrion(){
        $input = $this->getRequestInput($this->request);
        /*Valida las reglas para registrarse como anfitrion*/
        $validar = service('validation');

        $validar->setRules([
            'descripcion'=>'required|alpha_space',
            'cuentaBanco'=>'required|numeric',
            'banco'=>'required|alpha_space',
            'idiomaPrimario'=>'required|is_not_unique[tbl_idiomas.idIdioma]',
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

        if($input['idiomaSecundario'] != 'Elije un idioma' || $input['idiomaExtra'] != 'Elije un idioma'){
            if($input['idiomaPrimario'] == $input['idiomaSecundario'] || $input['idiomaPrimario'] == $input['idiomaExtra'] || $input['idiomaSecundario'] == $input['idiomaExtra']){
                return redirect()->back()->withInput()->with('errors',[
                    'idiomaPrimario' => 'Los idiomas no pueden ser iguales'
                ]);
            }
        }

        //dd('Paso');


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

        /*Se agregan lo idiomas al anfitrion*/
        $this->modelAnfitrion->agregarIdiomaPrimario($this->request->getPost('idiomaPrimario'));
        $this->modelAnfitrion->agregarIdiomaSecundario($this->request->getPost('idiomaSecundario'));
        $this->modelAnfitrion->agregarIdiomaExtra($this->request->getPost('idiomaExtra'));
        //$model->agregarFoto($direccionGuardado);

        /*Se cambia el rol a anfitrion*/
        $this->modelUsuario->agregarCambiarRol($this->configs->defaultRolAnfitrion);

        /*Se actualizan los roles del usuario*/
        $data=[
            'idUsuario' => session('idUsuario'),
            'idRol' => $this->modelUsuario->asignarCambiarRol,
            //'idRol2' => $this->modelUsuario->asignarCambiarRol,
        ];
        /*Se guardan los datos actualizados del usuario*/
        $this->modelUsuario->save($data);
        
        /*Se agrega el usuario correspondiente al anfitrion*/
        $this->modelAnfitrion->agregarElUsuario(session('email'));
        
        /*Se guardan los datos del anfitrion*/
        $this->modelAnfitrion->save($anfitrion);

        /*Se buscan los roles para la vista de usuario*/
        $this->modelUsuario->buscarRol($this->modelUsuario->asignarCambiarRol);
        //$this->modelUsuario->buscarRolDos($this->modelUsuario->asignarCambiarRol);

        $idAnfitrion = $this->modelAnfitrion->where('idUsuario',session('idUsuario'))->findColumn('idAnfitrion');
        if($idAnfitrion == null){
            $idAnfitrion[0] = 0;
        }

        /*Se agregan los nuevos roles a la session*/
        session()->set([
            'idRol' => $this->modelUsuario->asignarCambiarRol,
            'idAnfitrion' => $idAnfitrion[0],
            'rol' => $this->modelUsuario->asignarVistaRol,
            //'rol2' => $this->modelUsuario->asignarVistaDosRol
        ]);

        /*Redirecciona a la vista del inicio del anfitrion con un mensaje de que ya es anfitrion*/
        return redirect()->route('anfitrionInicio')->with('msg',[
            'type'=>'success',
            'body'=>'Ya eres anfitrión'
        ]);
    }
}