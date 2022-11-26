<?php

namespace App\Controllers\Auth;
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
/*--Funcion para registrar usuario-----------------------------------------------------------------------*/
    public function registrar(){
        /*Valida las diferentes reglas para los campos de registro de usuario*/
        $validar = service('validation');

        $validar->setRules([
            'nombre'=>'required|alpha_space',
            'apellido'=>'required|alpha_space',
            'email'=>'required|valid_email|is_unique[tbl_usuarios.email]',
            'numeroTelefono'=>'required|numeric|is_unique[tbl_usuarios.numeroTelefono]|min_length[8]|max_length[8]',
            'password'=>'required|matches[c-password]|min_length[8]|max_length[32]'
        ],
        [
            'nombre' => [
                    'required' => 'Digite un nombre',
                    'alpha_space' => 'Caracteres no permitidos'
            ],
            'apellido' => [
                'required' => 'Digite un apellido',
                'alpha_space' => 'Caracteres no permitidos'
            ],
            'email' => [
                'required' => 'Digite un correo',
                'valid_email' => 'Correo no valido',
                'is_unique' => 'Este correo ya existe'
            ],
            'numeroTelefono' => [
                'required' => 'Digite un número de telefono',
                'numeric' => 'Solo digite numeros',
                'is_unique' => 'Este número de telefono ya existe',
                'min_length' => 'El número de telefono debe tener 8 digítos',
                'max_length' => 'El número de telefono debe tener 8 digítos'
            ],
            'password' => [
                'required' => 'Digite su contraseña',
                'matches' => 'Las contraseñas no coinciden',
                'min_length' => 'La contraseña es muy corta',
                'max_length' => 'La contraseña es demasiado extensa'
            ],
        ]
        );
        
        /*Si alguna regla falla vuelve a la vista y muestra el error*/
        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        $imageFile = $this->request->getFile('imagen');
        $validationRules = [
            'imagen' => [
                'rules' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/png,image/jpg,image/jpeg]',
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
        
        $direccion='C:/laragon/www/proyect_airbnb/public/img/perfiles/';
        $direccionGuardado='/img/perfiles/'.$newName;
        
        if(!$imageFile->move($direccion,$newName)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'Danger',
                'body'=>'Imagen no se pudo guardar.']);
        }


        /*Si ninguna regla falla obtiene todos los datos en la entidad usuario*/
        $usuario = new Usuario($this->request->getPost());
        /*Genera un username*/
        $usuario->generarUsername();
        
        /*Asigna un rol al usuario*/
        $this->modelUsuario->agregarUnRol($this->configs->defaultRolUsuario);
        //$model->agregarUnDosRol($this->configs->defaultRolUsuario);

        $this->modelUsuario->agregarFoto($direccionGuardado);

        /*Guarda los datos del usuario*/
        $this->modelUsuario->save($usuario);

        /*Redirecciona a la vista login y muestra un mensaje de exito*/
        return redirect()->route('login')->with('msg',[
            'type'=>'success',
            'body'=>'Usuario registrado correctamente'
        ]);
    }
/*-------------------------------------------------------------------------------------------------------*/

