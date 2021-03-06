<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/index', 'HomeController@index');
Route::get('/fixture', 'HomeController@fixture');
Route::get('/fixturetorneo/{id}', 'HomeController@fixturetorneo');
Route::get('/inscripcion', 'HomeController@inscripcion');
Route::post('/inscribirequipo', 'HomeController@inscribirequipo');
Route::get('/noticias', 'HomeController@noticias');
Route::post('/mailcontacto', 'HomeController@mailcontacto');
Route::get('/laribera', 'HomeController@laribera');
Route::get('/equipo', 'HomeController@equipo');
Route::post('/loginequipo', 'HomeController@loginequipo');
Route::get('/estadisticas', 'HomeController@estadisticas');
Route::get('/estadisticastorneo/{id}', 'HomeController@estadisticastorneo');
Route::get('/torneoportipotorneo/{id}', 'HomeController@torneoportipotorneo');
Route::get('/torneoportipotorneofixture/{id}', 'HomeController@torneoportipotorneofixture');
Route::get('/noticia/{id}', 'HomeController@noticia');
Route::get('/equipotorneo/{idtorneo}', 'HomeController@equipotorneo');
Route::get('/buscarzonas/{idtorneo}/{idequipo}', 'HomeController@buscarzonas');
Route::get('/buscartablaposiciones/{idzona}/{idtorneo}', 'HomeController@buscartablaposiciones');
Route::get('/buscarequipoestadisticas/{idequipo}/{idzona}/{idtorneo}', 'HomeController@buscarequipoestadisticas');
Route::get('/completarestadisticas/{idequipo}/{idzona}/{idtorneo}', 'HomeController@completarestadisticas');
Route::post('/modificarclave', 'HomeController@modificarclave');
Route::post('/equipoescudoguardar', 'HomeController@equipoescudoguardar');
Route::post('/equipofotoguardar', 'HomeController@equipofotoguardar');
Route::post('/agregarjugador', 'HomeController@agregarjugador');
Route::get('/detallepartido/{id}', 'HomeController@detallePartido');


Route::get('/jugadores-de-la-fecha', 'WelcomeController@jugadoresfecha');
Route::get('/equipo-ideal', 'WelcomeController@equipoideal');

Route::get('/sucursales', 'WelcomeController@instalaciones');

Route::post('/mailinscripcion', 'WelcomeController@mailinscripcion');

Route::get('/equiposalir', 'WelcomeController@equiposalir');


Route::get('admin/home', 'Admin\HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix'=>'admin','namespace'=>'Admin'],
    function(){
        Route::get('/','HomeController@index');
        Route::get('home','HomeController@index');
        Route::post('modificarclave','HomeController@modificarclave');

        Route::resource('arbitros','ArbitrosController');
        Route::post('arbitros/buscar','ArbitrosController@buscar');
        Route::post('arbitros/mail','ArbitrosController@mail');

        Route::resource('torneos','TorneosController');
        Route::post('torneos/buscar','TorneosController@buscar');
        Route::post('torneos/storeequipo','TorneosController@storeequipo');
        Route::post('torneos/destroyequipo','TorneosController@destroyequipo');
        Route::post('torneos/baja','TorneosController@baja');
        Route::post('torneos/alta','TorneosController@alta');
        Route::post('torneos/torneoimagenguardar','TorneosController@torneoimagenguardar');
        Route::post('torneos/torneoimagenborrar','TorneosController@torneoimagenborrar');

        Route::resource('equipos','EquiposController');
        Route::get('equiposxtorneos','EquiposController@equiposxtorneos');
        Route::post('equipos/buscar','EquiposController@buscar');
        Route::post('equipos/resetearclave','EquiposController@resetearclave');

        Route::resource('inscripcion','InscripcionController');
        Route::get('aceptarinscripcion/{id}','InscripcionController@aceptarinscripcion');


        Route::get('equipoimagen/{id}','EquiposController@equipoimagen');
        Route::post('equipoimagen/equipofotoborrar','EquiposController@equipofotoborrar');
        Route::post('equipoimagen/equipofotoguardar','EquiposController@equipofotoguardar');
        Route::post('equipoimagen/equipoescudoborrar','EquiposController@equipoescudoborrar');
        Route::post('equipoimagen/equipoescudoguardar','EquiposController@equipoescudoguardar');

        Route::resource('jugadores','JugadoresController');
        Route::post('jugadores/buscar','JugadoresController@buscar');
        Route::post('jugadores/baja','JugadoresController@baja');
        Route::post('jugadores/alta','JugadoresController@alta');
        Route::get('listanegra','JugadoresController@listanegra');
        Route::post('listanegra/imagenjugadorguardar','JugadoresController@imagenjugadorguardar');
        Route::post('listanegra/imagenjugadorborrar','JugadoresController@imagenjugadorborrar');

        Route::resource('fechas','FechasController');
        Route::post('fechas/buscar','FechasController@buscar');
        Route::get('fecha/{id}','FechasController@imagen');
        Route::post('fecha/imagenguardar','FechasController@imagenguardar');
        Route::post('fecha/imagenborrar','FechasController@imagenborrar');
        Route::post('fecha/imagenequipoguardar','FechasController@imagenequipoguardar');
        Route::post('fecha/imagenequipoborrar','FechasController@imagenequipoborrar');
        Route::post('fecha/imagenfiguraguardar','FechasController@imagenfiguraguardar');
        Route::post('fecha/imagenfiguraborrar','FechasController@imagenfiguraborrar');
        Route::get('fechas/planilla/{id}','FechasController@planilla');

        Route::resource('partidos','PartidosController');
        Route::post('partidos/buscar','PartidosController@buscar');
        Route::post('partidos/resultado','PartidosController@resultado');
        Route::post('partidos/goles','PartidosController@goles');
        Route::get('partidos/{idpartido}/{idjugador}','PartidosController@goleseliminar');

        Route::resource('noticias','NoticiasController');
        Route::post('noticias/buscar','NoticiasController@buscar');
        Route::post('noticias/ordenar','NoticiasController@ordenar');

        Route::resource('imagenes','ImagenesController');
        Route::post('imagenes/buscar','ImagenesController@buscar');

        //Route::get('imagenes/{id}','ImagenesController@imagenshow');
        Route::post('imagenes/imagenborrar','ImagenesController@imagenborrar');
        Route::post('imagenes/imagenguardar','ImagenesController@imagenguardar');

         Route::get('noticiaimagen/{id}','NoticiasController@noticiaimagen');
        Route::post('noticiaimagen/noticiaimagenborrar','NoticiasController@noticiaimagenborrar');
        Route::post('noticiaimagen/noticiaimagenguardar','NoticiasController@noticiaimagenguardar');

        Route::resource('zonas','ZonasController');
        Route::post('zonas/buscar','ZonasController@buscar');

        Route::get('reportes/listadojugadores','ReportesController@listadojugadores');
        Route::get('reportes/index','ReportesController@index');
        Route::get('reportes','ReportesController@index');

        Route::resource('DescuentosPuntos','DescuentosPuntosController');

});




