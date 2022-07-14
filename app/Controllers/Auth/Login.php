<?php

namespace App\Controllers\Auth;
use App\Entities\Usuario;

use App\Controllers\BaseController;

class Login extends BaseController{
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

/*--Funcin para iniciar sesion---------------------------------------------------------------------------*/
    public function signin(){
        /*Valida las diferentes reglas para los campos requeridos para iniciar sesion*/
        if(!$this->validate([
            'email'=>'required|valid_email',
            'password'=>'required'
        ],[
            'email' => [
                'required' => 'Digite un correo',
                'valid_email' => 'Correo no valido'
            ],
            'password' => [
                'required' => 'Digite una contraseña'
            ],
        ])){
            /*Si alguna regla falla vuelve a la vista y muestra el error*/
            return redirect()->back()->with('errors',$this->validator->getErrors())->withInput();
        }

        /*Si ninguna regla falla obtiene los datos para poder iniciar sesion*/
        $email = trim($this->request->getVar('email'));
        $password = trim($this->request->getVar('password'));

        /*Busca si existe un usuario con ese email ingresado*/
        if(!$usuario = $this->modelUsuario->buscarUsuario('email', $email)){
            /*Si no existe un usuario regresa a la vista y muestra el error*/
            return redirect()
                    ->back()
                    ->with('msg',[
                        'type'=>'danger',
                        'body'=>'Este usuario no esta registrado']);
        }
        
        /*Si existe un usuario, compara la contraseña ingresada con la del usuario*/
        if(!password_verify($password,$usuario->password)){
            /*Si las contraseñas no son iguales regresa a la vista y muestra el error*/
            return redirect()
                    ->back()
                    ->with('msg',[
                        'type'=>'danger',
                        'body'=>'Credenciales invalidas']);
        }

        /*Si el usuario es correcto y la contraseña, busca los roles correspondiente al usuario*/
        $this->modelUsuario->buscarRol($usuario->idRol);
        $this->modelUsuario->buscarRolDos($usuario->idRol2);
        $idAnfitrion = $this->modelAnfitrion->where('idUsuario',$usuario->idUsuario)->findColumn('idAnfitrion');
        if($idAnfitrion == null){
            $idAnfitrion[0] = 0;
        }
        //dd($idAnfitrion[0]);

        /*Carga las diferentes propiedades del usuario en session*/
        session()->set([
            'idUsuario' => $usuario->idUsuario,
            'idAnfitrion' => $idAnfitrion[0],
            'username' => $usuario->username,
            'idRol' => $usuario->idRol,
            'rol'=>$this->modelUsuario->asignarVistaRol,
            'email' =>$usuario->email,
            'rol2'=>$this->modelUsuario->asignarVistaDosRol,
            'is_logged' => true
        ]);

        /*Redireccion a la vista correspondiente al rol del usuario*/

        /*Redirecciona al inicio del rol usuario*/
        if($this->modelUsuario->asignarVistaRol == $this->configs->defaultRolUsuario){
            return redirect()->route('usuarioInicio')->with('msg',[
                'type'=>'success',
                'body'=>'Bienvenido '.$usuario->username]);
        }

        /*Redirecciona al inicio del rol anfitrion*/
        if($this->modelUsuario->asignarVistaRol == $this->configs->defaultRolAnfitrion){
            return redirect()->route('anfitrionInicio')->with('msg',[
                'type'=>'success',
                'body'=>'Bienvenido '.$usuario->username]);
        }

        /*Redirecciona al inicio del rol admin*/
        if($this->modelUsuario->asignarVistaRol == $this->configs->defaultRolAdmin){
            return redirect()->route('adminInicio')->with('msg',[
                'type'=>'success',
                'body'=>'Bienvenido '.$usuario->username]);
        }
    }
/*-------------------------------------------------------------------------------------------------------*/
}