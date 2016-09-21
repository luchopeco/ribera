<?php namespace torneo\Http\Controllers;

use Doctrine\Instantiator\Exception\UnexpectedValueException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use torneo\Equipo;
use torneo\Imagen;
use torneo\Jugador;
use torneo\Noticia;
use torneo\Torneo;
use torneo\Zona;
use torneo\Fecha;
use torneo\Partido;

use torneo\TipoTorneo;


class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $listDestacadosFecha=Imagen::where('idtipo_imagen',2)->get();
        $listNoticias = Noticia::where('mostrar_en_home',1)->orderBy('orden')->get();
		return view('home',compact('listNoticias','listDestacadosFecha'));
	}

    public function fixture()
    {
        $listTorneosCombo = Torneo::all()->lists('nombre_torneo', 'idtorneo');
        return view('fixture',compact('listTorneosCombo'));
    }

    public function fixturetorneo($id)
    {
        $torneo = Torneo::findOrFail($id);
        return view('include.fixture',compact('torneo'));
    }

    public function inscripcion()
    {
        return view('inscripcion');
    }

    public function  inscribirequipo()
    {
        try{
            if(Input::get('validador')=='')
            {
                //BUSCAR SI EXISTE EQUIPO CON ESE NOMBRE

                //$equipo=Equipo::where('nombre_equipo' , '=', Input::get('nombre_equipo'))->first();

                //if (empty($equipo)) {

                //primero verifico que el jugador no este en lista negra
                $delegado = new Jugador();
                $delegado->nombre_jugador =ucwords( Input::get('nombre'));
               // $delegado->dni = Input::get('dni');
                $delegado->validaralta();

                //Crear un equipo en la BD
                $equipoNuevo = new Equipo();
                $equipoNuevo->nombre_equipo = ucwords(Input::get('nombre_equipo'));
                $equipoNuevo->observaciones = Input::get('mensaje');
                $equipoNuevo->aprobado = 0;
                $equipoNuevo->save();

                // Agregar jugador delegado
                $delegado->idequipo = $equipoNuevo->idequipo;
                $delegado->observaciones = "delegado";
                $delegado->telefono = Input::get('celular')." - ".Input::get('telefono_alternativo');
                $delegado->delegado = 1 ;
                $delegado->mail = Input::get('mail') ;
                $delegado->direccion = Input::get('domicilio');

                $delegado->save();

                //armo el correo para enviar

                $cuerpo="Nueva Inscripcion \n";
               // $cuerpo = $cuerpo . "Torneo: ". Request::get('torneo')."\n";
                $cuerpo = $cuerpo . "Nombre Equipo: ".ucwords(Input::get('nombre_equipo'))."\n";
                $cuerpo = $cuerpo . "Nombre Delegado: ".ucwords(Input::get('nombre'))."\n";
               // $cuerpo = $cuerpo . "DNI Delegado: ".Input::get('dni')."\n";
                $cuerpo = $cuerpo . "Celular Delegado: ".Input::get('celular')."\n";
                $cuerpo = $cuerpo . "Mail Delegado: ".Input::get('mail')."\n";
                $cuerpo = $cuerpo . "Domicilio Delegado: ".Input::get('domicilio')."\n";
                $cuerpo = $cuerpo . "Telefono Alternativo: ".Input::get('telefono_alternativo')."\n";
                $cuerpo = $cuerpo . "Mensaje: ".Input::get('mensaje')."\n";

                Mail::raw($cuerpo, function($message)
                {
                    $subjet = 'Inscripcion - Torneo: '.Request::get('torneo').' - Equipo: '.Input::get('nombre_equipo');

                    $message->from(env('MAIL_INSCRIPCION_DE'), 'Inscripcion La Ribera');

                    $message->to(env('MAIL_INSCRIPCION_PARA'))->subject($subjet);

                });

                // }
                //else{
                //     Session::flash('mensajeErrorContacto', "Ya existe un equipo con ese nombre");
                //      return redirect()->action('WelcomeController@inscripcion');

                // }

            }

            Session::flash('mensajeOk', 'Inscripcion Enviada Con Exito. En Breve nos pondremos en contacto.');
            return back();
            //return redirect()->action('WelcomeController@inscripcion');
        }
        catch( \Exception $ex) {
            if ($ex->getMessage()==env('MSJ_ERRORJUGADOR')) {
                Session::flash('mensajeErrorContacto',$ex->getMessage());
                return back();
                //return redirect()->action('WelcomeController@inscripcion');
            } else {
                Session::flash('mensajeErrorContacto', "Discuple las molestias. El pedido de inscripcion no se pudo realizar. Intente en otro momento ". $ex->getMessage());
                return back();
                //return redirect()->action('WelcomeController@inscripcion');
            }
        }

    }

    public function noticias()
    {
        $listNoticias = Noticia::where('mostrar_en_seccion',1)->orderBy('orden')->get();

        $cantidadNoticias =$listNoticias->count();
        $mitad=$cantidadNoticias /4;
        $cantidadSecciones= ceil($mitad);

        return view('noticias',compact('listNoticias','cantidadSecciones','cantidadNoticias'));
    }

    public function  mailcontacto()
    {
        try{
            if(Input::get('validador_contacto')=='')
            {
                $cuerpo="Consuta desde el Formulario de Contacto de la Web \n";
                $cuerpo = $cuerpo . "Nombre: ". Request::get('nombre_contacto')."\n";
                $cuerpo = $cuerpo . "Celular: ".Input::get('celular_contacto')."\n";
                $cuerpo = $cuerpo . "Mail: ".Input::get('mail_contacto')."\n";
                $cuerpo = $cuerpo . "Mensaje: ".Input::get('mensaje_contacto')."\n";

                Mail::raw($cuerpo, function($message)
                {
                    $subjet = 'Consulta desde la Web - '.Request::get('nombre_contacto');

                    $message->from(env('MAIL_CONTACTO_DE'), 'Contacto Web La Ribera');

                    $message->to(env('MAIL_CONTACTO_PARA'))->subject($subjet);
                });
            }

            Session::flash('mensajeOkContacto', 'Consulta Enviada Con Exito. En Breve nos pondremos en contacto.');
            return back();
        }
        catch(\Exception $ex)
        {
            Session::flash('mensajeErrorContacto',"Discuple las molestias. El mensaje no se pudo enviar. Intente en otro momento ". $ex->getMessage());
            return back();
        }

    }

    public function laribera()
    {
        return view('laribera');
    }

    public function equipo()
    {
        try
        {
            if (Session::has('equipo'))
            {
                $equipo=  Equipo::findOrFail(Session::get('equipo'));
                $listTorneosCombo = $equipo->ListTorneosParaCombo();
                return view('equipo',compact('equipo','listTorneosCombo'));
            }
            else
            {
                // return view('equipo');
                return view('login');
            }
        }
        catch(\Exception $ex )
        {
            Session::flash('mensajeError', $ex->getMessage());
            return view('login');
        }

    }

    public function loginequipo()
    {
        try {

            //$user = Equipo::find(23);
            //$user->clave = Hash::make('admin');
            //$user->save();
            $eq = Equipo::where('nombre_usuario',  Request::input('nombre_usuario'))->firstOrFail();
            if (Hash::check(Request::input('clave'),$eq->clave))
            {
                Session::put('equipo', $eq->idequipo);
                return redirect()->action('HomeController@equipo');
            }
            else
            {
                Session::flash('mensajeError', 'Usuario y/o clave incorrecta');
                return redirect()->action('HomeController@equipo');
            }
        }
        catch(\Exception $e)
        {
            Session::flash('mensajeError', 'Usuario y/o clave incorrecta');
            return redirect()->action('HomeController@equipo');
        }

    }

    public function estadisticas()
    {

        //$listTiposTorneosCombo = TipoTorneo::all()->lists('nombre_tipo_torneo', 'idtipo_torneo');
        $listTorneos = Torneo::all()->lists('nombre_torneo','idtorneo');

        //var_dump($listTorneos);die();
        return view('estadisticas',compact('listTorneos'));
    }
    public function estadisticastorneo($id)
    {
        $torneo = Torneo::findOrFail($id);
        //var_dump($torneo->TablaPosiciones());die();
        return view('include.estadisticas',compact('torneo'));
    }
    public function torneoportipotorneo($id)
    {
        $listtorneos = Torneo::where('idtipo_torneo',$id)->lists('nombre_torneo', 'idtorneo');
        return view('include.combotorneoestadisticas',compact('listtorneos'));
    }


    public function noticia($id)
    {
        try {
            $n = Noticia::findOrFail($id);
            return view('noticia', compact('n'));
        }
        catch(\Exception $ex)
        {
            return redirect()->action('HomeController@index');
        }
    }


     public function equipotorneo($idtorneo)
    {
        $equipo=  Equipo::findOrFail(Session::get('equipo'));
        $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();
        return view('include.equipotorneo',compact('equipo','torneo'));
    }
    public function buscartablaposiciones_prueba($idzona,$idtorneo){
        $zona = Zona::findOrFail($idzona);
        $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();
        
        $respuesta = "";
        if($torneo->estadisticas_x_torneo==1){
            $respuesta = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                <div  class="fechas-wrapper col-fechas">
                  <div class="table-responsive">
                    <div class="border-titulo-medio" style="width: 100%;"></div>
                    <table class="table ">
                      <tr >
                        <th>EQUIPO</th>
                        <th>PTS</th>
                        <th>J</th>
                        <th>G</th>
                        <th>E</th>
                        <th>P</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>DIF</th>
                      </tr>';

                      foreach ($torneo->TablaPosiciones() as $tabla) {
                         $respuesta.= '<tr>';
                         $respuesta.= '<td>'.$tabla->nombre_equipo.'</td>
                                            <td>'.$tabla->pun.'</td>
                                            <td>'.$tabla->pj.'</td>
                                            <td>'.$tabla->gan.'</td>
                                            <td>'.$tabla->emp.'</td>
                                            <td>'.$tabla->per.'</td>
                                            <td>'.$tabla->gf.'</td>
                                            <td>'.$tabla->gc.'</td>
                                            <td>'.$tabla->df.'</td>';
                         $respuesta.= ' </tr>';
                         
                      }

                       $respuesta.= '  </table>   </div>      </div>       </div>';

                       echo $respuesta;
                       die();

                     
        }else{
            // es por zona elegida
              
                
                $respuesta= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                  <div  class="fechas-wrapper col-fechas">
                    <div class="table-responsive">
                      <div class="border-titulo-medio" style="width: 100%;"></div>
                      <table class=" table ">
                        <tr >
                          <th style="color:#FBC01C">'.$zona->nombre.'</th>
                          <th>PTS</th>
                          <th>J</th>
                          <th>G</th>
                          <th>E</th>
                          <th>P</th>
                          <th>GF</th>
                          <th>GC</th>
                          <th>DIF</th>
                        </tr>';

                        foreach ($zona->TablaPosiciones() as $tabla) {
                            $respuesta.='<tr >';
                            $respuesta.='<td>'.$tabla->nombre_equipo.'</td>';
                            $respuesta.='<td>'.$tabla->pun.'</td>';
                            $respuesta.='<td>'.$tabla->pj.'</td>';
                            $respuesta.='<td>'.$tabla->gan.'</td>';
                            $respuesta.='<td>'.$tabla->emp.'</td>';
                            $respuesta.='<td>'.$tabla->per.'</td>';
                            $respuesta.='<td>'.$tabla->gf.'</td>';
                            $respuesta.='<td>'.$tabla->gc.'</td>';
                            $respuesta.='<td>'.$tabla->df.'</td>';
                            $respuesta.=' </tr>';
                        }


                        $respuesta.=' </table>
                    </div>
                  </div>
                </div>';   

                echo $respuesta;
                       die();                    
              
        }
/*
        if($zona->torneo->idtorneo == $torneo->idtorneo){
               
                echo '<option value="'.$zona->idzona.'">'.$zona->nombre.' </option>';
        }
        var_dump($zona); 
        */

    }


    public function buscarequipoestadisticas($idequipo,$idzona,$idtorneo){
            $zona = Zona::findOrFail($idzona);
            $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();
            $equipo = Equipo::findOrFail($idequipo);
            //var_dump($equipo);die();

            $jugadores = $equipo->ListJugadores;



            $respuesta = "";
            if($torneo->estadisticas_x_torneo==1){
                $respuesta = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                    <div  class="fechas-wrapper col-fechas">
                      <div class="table-responsive">
                        <div class="border-titulo-medio" style="width: 100%;"></div>
                        <table class="table ">
                          <tr >
                            <th>Jugador</th>

                            <th>GOL</th>
                            <th>Amarilla</th>
                            <th>Rojas</th>
                            <th>Sanc.</th>
                          </tr>';

                          foreach ($jugadores as $jugador) {

                             $respuesta.= '<tr>';
                             $respuesta.= '<td>'.$jugador->NombreApellido().'</td>

                                                <td>'.$jugador->goles($idtorneo).'</td>
                                                <td>'.$jugador->tarjetasAmarillas($idtorneo).'</td>
                                                <td>'.$jugador->tarjetasRojas($idtorneo).'</td>
                                                <td>'.$jugador->fechasSancion($idtorneo).'</td>';

                             $respuesta.= ' </tr>';
                             //var_dump($jugador->nombre_jugador." - ".$jugador->golesxZona($idzona));
                          }


                           $respuesta.= '  </table>   </div>      </div>       </div>';

                           echo $respuesta;
                           die();


            }else{
                // es por zona elegida

                    $respuesta= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                      <div  class="fechas-wrapper col-fechas">
                        <div class="table-responsive">
                          <div class="border-titulo-medio" style="width: 100%;"></div>
                          <table class=" table ">
                            <tr >
                              <th style="color:#FBC01C">'.$zona->nombre.'</th>
                                <th>Jugador</th>

                                <th>GOL</th>
                                <th>Amarilla</th>
                                <th>Rojas</th>
                                <th>Sanc.</th>
                            </tr>';

                            foreach ($jugadores as $jugador) {

                             $respuesta.= '<tr><td></td>';
                             $respuesta.= '<td>'.$jugador->NombreApellido().'</td>

                                                <td>'.$jugador->golesxZona($idzona).'</td>
                                                <td>'.$jugador->tarjetasAmarillasxZona($idzona).'</td>
                                                <td>'.$jugador->tarjetasRojasxZonas($idzona).'</td>
                                                <td>'.$jugador->fechasSancionXzona($idzona).'</td>';

                             $respuesta.= ' </tr>';

                          }

                            $respuesta.=' </table>
                        </div>
                      </div>
                    </div>';

                    echo $respuesta;
                    die();

            }


        }

    public function completarestadisticas($idequipo,$idzona,$idtorneo){
        
        $zona = Zona::findOrFail($idzona);
        $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();
        $equipo = Equipo::findOrFail($idequipo);



        $respuesta = "";
        if($torneo->estadisticas_x_torneo==1){
            $respuesta = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                <div  class="fechas-wrapper col-fechas">
                  <div class="table-responsive">
                  <div style="height:25px;"> </div>
                    <!-- <div class="border-titulo-medio" style="width: 100%;"></div> -->
                    <table class="table limpia">';                       

                      //  var_dump($torneo->TablaPosiciones()[0]->pj);die(); 
                     $posicion=1;
                     $posicionReal=1;
                     $golesafavor=0;
                     $golesencontra=0;
                     $partidosJugados=0;
                     $ganados = 0;
                     $empatados=0;
                     $perdidos=0;
                     foreach ($torneo->TablaPosiciones() as $tabla) {

                        if($tabla->nombre_equipo==$equipo->nombre_equipo){
                            $posicionReal = $posicion;

                             $golesafavor=$tabla->gf;
                             $golesencontra=$tabla->gc;
                             $partidosJugados=$tabla->pj;
                             $ganados = $tabla->gan;
                             $empatados=$tabla->emp;
                             $perdidos=$tabla->per;

                        }else{
                            $posicion++;       
                        }
                         
                      }

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" > '.$posicionReal.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Posición </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$partidosJugados .'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Partidos Jugados </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$ganados.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Ganados</div> </td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$empatados.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Empatados</div> </td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$perdidos.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Perdidos </td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$golesafavor.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Goles a favor </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$golesencontra.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Goles en contra </div></td>';
                     $respuesta.= '</tr>';

                       $respuesta.= '  </table>   </div>   ';
              

                 $uf=null;
                 $pf=null;
                 $time = date("Y-m-d ", time());
                 
                 foreach ($zona->ListFechas as $fecha) {
                    if($fecha->fecha < $time){
                        $uf = $fecha;
                    }
                    if($fecha->fecha >  $time){

                        if($pf==null){
                            $pf = $fecha;
                        }
                    }   
                 }

                 
                 $respuesta .= '<div class="col-sm-12 col-xs-12" style="padding:0;">
                                  <div class="equipos-wrapper">
                                    <div class=""> <h3>ULT. FECHA</h3> </div><div class="border-titulo-medio"></div>
                                    <div class="resultado">';

                        if($uf!=null){
                            foreach ($uf->ListPartidos as $partido) { 
                                if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo){                               
                                    $respuesta .= $partido->EquipoLocal->nombre_equipo.'<span class="text-danger">'.$partido->goles_local.'</span> -vs- <span class="text-danger">'.$partido->goles_visitante.'</span> '.$partido->EquipoVisitante->nombre_equipo;
                                }
                            }
                        }
                 $respuesta .= ' </div>                    
                                      </div>
                                </div>';



                $respuesta .= '<div class="col-sm-12 col-xs-12" style="padding:0;">
                                  <div class="equipos-wrapper">
                                    <div class=""> <h3>PROX. FECHA</h3> </div><div class="border-titulo-medio"></div>
                                    <div class="resultado">';

                        if($pf!=null){
                            foreach ($pf->ListPartidos as $partido) { 
                                if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo){                               
                                    $respuesta .= $partido->EquipoLocal->nombre_equipo.'<span class="text-danger">'.$partido->goles_local.'</span> -vs- <span class="text-danger">'.$partido->goles_visitante.'</span> '.$partido->EquipoVisitante->nombre_equipo;
                                }
                            }
                        }
                 $respuesta .= ' </div>                    
                                      </div>
                                </div>';


            $respuesta.='  </div>       </div>';

           echo $respuesta;
           die();

                     
        }else{
            // es por zona elegida              
                
                $respuesta= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
                  <div  class="fechas-wrapper col-fechas">
                    <div class="table-responsive">
                       <div style="height:25px;"> </div><!-- <div class="border-titulo-medio" style="width: 100%;"></div>-->
                      <table class=" table limpia">';
                      


                          //  var_dump($torneo->TablaPosiciones()[0]->pj);die(); 
                     $posicion=1;
                     $posicionReal=1;
                     $golesafavor=0;
                     $golesencontra=0;
                     $partidosJugados=0;
                     $ganados = 0;
                     $empatados=0;
                     $perdidos=0;
                     foreach ($zona->TablaPosiciones() as $tabla) {

                        if($tabla->nombre_equipo==$equipo->nombre_equipo){
                            $posicionReal = $posicion;

                             $golesafavor=$tabla->gf;
                             $golesencontra=$tabla->gc;
                             $partidosJugados=$tabla->pj;
                             $ganados = $tabla->gan;
                             $empatados=$tabla->emp;
                             $perdidos=$tabla->per;

                        }else{
                            $posicion++;       
                        }
                         
                      }

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$posicionReal.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Posición </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$partidosJugados .'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Partidos Jugados </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$ganados.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Ganados </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$empatados.'</div></td>';
                       $respuesta.= '<td> <div class="tituloEstilo">Empatados </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$perdidos.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Perdidos </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$golesafavor.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Goles a favor </div></td>';
                     $respuesta.= '</tr>';

                     $respuesta.= '<tr>';
                       $respuesta.= '<td><div class="datoEstilo" >'.$golesencontra.'</div></td>';
                       $respuesta.= '<td><div class="tituloEstilo"> Goles en contra </div></td>';
                     $respuesta.= '</tr>';



                        $respuesta.=' </table>
                    </div>';


                 $uf=null;
                 $pf=null;
                 $time = date("Y-m-d ", time());
                 
                 foreach ($zona->ListFechas as $fecha) {
                    if($fecha->fecha < $time){
                        $uf = $fecha;
                    }
                    if($fecha->fecha >  $time){

                        if($pf==null){
                            $pf = $fecha;
                        }
                    }   
                 }

                 
                 $respuesta .= '<div class="col-sm-12 col-xs-12" style="padding:0;">
                                  <div class="equipos-wrapper">
                                    <div class=""> <h3>ULT. FECHA</h3> </div><div class="border-titulo-medio"></div>
                                    <div class="resultado">';

                        if($uf!=null){
                            foreach ($uf->ListPartidos as $partido) { 
                                if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo){                               
                                    $respuesta .= $partido->EquipoLocal->nombre_equipo.'<span class="text-danger">'.$partido->goles_local.'</span> -vs- <span class="text-danger">'.$partido->goles_visitante.'</span> '.$partido->EquipoVisitante->nombre_equipo;
                                }
                            }
                        }
                 $respuesta .= ' </div>                    
                                      </div>
                                </div>';



                $respuesta .= '<div class="col-sm-12 col-xs-12" style="padding:0;">
                                  <div class="equipos-wrapper">
                                    <div class=""> <h3>PROX. FECHA</h3> </div><div class="border-titulo-medio"></div>
                                    <div class="resultado">';

                        if($pf!=null){
                            foreach ($pf->ListPartidos as $partido) { 
                                if($partido->EquipoLocal->idequipo == $equipo->idequipo || $partido->EquipoVisitante->idequipo == $equipo->idequipo){                               
                                    $respuesta .= $partido->EquipoLocal->nombre_equipo.'<span class="text-danger">'.$partido->goles_local.'</span> -vs- <span class="text-danger">'.$partido->goles_visitante.'</span> '.$partido->EquipoVisitante->nombre_equipo;
                                }
                            }
                        }
                 $respuesta .= ' </div>                    
                                      </div>
                                </div>';


                    $respuesta .='
                  </div>
                </div>';   





                echo $respuesta;
                die();                    
              
        }

        echo "algo";
        die();
    }


    

    public function buscarzonas($idtorneo,$idequipo)
    {
    
        $equipo=  Equipo::findOrFail(Session::get('equipo'));
        $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();

         /*
          $tabla = DB::select(DB::raw("SELECT t.idtorneo, t.nombre_torneo FROM torneos t INNER JOIN zonas z on z.idtorneo = t.idtorneo
                                        INNER JOIN torneo_equipo te ON te.zona_idzona= z.idzona
                                        WHERE te.equipo_idequipo = :p1
                                        ORDER BY t.deleted_at ASC , t.created_at DESC"), array('p1' => $this->idequipo));

        */

        foreach ($equipo->ListZonas as $zona)
        {
            // var_dump("esta es una zona: ".$zona->torneo->nombre_torneo);
            //var_dump($torneo->idtorneo);die();
            //var_dump($zona->idzona);
            if($zona->torneo->idtorneo == $torneo->idtorneo){
               
                echo '<option value="'.$zona->idzona.'">'.$zona->nombre.' </option>';
            }
            /*
            //var_dump($zona->nombre);
            foreach($zona->ListEquipos as $eq)
            {
                // var_dump($eq);
            }
            */

        }
        die();



        //return view('include.equipotorneo',compact('equipo','torneo'));
    }

    public function modificarclave(){
        try
        {
            if(Input::get('clave-nueva')==''||Input::get('clave-nueva-2')=='')
            {
                Session::flash('mensajeError', 'Ingrese una clave nueva');
                return redirect()->action('HomeController@equipo');
            }
            else if(Input::get('clave-nueva')!=Input::get('clave-nueva-2'))
            {
                Session::flash('mensajeError', 'Las claves nuevas no coinciden');
                return redirect()->action('HomeController@equipo');
            }
            else{
                $eq = Equipo::findOrFail(Request::input('idequipoC'));
                if (Hash::check(Request::input('clave-actual'),$eq->clave))
                {
                    $eq->clave=Hash::make(Input::get('clave-nueva'));
                    $eq->save();
                    Session::flash('mensajeOk', 'Clave modificada Correctamente');
                    return redirect()->action('HomeController@equipo');
                }
                else
                {
                    Session::flash('mensajeError', 'La clave actual es incorrecta');
                    return redirect()->action('HomeController@equipo');
                }

            }
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return back();
        }
    }

    public function equipoescudoguardar(Request $request)
    {
        try
        {

            $equipo=Equipo::findOrFail(Input::get('idequipo'));

            if ( Input::hasFile('file')) {
                $file = Input::file('file');
                $equipo->escudo = 'escudo-equipo'.$equipo->idequipo.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'escudo-equipo'.$equipo->idequipo.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $equipo->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {

        }
    }

    public function equipofotoguardar(Request $request)
    {
        try
        {
            $equipo=Equipo::findOrFail(Input::get('idequipof'));

            if ( Input::hasFile('file')) {
                $file = Input::file('file');
                $equipo->foto = 'foto-equipo'.$equipo->idequipo.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'foto-equipo'.$equipo->idequipo.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $equipo->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {

        }
    }

    public function agregarjugador(Request $request)
    {
        try{
            $e = Equipo::findOrFail(Session::get('equipo'));
            $cant = $e->ListJugadores->count();
            if($cant >= 17)
            {
                Session::flash('mensajeError', 'No se ha podido inscribir el Jugador. Supera la cantidad máxima de inscriptos (17 Jugadores)');
                return back();
            }
            else{
                $jugador = new Jugador();
                $jugador->apellido_jugador= ucwords(Input::get('apellido_jugador'));
                $jugador->nombre_jugador=ucwords(Input::get('nombre_jugador'));
                $jugador->fecha_nacimiento=implode('-',array_reverse(explode('/',Input::get('fecha_nacimiento'))));

                $jugador->dni=Input::get('dni');
                $jugador->telefono=Input::get('telefono');
                $jugador->grupo_sanguineo=Input::get('grupo_sanguineo');
                $jugador->mail=Input::get('mail');
                $jugador->direccion=Input::get('direccion');
                $jugador->obra_social=Input::get('obra_social');
                $jugador->idequipo=Session::get('equipo');
                $jugador->validaralta();
                $jugador->save();

                Session::flash('mensajeOk', 'Jugador Agregado Correctamente');
                return back();
            }

        }
        catch(\Exception  $ex)
        {
            if ($ex->getMessage()==env('MSJ_ERRORJUGADOR'))
            {
                Session::flash('mensajeError', $ex->getMessage());
                return back();
            }
            else
            {
                Session::flash('mensajeError', 'El jugador No se pudo Agregar');
                return back();
            }

        }
    }

}
