<?php

namespace App\Controllers\Anfitrion;

use App\Entities\Usuario;

use App\Controllers\BaseController;
use CodeIgniter\Database\Query;

class Anfitrion extends BaseController
{
    /*Variable global*/
    protected $configs;
    protected $modelAnfitrion;
    protected $modelUsuario;
    protected $modelServicio;
    protected $modelTarifas;
    protected $model;
    protected $modelPais;
    protected $modelMunicipio;


    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct()
    {
        $this->configs = config('Airbnb');
        $this->modelAnfitrion = model('AnfitrionesModel');
        $this->modelUsuario = model('UsuarioModel');
        $this->modelServicio = model('ServiciosModel');
        $this->modelTarifas = model('TarifasModel');
        $this->model = model('TipoHospedajesModel');
        $this->modelPais = model('PaisesModel');
        $this->modelDepartamento = model('DepartamentosModel');
        $this->modelMunicipio = model('MunicipiosModel');
    }

    /*--Funcion para vista de inicio del anfitrion-----------------------------------------------------------*/
    public function index()
    {
        /*Muestra la vista de inicio del anfitrion*/
        return view('anfitrion/inicio', [
        'servicios' => $this->modelServicio->where('idAnfitrion', session('idAnfitrion'))->findAll(),
        'municipios' => $this->modelMunicipio->findAll(),
        'tarifas' => $this->modelTarifas->findAll(),
        'tipoHospedajes' => $this->model->findAll(),
    ]);
        
        //'servicios' => $this->modelServicio->where('idAnfitrion',session('idAnfitrion'))->findAll();
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
           /*Muestra la vista de publicar del anfitrión y se pasa los parametros de todos los tipo de hospedajes*/
           return view ('anfitrion/publicar',[
               'tipoHospedajes' => $this->model->findAll(),
               'paises' => $this->modelPais->findAll(),
               'departamentos' => $this->modelDepartamento->findAll(),
               'municipios' => $this->modelMunicipio->findAll(),

           ]);
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
                'idTipoHospedaje' => 'required|is_not_unique[tbl_tipo_hospedajes.idTipoHospedaje]',
                'direccion' => 'required',
                'precio' => 'required|numeric',
                'idMunicipio' => 'required|is_not_unique[tbl_municipios.idMunicipio]',
                'descuento' => 'required|numeric',
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
                'precio' => [
                    'required' => 'Seleccione precio de hospedaje',
                    'numeric' => 'Solo digite numeros',
                ],
                'idMunicipio' => [
                    'required' => 'Seleccione un municipio',
                    'is_not_unique' => 'Este municipio no existe'
                ],
                'descuento' => [
                    'required' => 'Digite un descuento',
                    'numeric' => 'Solo digite numeros',
                ],
            ]
        );

        /*Si alguna regla falla vuelve a la vista y muestra el error*/
        if (!$validar->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validar->getErrors());
        }

        $archivoTamano = count($_FILES['foto']);
        
        $fileAnfitrion = session('idAnfitrion');
        $direccionGuardado = '/img/publicaciones/' . $fileAnfitrion . '/';

        $estructura = 'C:/laragon/www/proyect_airbnb/public/img/publicaciones/'.$fileAnfitrion.'/';
        
        if(!file_exists($estructura)){
            mkdir($estructura, 0777, true);
        }

        for($i=0 ; $i < 3; $i++){
            $imagen = \Config\Services::image()->withFile($_FILES['foto']['tmp_name'][$i])->fit(500,500)->save($_FILES['foto']['tmp_name'][$i]);
    
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $path = $_FILES['foto']['name'][$i];
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $newName = substr(str_shuffle($permitted_chars), 0, 16).'.'.$extension;                    
            //$newName=$_FILES['image']['name'][$i]->getRandomName();
            
            $direccion='C:/laragon/www/proyect_airbnb/public/img/publicaciones/'.$fileAnfitrion.'/'.$newName;
            move_uploaded_file($_FILES['foto']['tmp_name'][$i],$direccion);
            /*if(!$_FILES['image']['tmp_name'][$i]->move($direccion,$newName)){
                return redirect()->back()->withInput()->with('msg',[
                    'type'=>'Danger',
                    'body'=>'Imagen no se pudo guardar.']);
            }*/
        }

        /*$imageFile = $this->request->getFile('foto');
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
        $fileAnfitrion = session('idAnfitrion');


        $direccion = 'C:/laragon/www/univo/public/img/publicaciones/' . $fileAnfitrion;
        $direccionGuardado = '/img/publicaciones/' . $fileAnfitrion . '/';

        if (!$imageFile->move($direccion, $newName)) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'Danger',
                'body' => 'Imagen no se pudo guardar.'
            ]);
        }*/

        $recuperarPostPublicaciones=[
            'precio' => $this->request->getPost('precio'),
            'descuento' => $this->request->getPost('descuento'),
        ];       
        /*Se guarda la tarifa en la tabla tarifa que el Anfitrion asignó para su servicio */
        $this->modelTarifas->save($recuperarPostPublicaciones);

        /*Se recupera el ID despues de insertar en la tabla tarifas*/
        $lastIdTarifa = $this->modelTarifas->getInsertID();

         /*Si ninguna regla falla se obtiene los datos para el usuario*/
         $recuperarPostUsuario=[
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'idTipoHospedaje' => $this->request->getPost('idTipoHospedaje'),
            'direccion' => $this->request->getPost('direccion'),
            'idTarifa' => $lastIdTarifa,
            'idMunicipio' => $this->request->getPost('idMunicipio'),
            'disponibilidad' => 1,
            'foto' => $direccionGuardado,
            'idAnfitrion' => session('idAnfitrion')      
        ];

        /*Guarda la imagen en un directorio del proyecto*/
        $this->modelServicio->agregarFoto($direccionGuardado);

            /*Guarda los datos del usuario*/
        $this->modelServicio->save($recuperarPostUsuario);

        /*Redirecciona a la vista login y muestra un mensaje de exito*/
        return redirect()->route('anfitrionInicio')->with('msg',[
            'type'=>'success',
            'body'=>'Publicacion registrada con exito!'
        ]);  
    }  
    
}