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
                $delegado->nombre_jugador = Input::get('nombre');
               // $delegado->dni = Input::get('dni');
                $delegado->validaralta();

                //Crear un equipo en la BD
                $equipoNuevo = new Equipo();
                $equipoNuevo->nombre_equipo = Input::get('nombre_equipo');
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
                $cuerpo = $cuerpo . "Nombre Equipo: ".Input::get('nombre_equipo')."\n";
                $cuerpo = $cuerpo . "Nombre Delegado: ".Input::get('nombre')."\n";
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

    public function buscarzonas($idtorneo,$idequipo)
    {
        $equipo=  Equipo::findOrFail(Session::get('equipo'));
        $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();
        return view('include.equipotorneo',compact('equipo','torneo'));
    }
    


}
