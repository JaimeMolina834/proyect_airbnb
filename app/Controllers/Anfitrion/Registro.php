<?php

namespace App\Controllers\Anfitrion;

use App\Entities\Usuario;

use App\Controllers\BaseController;
use CodeIgniter\Database\Query;
use CodeIgniter\HTTP\ResponseInterface;

class Registro extends BaseController
{
    /*Variable global*/
    protected $configs;
    protected $modelAnfitrion;
    protected $modelUsuario;
    protected $modelServicio;
    protected $modelTarifas;
    protected $modelIdiomas;
    protected $modelTipoHospedaje;
    protected $modelPais;
    protected $modelDepartamento;
    protected $modelMunicipio;
    protected $modelImagenes;
    protected $modelSubServicios;
    protected $modelSaludSeguridad;
    protected $modelReglaServicios;
    protected $modelPoliticaCancelacion;
    protected $modelGuardarSubServicios;
    protected $modelGuardarSaludSeguridad;
    protected $modelGuardarReglaServicios;
    protected $modelGuardarPoliticaCancelacion;
    protected $modelHuespedes;


    /*Constructor para cargar el archivo de configuracion Airbnb*/
    public function __construct()
    {
        $this->configs = config('Airbnb');
        $this->modelAnfitrion = model('AnfitrionesModel');
        $this->modelUsuario = model('UsuarioModel');
        $this->modelServicio = model('ServiciosModel');
        $this->modelTarifas = model('TarifasModel');
        $this->modelIdiomas = model('IdiomasModel');
        $this->modelTipoHospedaje = model('TipoHospedajesModel');
        $this->modelPais = model('PaisesModel');
        $this->modelDepartamento = model('DepartamentosModel');
        $this->modelMunicipio = model('MunicipiosModel');
        $this->modelImagenes = model('ImagenesModel');
        $this->modelSubServicios = model('SubServiciosModel');
        $this->modelSaludSeguridad = model('SaludSeguridadModel');
        $this->modelReglaServicios = model('ReglasServiciosModel');
        $this->modelPoliticaCancelacion = model('PoliticasCancelacionModel');
        $this->modelGuardarSubServicios = model('GuardarSubServiciosModel');
        $this->modelGuardarSaludSeguridad = model('GuardarSaludSeguridadModel');
        $this->modelGuardarReglaServicios = model('GuardarReglasServiciosModel');
        $this->modelGuardarPoliticaCancelacion = model('GuardarPoliticasCancelacionModel');
        $this->modelHuespedes = model('HuespedesModel');
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function RegistrarPublicacion(){

        $input = $this->getRequestInput($this->request);

        $tamanoImagenes = count($_FILES['foto']['name']);

        for ($i=0; $i < $tamanoImagenes ; $i++) { 
            if(($_FILES['foto']['type'][$i] != 'image/jpg') && ($_FILES['foto']['type'][$i] != 'image/png') && ($_FILES['foto']['type'][$i] != 'image/jpeg')){
                return redirect()->back()->withInput()->with('errorImg','Tipo de imagen no valido');
            }
        }

        /*Valida las reglas para publicar hospedaje como anfitrion*/
        $validar = service('validation');

        $validar->setRules(
            [
                'nombre' => 'required',
                'descripcion' => 'required',
                'idTipoHospedaje' => 'required|is_not_unique[tbl_tipo_hospedajes.idTipoHospedaje]',
                'direccion' => 'required',
                'precio' => 'required|numeric|is_natural',
                'descuento' => 'required|numeric|is_natural',
                'idMunicipio' => 'required|is_not_unique[tbl_municipios.idMunicipio]',
                'adultos' => 'required|numeric|is_natural',
                'menores' => 'required|numeric|is_natural',
                'bebes' => 'required|numeric|is_natural',
                'mascotas' => 'required|numeric|is_natural',
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
                    'is_not_unique' => 'Tipo de hospedaje no valido'
                ],
                'direccion' => [
                    'required' => 'Digite una direccion de hospedaje',
                ],
                'precio' => [
                    'required' => 'Seleccione precio de hospedaje',
                    'numeric' => 'Solo digite numeros',
                    'is_natural' => 'Solo numeros entre 0 y 1000'
                ],
                'descuento' => [
                    'required' => 'Digite un descuento',
                    'numeric' => 'Solo digite numeros',
                    'is_natural' => 'Solo numeros entre 0 y 100'
                ],
                'idMunicipio' => [
                    'required' => 'Seleccione un municipio',
                    'is_not_unique' => 'Municipio no valido'
                ],
                'adultos' => [
                    'required' => 'Digite cantidad de adultos',
                    'numeric' => 'Solo digite numeros',
                    'is_natural' => 'Solo numeros entre 0 y 10'
                ],
                'menores' => [
                    'required' => 'Digite cantidad de menores de edad',
                    'numeric' => 'Solo digite numeros',
                    'is_natural' => 'Solo numeros entre 0 y 10'
                ],
                'bebes' => [
                    'required' => 'Digite cantidad de bebes',
                    'numeric' => 'Solo digite numeros',
                    'is_natural' => 'Solo numeros entre 0 y 10'
                ],
                'mascotas' => [
                    'required' => 'Digite cantidad de mascotas',
                    'numeric' => 'Solo digite numeros',
                    'is_natural' => 'Solo numeros entre 0 y 10'
                ],

            ]
        );

        /*Si alguna regla falla vuelve a la vista y muestra el error*/
        if (!$validar->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validar->getErrors());
        }

