<?php

namespace App\Controllers\Anfitrion;

use App\Entities\Usuario;

use App\Controllers\BaseController;
use CodeIgniter\Database\Query;
use CodeIgniter\HTTP\ResponseInterface;

class UpdateDelete extends BaseController
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
    public function ActualizarServicio(){
        if(!isset($_GET['id'])){
            return redirect()->route('anfitrionInicio');
        }
        
        $valorIdServicio = $_GET['id'];
        $idServicio = null;
        $buscar = $this->modelServicio->findAll();

        foreach ($buscar as $key) {
            if(password_verify($key->idServicio,$valorIdServicio)){
                $idServicio = $key->idServicio;
                break;
            }
        }
        if($idServicio == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $input = $this->getRequestInput($this->request);

        $validar = service('validation');

        $validar->setRules(
            [
                'nombre' => 'required',
                'descripcion' => 'required',
                'idTipoHospedaje' => 'required|is_not_unique[tbl_tipo_hospedajes.idTipoHospedaje]',
                'direccion' => 'required',
                'precio' => 'required|numeric|is_natural',
                'descuento' => 'required|numeric|is_natural',
                //'idMunicipio' => 'required|is_not_unique[tbl_municipios.idMunicipio]',
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

        $idTarifa = $this->modelServicio->where('idServicio',$idServicio)->findColumn('idTarifa');

        $actualizarPostTarifa=[
            'idTarifa' => $idTarifa,
            'precio' => $input['precio'],
            'descuento' => $input['descuento'],
        ];       

        if(!$this->modelTarifas->save($actualizarPostTarifa)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Problema al guardar datos!'
            ]);
        }

        $actualzarPostServicio=[
            'idServicio' => $idServicio,
            'nombre' => $input['nombre'],
            'descripcion' => $input['descripcion'],
            'idTipoHospedaje' => $input['idTipoHospedaje'],
            'direccion' => $input['direccion'],
            'disponibilidad' => 0,     
        ];
        if(!$this->modelServicio->save($actualzarPostServicio)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Problema al guardar datos!'
            ]);
        }

        $tamanoSubServicios = count($input['idSubServicio']);
        $subServicio = $input['idSubServicio'];
        $arraySubServicio = $this->modelGuardarSubServicios->where('idServicio',$idServicio)->findAll();
        $encontrarSubServicio = $this->modelGuardarSubServicios->where('idServicio',$idServicio)->findColumn('idSubServicio');
        $cuentaEliminarSub = count($encontrarSubServicio);
        if($arraySubServicio == null){
            $arraySubServicio[] = '';
        }

        for($i=0 ; $i < $cuentaEliminarSub; $i++){
            if(!in_array($arraySubServicio[$i]->idSubServicio,$subServicio)){
                $this->modelGuardarSubServicios->delete($arraySubServicio[$i]->idGuardar);
            }
        }
        
        for($i=0 ; $i < $tamanoSubServicios; $i++){
            if(!in_array($subServicio[$i],$encontrarSubServicio)){
                $guardar = [
                    'idSubServicio' => $subServicio[$i],
                    'idServicio' => $idServicio,
                ];
                if(!$this->modelGuardarSubServicios->save($guardar)){
                    return redirect()->back()->withInput()->with('msg',[
                        'type'=>'danger',
                        'body'=>'Problema al guardar datos!'
                    ]);
                }
            }
        }

        $tamanoReglaServicio = count($input['idReglaServicio']);
        $reglaServicio = $input['idReglaServicio'];
        $arrayReglaServicio = $this->modelGuardarReglaServicios->where('idServicio',$idServicio)->findAll();
        $encontrarReglaServicio = $this->modelGuardarReglaServicios->where('idServicio',$idServicio)->findColumn('idReglaServicio');
        $cuentaEliminarRegla = count($encontrarReglaServicio);
        if($arrayReglaServicio == null){
            $arrayReglaServicio[] = '';
        }

        for($i=0 ; $i < $cuentaEliminarRegla; $i++){
            if(!in_array($arrayReglaServicio[$i]->idReglaServicio,$reglaServicio)){
                $this->modelGuardarReglaServicios->delete($arrayReglaServicio[$i]->idGuardar);
            }
        }
        
        for($i=0 ; $i < $tamanoReglaServicio; $i++){
            if(!in_array($reglaServicio[$i],$encontrarReglaServicio)){
                $guardar = [
                    'idReglaServicio' => $reglaServicio[$i],
                    'idServicio' => $idServicio,
                ];
                if(!$this->modelGuardarReglaServicios->save($guardar)){
                    return redirect()->back()->withInput()->with('msg',[
                        'type'=>'danger',
                        'body'=>'Problema al guardar datos!'
                    ]);
                }
            }
        }

        $tamanoSaludSeguridad = count($input['idSaludSeguridad']);
        $saludSeguridad = $input['idSaludSeguridad'];
        $arraySaludSeguridad = $this->modelGuardarSaludSeguridad->where('idServicio',$idServicio)->findAll();
        $encontrarSaludSeguridad = $this->modelGuardarSaludSeguridad->where('idServicio',$idServicio)->findColumn('idSaludSeguridad');
        $cuentaEliminarSalud = count($encontrarSaludSeguridad);
        if($arraySaludSeguridad == null){
            $arraySaludSeguridad[] = '';
        }

        for($i=0 ; $i < $cuentaEliminarSalud; $i++){
            if(!in_array($arraySaludSeguridad[$i]->idSaludSeguridad,$saludSeguridad)){
                $this->modelGuardarSaludSeguridad->delete($arraySaludSeguridad[$i]->idGuardar);
            }
        }
        
        for($i=0 ; $i < $tamanoSaludSeguridad; $i++){
            if(!in_array($saludSeguridad[$i],$encontrarSaludSeguridad)){
                $guardar = [
                    'idSaludSeguridad' => $saludSeguridad[$i],
                    'idServicio' => $idServicio,
                ];
                if(!$this->modelGuardarSaludSeguridad->save($guardar)){
                    return redirect()->back()->withInput()->with('msg',[
                        'type'=>'danger',
                        'body'=>'Problema al guardar datos!'
                    ]);
                }
            }
        }

        $tamanoPoliticaCancelacion = count($input['idPoliticaCancelacion']);
        $politicaCancelacion = $input['idPoliticaCancelacion'];
        $arrayPolitica = $this->modelGuardarPoliticaCancelacion->where('idServicio',$idServicio)->findAll();
        $encontrarPolitica = $this->modelGuardarPoliticaCancelacion->where('idServicio',$idServicio)->findColumn('idPoliticaCancelacion');
        $cuentaEliminarPolitica = count($encontrarPolitica);
        if($arrayPolitica == null){
            $arrayPolitica[] = '';
        }
        
        for($i=0 ; $i < $cuentaEliminarPolitica; $i++){
            if(!in_array($arrayPolitica[$i]->idPoliticaCancelacion,$politicaCancelacion)){
                $this->modelGuardarPoliticaCancelacion->delete($arrayPolitica[$i]->idGuardar);
            }
        }
        
        for($i=0 ; $i < $tamanoPoliticaCancelacion; $i++){
            if(!in_array($politicaCancelacion[$i],$encontrarPolitica)){
                $guardar = [
                    'idPoliticaCancelacion' => $politicaCancelacion[$i],
                    'idServicio' => $idServicio,
                ];
                if(!$this->modelGuardarPoliticaCancelacion->save($guardar)){
                    return redirect()->back()->withInput()->with('msg',[
                        'type'=>'danger',
                        'body'=>'Problema al guardar datos!'
                    ]);
                }
            }
        }

        $idHuesped = $this->modelHuespedes->where('idServicio',$idServicio)->findColumn('idHuesped');

        $dataActualizarHuespedes = [
            'idHuesped'=> $idHuesped,
            'adulto' => $input['adultos'],
            'bebes' => $input['bebes'],
            'menores' => $input['menores'],
            'mascotas' => $input['mascotas'],
            'idServicio' => $idServicio
        ];

        if(!$this->modelHuespedes->save($dataActualizarHuespedes)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Problema al guardar datos!'
            ]);
        }
        
        return redirect()->route('anfitrionInicio')->with('msg',[
            'type'=>'success',
            'body'=>'Publicacion actualizada con exito!'
        ]);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function darBajaServicio(){
        if(!isset($_GET['id'])){
            return redirect()->route('anfitrionInicio');
        }
        
        $valorIdServicio = $_GET['id'];
        $idServicio = null;
        $buscar = $this->modelServicio->findAll();

        foreach ($buscar as $key) {
            if(password_verify($key->idServicio,$valorIdServicio)){
                $idServicio = $key->idServicio;
                break;
            }
        }
        if($idServicio == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }

        $dataActualizar = [
            'idServicio' => $idServicio,
            'estatus' => 0
        ];
        if(!$this->modelServicio->save($dataActualizar)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de baja!'
            ]);
        }

        return redirect()->route('anfitrionInicio');
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function darAltaServicio(){
        if(!isset($_GET['id'])){
            return redirect()->route('anfitrionInicio');
        }
        
        $valorIdServicio = $_GET['id'];
        $idServicio = null;
        $buscar = $this->modelServicio->findAll();

        foreach ($buscar as $key) {
            if(password_verify($key->idServicio,$valorIdServicio)){
                $idServicio = $key->idServicio;
                break;
            }
        }
        if($idServicio == null){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error!'
            ]);
        }
        $dataActualizar = [
            'idServicio' => $idServicio,
            'estatus' => 1
        ];
        if(!$this->modelServicio->save($dataActualizar)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al dar de baja!'
            ]);
        }
        return redirect()->route('anfitrionInicio');
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function ActualizarPerfil(){
        $input = $this->getRequestInput($this->request);
        $usuario = $this->modelUsuario->where('idUsuario',session('idUsuario'))->findAll();
        //$password = password_verify($input['passwordAnterior'],$usuario[0]->password);
        //dd($input['passwordAnterior']);
        
        $validar = service('validation');

        $validar->setRules([
            'nombre'=>'required|alpha_space',
            'apellido'=>'required|alpha_space',
            'descripcion'=>'required|alpha_space',
            'cuentaBanco'=>'required|numeric',
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
                'is_not_unique' => 'Idioma no valido'
            ],
        ]);

        if(!$validar->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validar->getErrors());
        }
        if($input['idiomaPrimario'] == $input['idiomaSecundario'] || $input['idiomaPrimario'] == $input['idiomaExtra'] || $input['idiomaSecundario'] == $input['idiomaExtra']){
            return redirect()->back()->withInput()->with('errors',[
                'idiomaPrimario' => 'Los idiomas no pueden ser iguales'
            ]);
        }

        if($input['idiomaSecundario'] != null && $input['idiomaSecundario'] != 'Elije un idioma'){
            $validar->setRules([
                'idiomaSecundario'=>'required|is_not_unique[tbl_idiomas.idIdioma]',
            ],
            [
                'idiomaSecundario' => [
                    'required' => 'Seleccione un idioma',
                    'is_not_unique' => 'Idioma no valido'
                ],
            ]);
            
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        if($input['idiomaExtra'] != null && $input['idiomaExtra'] != 'Elije un idioma'){
            $validar->setRules([
                'idiomaExtra'=>'required|is_not_unique[tbl_idiomas.idIdioma]',
            ],
            [
                'idiomaExtra' => [
                    'required' => 'Seleccione un idioma',
                    'is_not_unique' => 'Idioma no valido'
                ],
            ]);
            
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        if($input['email'] != $usuario[0]->email){
            $validar->setRules([
                'email'=>'required|valid_email|is_unique[tbl_usuarios.email]',
            ],
            [
                'email' => [
                    'required' => 'Digite un correo',
                    'valid_email' => 'Correo no valido',
                    'is_unique' => 'Este correo ya existe'
                ],
            ]);
            
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        if($input['numeroTelefono'] != $usuario[0]->numeroTelefono){
            $validar->setRules([
                'numeroTelefono'=>'required|numeric|is_unique[tbl_usuarios.numeroTelefono]',
            ],
            [
                'numeroTelefono' => [
                    'required' => 'Digite un número de telefono',
                    'numeric' => 'Solo digite numeros',
                    'is_unique' => 'Este número de telefono ya existe'
                ],
            ]);
            
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }

        if($input['password'] != null || $input['passwordAnterior'] != null){
            if(!password_verify($input['passwordAnterior'],$usuario[0]->password)){
                return redirect()->back()->withInput()->with('errors.passwordAnterior','Contraseña anterior no valida');
            }
            $validar->setRules([
                'password'=>'matches[c-password]|min_length[8]|max_length[32]'
            ],
            [
                'password' => [
                    'matches' => 'Las contraseñas no coinciden',
                    'min_length' => 'La contraseña es muy corta',
                    'max_length' => 'La contraseña es demasiado extensa'
                ],
            ]);
            
            if(!$validar->withRequest($this->request)->run()){
                return redirect()->back()->withInput()->with('errors',$validar->getErrors());
            }
        }
        
        if($input['password'] != null){
            $insertarPassword = password_hash($input['password'],PASSWORD_DEFAULT);
            
            $recuperarPostUsuario=[
                'idUsuario' => session('idUsuario'),
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'numeroTelefono' => $input['numeroTelefono'],
                'password' => $insertarPassword
            ];
        }else{
            $recuperarPostUsuario=[
                'idUsuario' => session('idUsuario'),
                'nombre' => $input['nombre'],
                'apellido' => $input['apellido'],
                'email' => $input['email'],
                'numeroTelefono' => $input['numeroTelefono'],
            ];
        }
        
        if(!$this->modelUsuario->save($recuperarPostUsuario)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al guardar datos!'
            ]);
        }

        if($input['idiomaSecundario'] != null && $input['idiomaSecundario'] != 'Elije un idioma' && $input['idiomaExtra'] == 'Elije un idioma'){
            $recuperarPostAnfitrion=[
                'idAnfitrion' => session('idAnfitrion'),
                'descripcion' => $input['descripcion'],
                'cuentaBanco' => $input['cuentaBanco'],
                'banco' => $input['banco'],
                'idiomaPrimario' => $input['idiomaPrimario'],
                'idiomasecundario' => $input['idiomaSecundario']
            ];
        }elseif($input['idiomaExtra'] != null && $input['idiomaExtra'] != 'Elije un idioma' && $input['idiomaSecundario'] == 'Elije un idioma'){
            $recuperarPostAnfitrion=[
                'idAnfitrion' => session('idAnfitrion'),
                'descripcion' => $input['descripcion'],
                'cuentaBanco' => $input['cuentaBanco'],
                'banco' => $input['banco'],
                'idiomaPrimario' => $input['idiomaPrimario'],
                'idiomaExtra' => $input['idiomaExtra']
            ];
        }elseif($input['idiomaSecundario'] != null && $input['idiomaSecundario'] != 'Elije un idioma' && $input['idiomaExtra'] != null && $input['idiomaExtra'] != 'Elije un idioma'){
            $recuperarPostAnfitrion=[
                'idAnfitrion' => session('idAnfitrion'),
                'descripcion' => $input['descripcion'],
                'cuentaBanco' => $input['cuentaBanco'],
                'banco' => $input['banco'],
                'idiomaPrimario' => $input['idiomaPrimario'],
                'idiomasecundario' => $input['idiomaSecundario'],
                'idiomaExtra' => $input['idiomaExtra']
            ];
        }else{
            $recuperarPostAnfitrion=[
                'idAnfitrion' => session('idAnfitrion'),
                'descripcion' => $input['descripcion'],
                'cuentaBanco' => $input['cuentaBanco'],
                'banco' => $input['banco'],
                'idiomaPrimario' => $input['idiomaPrimario'],
            ];
        }

        if(!$this->modelAnfitrion->save($recuperarPostAnfitrion)){
            return redirect()->back()->withInput()->with('msg',[
                'type'=>'danger',
                'body'=>'Error al guardar datos!'
            ]);
        }

        return redirect()->route('perfil')->with('msg',[
            'type'=>'success',
            'body'=>'Datos actualizado con exito!'
        ]);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
}