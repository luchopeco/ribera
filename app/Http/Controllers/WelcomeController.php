<?php namespace torneo\Http\Controllers;

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
use torneo\TipoTorneo;
use torneo\Torneo;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

    public function fixture()
    {
        $listTiposTorneosCombo = TipoTorneo::all()->lists('nombre_tipo_torneo', 'idtipo_torneo');
        return view('fixture',compact('listTiposTorneosCombo'));
    }
    public function fixturetorneo($id)
    {
        $torneo = Torneo::findOrFail($id);
        return view('include.fixture',compact('torneo'));
    }



    public function instalaciones()
    {
        return view('sucursales');
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
    public function equiposalir()
    {
        Session::forget('equipo');
        return view('login');
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
                return redirect()->action('WelcomeController@equipo');
            }
            else
            {
                Session::flash('mensajeError', 'Usuario y/o clave incorrecta');
                return redirect()->action('WelcomeController@equipo');
            }
        }
        catch(\Exception $e)
        {
            Session::flash('mensajeError', 'Usuario y/o clave incorrecta');
            return redirect()->action('WelcomeController@equipo');
        }

    }


     public function inscripcion()
    {
        return view('inscripcion-beta');
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

    public function modificarclave(){
    try
    {
        if(Input::get('clave-nueva')==''||Input::get('clave-nueva-2')=='')
        {
            Session::flash('mensajeError', 'Ingrese una clave nueva');
            return redirect()->action('WelcomeController@equipo');
        }
        else if(Input::get('clave-nueva')!=Input::get('clave-nueva-2'))
        {
            Session::flash('mensajeError', 'Las claves nuevas no coinciden');
            return redirect()->action('WelcomeController@equipo');
        }
        else{
            $eq = Equipo::findOrFail(Request::input('idequipoC'));
            if (Hash::check(Request::input('clave-actual'),$eq->clave))
            {
                $eq->clave=Hash::make(Input::get('clave-nueva'));
                $eq->save();
                Session::flash('mensajeOk', 'Clave modificada Correctamente');
                return redirect()->action('WelcomeController@equipo');
            }
            else
            {
                Session::flash('mensajeError', 'La clave actual es incorrecta');
                return redirect()->action('WelcomeController@equipo');
            }

        }
    }
    catch(QueryException  $ex)
    {
        Session::flash('mensajeError', $ex->getMessage());
        return redirect()->route('admin.equipos.index');
    }
}

    public function torneoportipotorneofixture($id)
    {
        $listtorneos = Torneo::where('idtipo_torneo',$id)->lists('nombre_torneo', 'idtorneo');
        return view('include.combotorneosfixture',compact('listtorneos'));
    }

    public function equipotorneo($idtorneo)
    {
        $equipo=  Equipo::findOrFail(Session::get('equipo'));
        $torneo= Torneo::withTrashed()->where('idtorneo',$idtorneo)->first();
        return view('include.equipotorneo',compact('equipo','torneo'));
    }
    public function agregarjugador(Request $request)
    {
        try{
            $jugador = new Jugador();
            $jugador->nombre_jugador=Input::get('nombre_jugador');
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
            return redirect()->action('WelcomeController@equipo');
        }
        catch(\Exception  $ex)
        {
            if ($ex->getMessage()==env('MSJ_ERRORJUGADOR'))
            {
                Session::flash('mensajeError', $ex->getMessage());
                return redirect()->action('WelcomeController@equipo');
            }
            else
            {
                Session::flash('mensajeError', 'El jugador No se pudo Agregar');
                return redirect()->action('WelcomeController@equipo');
            }

        }
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
                    $delegado = new Jugador;
                    $delegado->nombre_jugador = Input::get('nombre');
                    $delegado->dni = Input::get('dni');
                    $delegado->validaralta();

                    //Crear un equipo en la BD
                    $equipoNuevo = new Equipo;
                    $equipoNuevo->nombre_equipo = Input::get('nombre_equipo');
                    $equipoNuevo->observaciones = "Desea anotarse en el torneo: ". Request::get('torneo');
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
                    $cuerpo = $cuerpo . "Torneo: ". Request::get('torneo')."\n";
                    $cuerpo = $cuerpo . "Nombre Equipo: ".Input::get('nombre_equipo')."\n";
                    $cuerpo = $cuerpo . "Nombre Delegado: ".Input::get('nombre')."\n";
                    $cuerpo = $cuerpo . "DNI Delegado: ".Input::get('dni')."\n";
                    $cuerpo = $cuerpo . "Celular Delegado: ".Input::get('celular')."\n";
                    $cuerpo = $cuerpo . "Mail Delegado: ".Input::get('mail')."\n";
                    $cuerpo = $cuerpo . "Domicilio Delegado: ".Input::get('domicilio')."\n";
                    $cuerpo = $cuerpo . "Telefono Alternativo: ".Input::get('telefono_alternativo')."\n";
                    $cuerpo = $cuerpo . "Mensaje: ".Input::get('mensaje')."\n";

                    Mail::raw($cuerpo, function($message)
                    {
                        $subjet = 'Inscripcion - Torneo: '.Request::get('torneo').' - Equipo: '.Input::get('nombre_equipo');

                        $message->from('web@ligatifosi.com', 'Inscripcion Tifosi');

                        $message->to('ligatifosi@hotmail.com')->subject($subjet);

                    });
                
               // }
               //else{
               //     Session::flash('mensajeErrorContacto', "Ya existe un equipo con ese nombre");
               //      return redirect()->action('WelcomeController@inscripcion');
        
               // }
                
            }

            Session::flash('mensajeOk', 'Inscripcion Enviada Con Exito. En Breve nos pondremos en contacto.');
            return redirect()->action('WelcomeController@inscripcion');
        }
        catch(\Exception $ex) {
            if ($ex->getMessage()==env('MSJ_ERRORJUGADOR')) {
                Session::flash('mensajeErrorContacto',$ex->getMessage());
                return redirect()->action('WelcomeController@inscripcion');
            } else {
            Session::flash('mensajeErrorContacto', "Discuple las molestias. El pedido de inscripcion no se pudo realizar. Intente en otro momento");
            return redirect()->action('WelcomeController@inscripcion');
            }
        }

    }


    public function  mailinscripcion()
    {
        try{
            if(Input::get('validador')=='')
            {
                $cuerpo="Nueva Inscripcion \n";
                $cuerpo = $cuerpo . "Torneo: ". Request::get('torneo')."\n";
                $cuerpo = $cuerpo . "Nombre Equipo: ".Input::get('nombre_equipo')."\n";
                $cuerpo = $cuerpo . "Nombre Delegado: ".Input::get('nombre')."\n";
                $cuerpo = $cuerpo . "DNI Delegado: ".Input::get('dni')."\n";
                $cuerpo = $cuerpo . "Celular Delegado: ".Input::get('celular')."\n";
                $cuerpo = $cuerpo . "Mail Delegado: ".Input::get('mail')."\n";
                $cuerpo = $cuerpo . "Domicilio Delegado: ".Input::get('domicilio')."\n";
                $cuerpo = $cuerpo . "Telefono Alternativo: ".Input::get('telefono_alternativo')."\n";
                $cuerpo = $cuerpo . "Mensaje: ".Input::get('mensaje')."\n";

                Mail::raw($cuerpo, function($message)
                {
                    $subjet = 'Inscripcion - Torneo: '.Request::get('torneo').' - Equipo: '.Input::get('nombre_equipo');

                    $message->from('web@ligatifosi.com', 'Inscripcion Tifosi');

                    $message->to('ligatifosi@hotmail.com')->subject($subjet);
                });
            }

            Session::flash('mensajeOk', 'Inscripcion Enviada Con Exito. En Breve nos pondremos en contacto.');
            return redirect()->action('WelcomeController@inscripcion');
        }
        catch(\Exception $ex)
        {
            Session::flash('mensajeErrorContacto', "Discuple las molestias. El pedido de inscripcion no se pudo realizar. Intente en otro momento");
            return redirect()->action('WelcomeController@inscripcion');
        }

    }
    public function  mailcontacto()
    {
        try{
            if(Input::get('validador_contacto')=='')
            {
                $cuerpo="Consuta desde el Formulario de Contacto de la Web \n";
                $cuerpo = $cuerpo . "Nombre: ". Request::get('nombre_contacto')."\n";
                $cuerpo = $cuerpo . "Ciudad: ".Input::get('ciudad_contacto')."\n";
                $cuerpo = $cuerpo . "Mail: ".Input::get('mail_contacto')."\n";
                $cuerpo = $cuerpo . "Mensaje: ".Input::get('mensaje_contacto')."\n";

                Mail::raw($cuerpo, function($message)
                {
                    $subjet = 'Consulta desde la Web - '.Request::get('nombre_contacto');

                    $message->from('web@ligatifosi.com', 'Contacto Tifosi');

                    $message->to('ligatifosi@hotmail.com')->subject($subjet);
                });
            }

            Session::flash('mensajeOkContacto', 'Consulta Enviada Con Exito. En Breve nos pondremos en contacto.');
            return redirect()->action('WelcomeController@index');
        }
        catch(\Exception $ex)
        {
            Session::flash('mensajeErrorContacto',"Discuple las molestias. El mensaje no se pudo enviar. Intente en otro momento");
            return redirect()->action('WelcomeController@index');
        }

    }

    public function noticias()
    {
        $listNoticias = Noticia::where('mostrar_en_seccion',1)->orderBy('idnoticia','DESC')->get();
        return view('noticias',compact('listNoticias'));
    }
    public function noticia($id)
    {
        try {
            $noticias = Noticia::findOrFail($id);
            return view('noticia', compact('noticias'));
        }
        catch(\Exception $ex)
        {
            return redirect()->action('WelcomeController@index');
        }
    }

    public function jugadoresfecha()
    {
        $listFiguras=Imagen::where('idtipo_imagen',2)->get();
        return view('jugadores-fecha',compact('listFiguras'));
    }
    public function equipoideal()
    {
        $listEquipoIdeal=Imagen::where('idtipo_imagen',3)->get();
        return view('equipo-ideal',compact('listEquipoIdeal'));
    }

}