        $error = false;
        $errores['idSubServicio'] = '';
        $errores['idSaludSeguridad'] = '';
        $errores['idReglaServicio'] = '';
        $errores['idPoliticaCancelacion'] = '';

        if(!isset($input['idSubServicio'])){
            $error = true;
            $errores['idSubServicio'] = 'Debe seleccionar al menos una opcion';
        }

        if(!isset($input['idSaludSeguridad'])){
            $error = true;
            $errores['idSaludSeguridad'] = 'Debe seleccionar al menos una opcion';
        }

        if(!isset($input['idReglaServicio'])){
            $error = true;
            $errores['idReglaServicio'] = 'Debe seleccionar al menos una opcion';
        }

        if(!isset($input['idPoliticaCancelacion'])){
            $error = true;
            $errores['idPoliticaCancelacion'] = 'Debe seleccionar al menos una opcion';
        }

        if($error == true){
            return redirect()->back()->withInput()->with('errors',[
                'idSubServicio'=>$errores['idSubServicio'],
                'idSaludSeguridad' => $errores['idSaludSeguridad'],
                'idReglaServicio' => $errores['idReglaServicio'],
                'idPoliticaCancelacion' => $errores['idPoliticaCancelacion'],
            ]);
        }

        $error = false;
        $errores['idSubServicio'] = '';
        $errores['idSaludSeguridad'] = '';
        $errores['idReglaServicio'] = '';
        $errores['idPoliticaCancelacion'] = '';

        $arrarySubServicios = $this->modelSubServicios->findColumn('idSubServicio');

        foreach ($input['idSubServicio'] as $keySubServicio) {
            if(!in_array($keySubServicio,$arrarySubServicios)){
                $error = true;
                $errores['idSubServicio'] = 'Sub servicio no valido';
            }
        }

        $arraySaludSeguridad = $this->modelSaludSeguridad->findColumn('idSaludSeguridad');

        foreach ($input['idSaludSeguridad'] as $keySaludSeguridad) {
            if(!in_array($keySaludSeguridad,$arraySaludSeguridad)){
                $error = true;
                $errores['idSaludSeguridad'] = 'Salud y seguridad no valido';
            }
        }

        $arrayReglaServicio = $this->modelReglaServicios->findColumn('idReglaServicio');

        foreach ($input['idReglaServicio'] as $keyReglaServicio) {
            if(!in_array($keyReglaServicio,$arrayReglaServicio)){
                $error = true;
                $errores['idReglaServicio'] = 'Regla de servicio no valido';
            }
        }

        $arrayPoliticaCancelacion = $this->modelPoliticaCancelacion->findColumn('idPoliticaCancelacion');

        foreach ($input['idPoliticaCancelacion'] as $keyPoliticaCancelacion) {
            if(!in_array($keyPoliticaCancelacion,$arrayPoliticaCancelacion)){
                $error = true;
                $errores['idPoliticaCancelacion'] = 'Politica de cancelacion no valido';
            }
        }

