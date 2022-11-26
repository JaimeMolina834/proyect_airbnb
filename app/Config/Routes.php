<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('/',['namespace'=>'App\Controllers\Home', 'filter' => 'auth'],function($routes){
    $routes->get('', 'Home::index', ['as'=>'home']);
});

$routes->group('auth',['namespace'=>'App\Controllers\Auth', 'filter' => 'auth'],function($routes){
    $routes->get('registro', 'Vistas::index', ['as'=>'register']);
    $routes->post('registrar', 'Registro::registrar');
    $routes->get('registro-anfitrion', 'Vistas::registrarAnfitrion', ['as'=>'registerAnfittrion']);
    $routes->post('registrar-anfitrion', 'Registro::registrarAnfitrion');
    $routes->get('login', 'Vistas::login', ['as'=>'login']);
    $routes->post('checklogin', 'Login::signin', ['as'=>'signin']);
});


$routes->group('usuario',['namespace'=>'App\Controllers\Usuario', 'filter' => 'roles:Usuario'],function($routes){
    $routes->get('registrar', 'Vistas::hazteAnfitrion', ['as'=>'hazteAnfitrion']);
    $routes->get('perfil', 'Vistas::perfil', ['as'=>'perfilUser']);
    //$routes->get('inicio', 'Vistas::index', ['as'=>'usuarioInicio']);
    //$routes->get('alojamiento', 'Vistas::alojamiento', ['as'=>'alojamiento']);
    $routes->post('registrarAnfitrion', 'Registro::registrarAnfitrion');
    $routes->get('cerrar', 'Registro::cerrar', ['as'=>'usuarioSignout']);
});

$routes->group('anfitrion',['namespace'=>'App\Controllers\Anfitrion', 'filter' => 'roles:Anfitrion'],function($routes){
    $routes->get('inicio', 'Vistas::index', ['as'=>'anfitrionInicio']);
    $routes->get('perfil', 'Vistas::perfil', ['as'=>'perfil']);
    $routes->get('publicar','Vistas::publicar', ['as' => 'anfitrionPublicar']);
    $routes->post('RegistrarPublicacion', 'Registro::RegistrarPublicacion');
    $routes->get('buscar', 'Vistas::buscar', ['as'=>'anfitrionBusqueda']);
    $routes->get('cerrar', 'Registro::cerrar', ['as'=>'anfitrionSignout']);
    //$routes->get('regresar-usuario', 'Vistas::regresarUsuario', ['as'=>'regresarAUsuario']);
    $routes->get('servicio', 'Vistas::verServicio', ['as'=>'verServicio']);
    $routes->get('de-baja', 'UpdateDelete::darBajaServicio', ['as'=>'darBajaServicio']);
    $routes->get('de-alta', 'UpdateDelete::darAltaServicio', ['as'=>'darAltaServicio']);
    $routes->get('actualizar','Vistas::actualizarServicio', ['as' => 'actualizarServicio']);
    $routes->post('ActualizarServicio', 'UpdateDelete::ActualizarServicio');
    $routes->get('actualizar-perfil','Vistas::actualizarPerfil', ['as' => 'actualizarPerfil']);
    $routes->post('ActualizarPerfil', 'UpdateDelete::ActualizarPerfil');
    $routes->get('reservas','Vistas::misReservas', ['as' => 'misReservas']);

});

$routes->group('admin',['namespace'=>'App\Controllers\Admin', 'filter' => 'roles:Admin'],function($routes){
    $routes->get('inicio', 'Admin::index', ['as'=>'adminInicio']);
    $routes->get('buscar', 'Admin::buscar', ['as'=>'adminBusqueda']);
    $routes->get('cerrar', 'Admin::cerrar', ['as'=>'adminSignout']);
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}