/*--Funcion para registrar anfitrion---------------------------------------------------------------------*/
    public function registrarAnfitrion(){
        $input = $this->getRequestInput($this->request);
        /*Valida las reglas para registrarse como anfitrion*/
        $validar = service('validation');

        $validar->setRules([
            'nombre'=>'required|alpha_space',
            'apellido'=>'required|alpha_space',
            'email'=>'required|valid_email|is_unique[tbl_usuarios.email]',
            'numeroTelefono'=>'required|numeric|is_unique[tbl_usuarios.numeroTelefono]|min_length[8]|max_length[8]',
            'password'=>'required|matches[c-password]|min_length[8]|max_length[32]',
            'descripcion'=>'required|alpha_space',
            'cuentaBanco'=>'required|numeric|min_length[8]|max_length[12]',
            'banco'=>'required|alpha_space',
            'idiomaPrimario'=>'required|is_not_unique[tbl_idiomas.idIdioma]',
        ],
        [
            'nombre' => [
                    'required' => 'Digite un nombre',
                    'alpha_space' => 'Caracteres no permitidos'
            ],
            'apellido' => [
                'required' => 'Digite un apellido',
                'alpha_space' => 'Caracteres no permitidos'
            ],
            'email' => [
                'required' => 'Digite un correo',
                'valid_email' => 'Correo no valido',
                'is_unique' => 'Este correo ya existe'
            ],
            'numeroTelefono' => [
                'required' => 'Digite un número de telefono',
                'numeric' => 'Solo digite numeros',
                'is_unique' => 'Este número de telefono ya existe',
                'min_length' => 'El número de telefono debe tener 8 digítos',
                'max_length' => 'El número de telefono debe tener 8 digítos'
            ],
            'password' => [
                'required' => 'Digite su contraseña',
                'matches' => 'Las contraseñas no coinciden',
                'min_length' => 'La contraseña es muy corta',
                'max_length' => 'La contraseña es demasiado extensa'
            ],
            'descripcion' => [
                'required' => 'Digite una descipcion',
                'alpha_space' => 'Caracteres no permitidos'
            ],
            'cuentaBanco' => [
                'required' => 'Digite una cuenta de banco',
                'numeric' => 'Solo numeros',
                'min_length' => 'La cuenta de banco debe tener 8 a 12 digítos',
                'max_length' => 'La cuenta de banco debe tener 8 a 12 digítos'
            ],
            'banco' => [
                'required' => 'Digite un banco',
                'alpha_space' => 'Caracteres no permitidos'
            ],
            'idiomaPrimario' => [
                'required' => 'Seleccione un idioma',
                'is_not_unique' => 'Idioma no seleccionado'
            ],
        ]);

        /*Si alguna regla falla vuelve a la vista y muestra el error*/
        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }

        if($input['idiomaSecundario'] != 'Elije un idioma' || $input['idiomaExtra'] != 'Elije un idioma'){
            if($input['idiomaPrimario'] == $input['idiomaSecundario'] || $input['idiomaPrimario'] == $input['idiomaExtra'] || $input['idiomaSecundario'] == $input['idiomaExtra'] ){
                return redirect()->back()->withInput()->with('errors',[
                    'idiomaPrimario' => 'Los idiomas no pueden ser iguales'
                ]);
            }
        }

        $imageFile = $this->request->getFile('imagen');
        $validationRules = [
            'imagen' => [
                'rules' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/png,image/jpg,image/jpeg]',
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
        
        $direccion='C:/laragon/www/proyect_airbnb/public/img/perfiles/';
        $direccionGuardado='/img/perfiles/'.$newName;
        
        if(!$imageFile->move($direccion,$newName)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'Danger',
                'body'=>'Imagen no se pudo guardar.']);
        }

        /*Si ninguna regla falla se obtiene los datos para el usuario*/
        $recuperarPostUsuario=[
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'numeroTelefono' => $this->request->getPost('numeroTelefono'),
            'password' => $this->request->getPost('password')
        ];

        /*Se insertan los datos del usuario en la entidad usuario*/
        $usuario = new Usuario($recuperarPostUsuario);

        /*Se genera un username*/
        $usuario->generarUsername();
        
        /*Se agrega el rol al usuario*/
        $this->modelUsuario->agregarUnRol($this->configs->defaultRolAnfitrion);
        $this->modelUsuario->agregarFoto($direccionGuardado);

        /*Se guarda el usuario*/
        $this->modelUsuario->save($usuario);

        /*Se obtiene los datos para el anfitrion*/
        $recuperarPostAnfitrion=[
            'descripcion' => $this->request->getPost('descripcion'),
            'cuentaBanco' => $this->request->getPost('cuentaBanco'),
            'banco' => $this->request->getPost('banco')
        ];

        /*Se insertan los datos del anfitrion en la entidad anfitrion*/
        $anfitrion = new Anfitrion($recuperarPostAnfitrion);

        /*Se agregan lo idiomas al anfitrion*/
        $this->modelAnfitrion->agregarIdiomaPrimario($this->request->getPost('idiomaPrimario'));
        $this->modelAnfitrion->agregarIdiomaSecundario($this->request->getPost('idiomaSecundario'));
        $this->modelAnfitrion->agregarIdiomaExtra($this->request->getPost('idiomaExtra'));
        
        /*Se agrega el idUsuario correspondiente al anfitrion*/
        $this->modelAnfitrion->agregarElUsuario($this->request->getPost('email'));
        
        /*Se guarda los datos del anfitrion*/
        $this->modelAnfitrion->save($anfitrion);

        /*Redirecciona a la vista login y se muestra un mensaje de exito*/
        return redirect()->route('login')->with('msg',[
            'type'=>'success',
            'body'=>'Registrado como anfitrion exitoso!'
        ]);

    }
/*-------------------------------------------------------------------------------------------------------*/
}