        if($error == true){
            return redirect()->back()->withInput()->with('errors',[
                'idSubServicio'=>$errores['idSubServicio'],
                'idSaludSeguridad' => $errores['idSaludSeguridad'],
                'idReglaServicio' => $errores['idReglaServicio'],
                'idPoliticaCancelacion' => $errores['idPoliticaCancelacion'],
            ]);
        }

        $archivoTamano = count($_FILES['foto']['name']);
        
        $fileAnfitrion = session('idAnfitrion');
        $numberRandomFile = rand(1,10000);


        $direccionGuardado = '/img/publicaciones/' . $fileAnfitrion . '/' . $numberRandomFile .'/';
        $estructura = 'C:/laragon/www/proyect_airbnb/public/img/publicaciones/'.$fileAnfitrion.'/' . $numberRandomFile .'/';
        
        if(!file_exists($estructura)){
            mkdir($estructura, 0777, true);
        }

        $recuperarPostPublicaciones=[
            'precio' => $input['precio'],
            'descuento' => $input['descuento'],
        ];       
        /*Se guarda la tarifa en la tabla tarifa que el Anfitrion asignó para su servicio */
        if(!$this->modelTarifas->save($recuperarPostPublicaciones)){
            if(file_exists($estructura)){
                rmdir($estructura);
            }
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Problema al guardar datos!'
            ]);
        }

        /*Se recupera el ID despues de insertar en la tabla tarifas*/
        $idTarifa = $this->modelTarifas->getInsertID();

        /*Si ninguna regla falla se obtiene los datos para el usuario*/
        $recuperarPostUsuario=[
            'nombre' => $input['nombre'],
            'descripcion' => $input['descripcion'],
            'idTipoHospedaje' => $input['idTipoHospedaje'],
            'direccion' => $input['direccion'],
            'idTarifa' => $idTarifa,
            'idMunicipio' => $input['idMunicipio'],
            'estatus' => 1,
            //'disponibilidad' => 0,
            //'foto' => $direccionGuardado,
            'idAnfitrion' => session('idAnfitrion')      
        ];

        /*Guarda la imagen en un directorio del proyecto*/
        //$this->modelServicio->agregarFoto($direccionGuardado);

            /*Guarda los datos del usuario*/
        if(!$this->modelServicio->save($recuperarPostUsuario)){
            if(file_exists($estructura)){
                rmdir($estructura);
            }
            $this->modelTarifas->delete($idTarifa);
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Problema al guardar datos!'
            ]);
        }

        $idServicio = $this->modelServicio->getInsertID();

        $tamanoSubServicios = count($input['idSubServicio']);
        $subServicio = $input['idSubServicio'];
        
        for($i=0 ; $i < $tamanoSubServicios; $i++){
            $guardar = [
                'idSubServicio' => $subServicio[$i],
                'idServicio' => $idServicio,
            ];
            if(!$this->modelGuardarSubServicios->save($guardar)){
                if(file_exists($estructura)){
                    rmdir($estructura);
                }
                $this->modelTarifas->delete($idTarifa);
                $this->modelServicio->delete($idServicio);
                return redirect()->back()->withInput()->with('msg',[
                    'type'=>'danger',
                    'body'=>'Problema al guardar datos!'
                ]);
            }
        }

        $tamanoReglaServicio = count($input['idReglaServicio']);
        $reglaServicio = $input['idReglaServicio'];

        
        for($i=0 ; $i < $tamanoReglaServicio; $i++){
            $guardar = [
                'idReglaServicio' => $reglaServicio[$i],
                'idServicio' => $idServicio,
            ];
            if(!$this->modelGuardarReglaServicios->save($guardar)){
                if(file_exists($estructura)){
                    rmdir($estructura);
                }
                $this->modelTarifas->delete($idTarifa);
                $this->modelServicio->delete($idServicio);
                return redirect()->back()->withInput()->with('msg',[
                    'type'=>'danger',
                    'body'=>'Problema al guardar datos!'
                ]);
            }
        }

        $tamanoSaludSeguridad = count($input['idSaludSeguridad']);
        $saludSeguridad = $input['idSaludSeguridad'];

        
        for($i=0 ; $i < $tamanoSaludSeguridad; $i++){
            $guardar = [
                'idSaludSeguridad' => $saludSeguridad[$i],
                'idServicio' => $idServicio,
            ];
            if(!$this->modelGuardarSaludSeguridad->save($guardar)){
                if(file_exists($estructura)){
                    rmdir($estructura);
                }
                $this->modelTarifas->delete($idTarifa);
                $this->modelServicio->delete($idServicio);
                return redirect()->back()->withInput()->with('msg',[
                    'type'=>'danger',
                    'body'=>'Problema al guardar datos!'
                ]);
            }
        }

        $tamanoPoliticaCancelacion = count($input['idPoliticaCancelacion']);
        $politicaCancelacion = $input['idPoliticaCancelacion'];

        
        for($i=0 ; $i < $tamanoPoliticaCancelacion; $i++){
            $guardar = [
                'idPoliticaCancelacion' => $politicaCancelacion[$i],
                'idServicio' => $idServicio,
            ];
            if(!$this->modelGuardarPoliticaCancelacion->save($guardar)){
                if(file_exists($estructura)){
                    rmdir($estructura);
                }
                $this->modelTarifas->delete($idTarifa);
                $this->modelServicio->delete($idServicio);
                return redirect()->back()->withInput()->with('msg',[
                    'type'=>'danger',
                    'body'=>'Problema al guardar datos!'
                ]);
            }
        }

        $dataHuespedes = [
            'adulto' => $input['adultos'],
            'bebes' => $input['bebes'],
            'menores' => $input['menores'],
            'mascotas' => $input['mascotas'],
            'idServicio' => $idServicio
        ];

        if(!$this->modelHuespedes->save($dataHuespedes)){
            if(file_exists($estructura)){
                rmdir($estructura);
            }
            $this->modelTarifas->delete($idTarifa);
            $this->modelServicio->delete($idServicio);
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Problema al guardar datos!'
            ]);
        }

        for($i=0 ; $i < $archivoTamano; $i++){
            $imagen = \Config\Services::image()->withFile($_FILES['foto']['tmp_name'][$i])->fit(500,500)->save($_FILES['foto']['tmp_name'][$i]);

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $path = $_FILES['foto']['name'][$i];
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $newName = substr(str_shuffle($permitted_chars), 0, 16).'.'.$extension;
            
            $direccion='C:/laragon/www/proyect_airbnb/public/img/publicaciones/'.$fileAnfitrion.'/' . $numberRandomFile .'/' .$newName;
            move_uploaded_file($_FILES['foto']['tmp_name'][$i],$direccion);

            $direccionGuardadoImagenes = 'http://proyect_airbnb.test/img/publicaciones/' .$fileAnfitrion.'/' . $numberRandomFile .'/' .$newName;
            $guardar = [
                'url' => $direccionGuardadoImagenes,
                'idServicio' => $idServicio
            ];
            if(!$this->modelImagenes->save($guardar)){
                $dir = 'C:/laragon/www/proyect_airbnb/public/img/publicaciones/'.$fileAnfitrion.'/' . $numberRandomFile .'/';

                if(!$dh = @opendir($dir)) return;
                    while (false !== ($current = readdir($dh))) {
                        if($current != '.' && $current != '..') {
                            //echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
                            if (!@unlink($dir.'/'.$current)) 
                                deleteDirectory($dir.'/'.$current);
                        }       
                    }
                closedir($dh);
                //echo 'Se ha borrado el directorio '.$dir.'<br/>';
                @rmdir($dir);
                $this->modelTarifas->delete($idTarifa);
                $this->modelServicio->delete($idServicio);
                return redirect()->back()->withInput()->with('msg',[
                    'type'=>'danger',
                    'body'=>'Problema al guardar datos!'
                ]);
            }
        }
        
        /*Redirecciona a la vista login y muestra un mensaje de exito*/
        return redirect()->route('anfitrionInicio')->with('msg',[
            'type'=>'success',
            'body'=>'Publicacion registrada con exito!'
        ]);  
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function cerrar(){
        /*Se destruye la session*/
        session()->destroy();
        /*Redirecciona a la vista de inicio de sesion*/
        return redirect()->route('login');
    }
/*---------------------------------------------------------------------------------------------------------------------*/
}