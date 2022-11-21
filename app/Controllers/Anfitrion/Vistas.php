<?php

namespace App\Controllers\Anfitrion;

use App\Entities\Usuario;

use App\Controllers\BaseController;
use CodeIgniter\Database\Query;
use CodeIgniter\HTTP\ResponseInterface;

class Vistas extends BaseController
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
    protected $modelPagos;


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
        $this->modelPagos = model('PagosModel');
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function index(){
        $arrayServicios = $this->modelServicio->where('idAnfitrion', session('idAnfitrion'))->findColumn('idServicio');
        if($arrayServicios != null){
            $imagenes = $this->modelImagenes->whereIn('idServicio',$arrayServicios)->findAll();
        }else{
            $imagenes[] = 0;
        }
        /*Muestra la vista de inicio del anfitrion*/
        //dd($this->modelImagenes->whereIn('idServicio',$arrayServicios)->findAll());
        return view('anfitrion/inicio', [
        'servicios' => $this->modelServicio->where('idAnfitrion', session('idAnfitrion'))->findAll(),
        'municipios' => $this->modelMunicipio->findAll(),
        'tarifas' => $this->modelTarifas->findAll(),
        'tipoHospedajes' => $this->modelTipoHospedaje->findAll(),
        'imagenes' => $imagenes
        ]);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function verServicio(){
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
        $buscarAnfitrion = $this->modelServicio->where('idServicio',$idServicio)->findColumn('idAnfitrion');
        $buscarTarifa = $this->modelServicio->where('idServicio',$idServicio)->findColumn('idTarifa');
        $buscarUsuario = $this->modelAnfitrion->where('idAnfitrion',$buscarAnfitrion)->findColumn('idUsuario');
        $buscarTipoHospedaje = $this->modelServicio->where('idServicio',$idServicio)->findColumn('idTipoHospedaje');
        $buscarIdiomaPrimario = $this->modelAnfitrion->where('idAnfitrion',$buscarAnfitrion)->findColumn('idiomaPrimario');
        $buscarIdiomaSecundario = $this->modelAnfitrion->where('idAnfitrion',$buscarAnfitrion)->findColumn('idiomaSecundario');
        $buscarIdiomaExtra = $this->modelAnfitrion->where('idAnfitrion',$buscarAnfitrion)->findColumn('idiomaExtra');
        $arraySubServicios = $this->modelGuardarSubServicios->where('idServicio',$idServicio)->findColumn('idSubServicio');
        $arrayPoliticaCancelacion = $this->modelGuardarPoliticaCancelacion->where('idServicio',$idServicio)->findColumn('idPoliticaCancelacion');
        $arrayReglaServicio = $this->modelGuardarReglaServicios->where('idServicio',$idServicio)->findColumn('idReglaServicio');
        $arraySaludSeguridad = $this->modelGuardarSaludSeguridad->where('idServicio',$idServicio)->findColumn('idSaludSeguridad');
        $buscarMunicipio = $this->modelServicio->where('idServicio',$idServicio)->findColumn('idMunicipio');
        $buscarDepartamento = $this->modelMunicipio->where('idMunicipio',$buscarMunicipio)->findColumn('idDepartamento');
        $buscarPais = $this->modelDepartamento->where('idDepartamento',$buscarDepartamento)->findColumn('idPais');
        if($arraySubServicios == null){
            $arraySubServicios[] = '';
        }
        if($arrayPoliticaCancelacion == null){
            $arrayPoliticaCancelacion[] = '';
        }
        if($arrayReglaServicio == null){
            $arrayReglaServicio[] = '';
        }
        if($arraySaludSeguridad == null){
            $arraySaludSeguridad[] = '';
        }
        
        return view('anfitrion/servicio', [
            'servicio' => $this->modelServicio->where('idServicio',$idServicio)->findAll(),
            'usuario' => $this->modelUsuario->where('idUsuario',$buscarUsuario)->findAll(),
            'politicaCancelacion' => $this->modelPoliticaCancelacion->whereIn('idPoliticaCancelacion',$arrayPoliticaCancelacion)->findAll(),
            'reglaServicio' => $this->modelReglaServicios->whereIn('idReglaServicio',$arrayReglaServicio)->findAll(),
            'saludSeguridad' => $this->modelSaludSeguridad->whereIn('idSaludSeguridad',$arraySaludSeguridad)->findAll(),
            'subServicio' => $this->modelSubServicios->whereIn('idSubServicio',$arraySubServicios)->findAll(),
            'huespedes'=> $this->modelHuespedes->where('idServicio',$idServicio)->findAll(),
            'imagenes' => $this->modelImagenes->where('idServicio',$idServicio)->findAll(),
            'tarifa' => $this->modelTarifas->where('idTarifa',$buscarTarifa)->findAll(),
            'anfitrion' => $this->modelAnfitrion->where('idAnfitrion',$buscarAnfitrion)->findAll(),
            'idiomaPrimario' => $this->modelIdiomas->where('idIdioma',$buscarIdiomaPrimario)->findAll(),
            'idiomaSecundario' => $this->modelIdiomas->where('idIdioma',$buscarIdiomaSecundario)->findAll(),
            'idiomaExtra' => $this->modelIdiomas->where('idIdioma',$buscarIdiomaExtra)->findAll(),
            'tipoHospedaje' => $this->modelTipoHospedaje->where('idTipoHospedaje',$buscarTipoHospedaje)->findAll(),
            'pais' => $this->modelPais->where('idPais',$buscarPais)->findAll(),
            'departamento' => $this->modelDepartamento->where('idDepartamento',$buscarDepartamento)->findAll(),
            'municipio' => $this->modelMunicipio->where('idMunicipio', $buscarMunicipio)->findAll(),
        ]);
    }

/*---------------------------------------------------------------------------------------------------------------------*/
    public function perfil(){
        return view('anfitrion/perfil', [
            'usuario' => $this->modelUsuario->find(session('idUsuario')),
            'anfitrion' => $this->modelAnfitrion->find(session('idAnfitrion')),
        ]);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
public function publicar(){
    return view ('anfitrion/publicar',[
        'tipoHospedajes' => $this->modelTipoHospedaje->findAll(),
        'paises' => $this->modelPais->findAll(),
        'departamentos' => $this->modelDepartamento->findAll(),
        'municipios' => $this->modelMunicipio->findAll(),
        'subServicios' => $this->modelSubServicios->findAll(),
        'saludSeguridad' => $this->modelSaludSeguridad->findAll(),
        'reglaServicios' => $this->modelReglaServicios->findAll(),
        'politicaCancelacion' => $this->modelPoliticaCancelacion->findAll()

    ]);
}
/*---------------------------------------------------------------------------------------------------------------------*/
    public function actualizarServicio(){
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
        $buscarTarifa = $this->modelServicio->where('idServicio',$idServicio)->findColumn('idTarifa');

        if($buscarTarifa == null){
            $buscarTarifa = '';
        }

        $arrayGuardadoSubServicios = $this->modelGuardarSubServicios->where('idServicio',$idServicio)->findColumn('idSubServicio');
        $arrayGuardadoPoliticaCancelacion = $this->modelGuardarPoliticaCancelacion->where('idServicio',$idServicio)->findColumn('idPoliticaCancelacion');
        $arrayGuardadoReglaServicio = $this->modelGuardarReglaServicios->where('idServicio',$idServicio)->findColumn('idReglaServicio');
        $arrayGuardadoSaludSeguridad = $this->modelGuardarSaludSeguridad->where('idServicio',$idServicio)->findColumn('idSaludSeguridad');
        if($arrayGuardadoSubServicios == null){
            $arrayGuardadoSubServicios[] = '';
        }
        if($arrayGuardadoPoliticaCancelacion == null){
            $arrayGuardadoPoliticaCancelacion[] = '';
        }
        if($arrayGuardadoReglaServicio == null){
            $arrayGuardadoReglaServicio[] = '';
        }
        if($arrayGuardadoSaludSeguridad == null){
            $arrayGuardadoSaludSeguridad[] = '';
        }

        return view ('anfitrion/actualizarServicio',[
            'servicio' => $this->modelServicio->where('idServicio',$idServicio)->findAll(),
            'tipoHospedajes' => $this->modelTipoHospedaje->findAll(),
            'subServicios' => $this->modelSubServicios->findAll(),
            'saludSeguridad' => $this->modelSaludSeguridad->findAll(),
            'reglaServicios' => $this->modelReglaServicios->findAll(),
            'politicaCancelacion' => $this->modelPoliticaCancelacion->findAll(),
            'guardadoSubServicios' => $arrayGuardadoSubServicios,
            'guardadoPoliticaCancelacion' => $arrayGuardadoPoliticaCancelacion,
            'guardadoReglaServicio' => $arrayGuardadoReglaServicio,
            'guardadoSaludSeguridad' => $arrayGuardadoSaludSeguridad,
            'tarifa' => $this->modelTarifas->where('idTarifa',$buscarTarifa)->findAll(),
            'huespedes' => $this->modelHuespedes->where('idServicio',$idServicio)->findAll()
        ]);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function buscar(){
        $data = [
            'idUsuario' => session('idUsuario'),
            'idRol' => $this->modelUsuario->asignarCambiarRol
        ];
        return view('anfitrion/buscar',$data);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function regresarUsuario(){
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
/*---------------------------------------------------------------------------------------------------------------------*/
    public function actualizarPerfil(){
        $anfitrion = $this->modelAnfitrion->where('idAnfitrion',session('idAnfitrion'))->findAll();
        $idiomaPrimario = $anfitrion[0]->idiomaPrimario;
        $idiomaSecundario = $anfitrion[0]->idiomaSecundario;
        $idiomaExtra = $anfitrion[0]->idiomaExtra;
        if($anfitrion[0]->idiomaPrimario == null){
            $idiomaPrimario = 0;
        }
        if($anfitrion[0]->idiomaSecundario == null){
            $idiomaSecundario = 0;
        }
        if($anfitrion[0]->idiomaExtra == null){
            $idiomaExtra = 0;
        }
        return view('anfitrion/actualizarPerfil',[
            'usuario' => $this->modelUsuario->where('idUsuario',session('idUsuario'))->findAll(),
            'anfitrion' => $this->modelAnfitrion->where('idAnfitrion',session('idAnfitrion'))->findAll(),
            'idiomas' => $this->modelIdiomas->findAll(),
            'idiomaPrimario' => $idiomaPrimario,
            'idiomaSecundario' => $idiomaSecundario,
            'idiomaExtra' => $idiomaExtra,
        ]);
    }
/*---------------------------------------------------------------------------------------------------------------------*/
    public function misReservas(){
        $arrayServicioAnfitrion = $this->modelServicio->where('idAnfitrion',session('idAnfitrion'))->findColumn('idServicio');
        if($arrayServicioAnfitrion == null){
            $arrayServicioAnfitrion[] = '';
        }
        $arrayServicio = $this->modelPagos->whereIn('idServicio',$arrayServicioAnfitrion)->findColumn('idServicio');
        if($arrayServicio == null){
            $arrayServicio[] = '';
        }
        $arrayUsuarios = $this->modelPagos->whereIn('idServicio',$arrayServicioAnfitrion)->findColumn('idUsuario');
        if($arrayUsuarios == null){
            $arrayUsuarios[] = '';
        }
        $usuarios = $this->modelUsuario->whereIn('idUsuario',$arrayUsuarios)->findAll();
        $servicios = $this->modelServicio->whereIn('idServicio',$arrayServicio)->findAll();
        $date = date('Y-m-d');
        $reservas = $this->modelPagos->where('fechaSalida >=',$date)->whereIn('idServicio',$arrayServicioAnfitrion)->orderBy('fechaSalida','asc')->findAll();
        $historial = $this->modelPagos->where('fechaSalida <',$date)->whereIn('idServicio',$arrayServicioAnfitrion)->orderBy('fechaSalida','asc')->findAll();
        return view('anfitrion/reservas',[
            'reservas' => $reservas,
            'historial' => $historial,
            'servicios' => $servicios,
            'usuarios' => $usuarios
        ]);
    }
}