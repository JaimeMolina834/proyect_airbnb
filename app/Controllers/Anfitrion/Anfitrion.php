<?php

namespace App\Controllers\Anfitrion;

use App\Entities\Usuario;

use App\Controllers\BaseController;

class Anfitrion extends BaseController
{
    /*Variable global*/
    protected $configs;
    protected $modelAnfitrion;
    protected $modelUsuario;
    protected $modelServicio;


    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct()
    {
        $this->configs = config('Airbnb');
        $this->modelAnfitrion = model('AnfitrionesModel');
        $this->modelUsuario = model('UsuarioModel');
        $this->modelServicio = model('ServiciosModel');
    }

    /*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/
    public function index()
    {
        /*Muestra la vista de inicio del anfitrion*/
        return view('anfitrion/inicio');
    }

    /*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/
    public function perfil()
    {
        return view('anfitrion/perfil', [
            'usuario' => $this->modelUsuario->find(session('idUsuario')),
            'anfitrion' => $this->modelAnfitrion->find(session('idAnfitrion')),
        ]);
    }
    /*-------------------------------------------------------------------------------------------------------*/

    /*--Funcion para publicar servicios del anfitrion-----------------------------------------------------------*/
    public function publicar()
    {
        return view('anfitrion/publicar');
    }
    /*-------------------------------------------------------------------------------------------------------*/

    public function buscar()
    {
        $data = [
            'idUsuario' => session('idUsuario'),
            'idRol' => $this->modelUsuario->asignarCambiarRol
        ];
        return view('anfitrion/buscar',$data);
    }

    /*--Funcion para cerrar sesion del anfitrion--------------------------------------------------------------*/
    public function cerrar()
    {
        /*Se destruye la session*/
        session()->destroy();
        /*Redirecciona a la vista de inicio de sesion*/
        return redirect()->route('login');
    }
    /*--------------------------------------------------------------------------------------------------------*/

    /*--Funcion para regresar a la vista de usuario-----------------------------------------------------------*/
    public function regresarUsuario()
    {

        /*Se agrega el cambio del rol al usuario*/
        $this->modelUsuario->agregarCambiarRol($this->configs->defaultRolUsuario);
        /*Se actualizan los datos de rol del usuario*/
        $data = [
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
        return redirect()->route('usuarioInicio')->with('msg', [
            'type' => 'success',
            'body' => 'Has vuelto'
        ]);
    }
     /*--Funcion para publicar hospedaje como Anfitrion-----------------------------------------------------------*/
    public function RegistrarPublicacion()
    {

        /*Valida las reglas para publicar hospedaje como anfitrion*/
        $validar = service('validation');

        $validar->setRules(
            [
                'nombre' => 'required',
                'descripcion' => 'required',
                'idTipoHospedaje' => 'required|is_not_unique[tbl_tipo_hospedajes.tipoHospedaje]',
                'direccion' => 'required',
                'idTarifa' => 'required|numeric|is_not_unique[tbl_tarifas.precio]',
                'idMunicipio' => 'required|is_not_unique[tbl_municipios.municipio]',
                'disponibilidad' => 'required|numeric',
                'idAnfitrion' => 'required|numeric|is_not_unique[tbl_anfitriones.idAnfitrion]'
            ],
            [
                'nombre' => [
                    'required' => 'Digite un nombre del hospedaje',
                ],
                'descripcion' => [
                    'required' => 'Digite una descripcion',
                ],
                'idTipoHospedaje' => [
                    'required' => 'Seleccione un tipo de hospedaje',
                    'is_not_unique' => 'Este tipo de hospedaje no existe'
                ],
                'direccion' => [
                    'required' => 'Digite una direccion de hospedaje',
                ],
                'idTarifa' => [
                    'required' => 'Seleccione precio de hospedaje',
                    'numeric' => 'Solo digite numeros',
                    'is_not_unique' => 'Esta tarifa no existe'
                ],
                'idMunicipio' => [
                    'required' => 'Seleccione un municipio',
                    'is_not_unique' => 'Este municipio no existe'
                ],
                'disponibilidad' => [
                    'required' => 'Seleccione una disponibilidad',
                    'numeric' => 'Solo digite numeros',
                ],
                'idAnfitrion' => [
                    'required' => 'Seleccione un anfitrion',
                    'numeric' => 'Solo numeros',
                    'is_not_unique' => 'Este anfitrion no existe'
                ],
            ]
        );

        /*Si alguna regla falla vuelve a la vista y muestra el error*/
        if (!$validar->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validar->getErrors());
        }

        $imageFile = $this->request->getFile('foto');
        $validationRules = [
            'foto' => [
                'rules' => [
                    'uploaded[foto]',
                    'mime_in[foto,image/png,image/jpg,image/jpeg]',
                ],
                'errors' => [
                    'uploaded' => 'No ha subido imagen',
                    'mime_in' => 'Tipo de imagen no disponible'
                ],
            ]
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errorImg', $this->validator->getErrors());
        }

        if (!$imageFile->isValid() && $imageFile->hasMoved()) {
            return redirect()->back()->withInput()->with('errorImg', $this->validator->getErrors());
        }

        $imagen = \Config\Services::image()->withFile($imageFile)->fit(500, 500)->save($imageFile);

        $newName = $imageFile->getRandomName();

        $direccion = 'C:/laragon/www/proyect_airbnb/public/img/publicaciones/';
        $direccionGuardado = '/img/publicaciones/' . $newName;

        if (!$imageFile->move($direccion, $newName)) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'Danger',
                'body' => 'Imagen no se pudo guardar.'
            ]);
        }

         /*Si ninguna regla falla se obtiene los datos para el usuario*/
         $recuperarPostUsuario=[
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'tipoHospedaje' => $this->request->getPost('idTipoHospedaje'),
            'direccion' => $this->request->getPost('direccion'),
            'precio' => $this->request->getPost('idTarifa'),
            'municipio' => $this->request->getPost('idMunicipio'),
            'disponibilidad' => $this->request->getPost('disponibilidad'),
            'idAnfitrion' => $this->request->getPost('idAnfitrion')           
        ];
           /*Guarda la imagen en un directorio del proyecto*/
        $this->modelServicio->agregarFoto($direccionGuardado);

            /*Guarda los datos del usuario*/
        $this->modelServicio->save($recuperarPostUsuario);

       
        
        
        /*Redirecciona a la vista login y muestra un mensaje de exito*/
        return redirect()->route('anfitrion/publicar')->with('msg',[
            'type'=>'success',
            'body'=>'Publicacion registrada con exito!'
        ]);
        
       
    }
}
