<?php namespace torneo\Http\Controllers\Admin;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use torneo\Equipo;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;
use torneo\Jugador;
use torneo\Torneo;
use Illuminate\Http\Request;

class InscripcionController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $listEquipos = Equipo::where('aprobado','0')->orderBy('nombre_equipo','asc')->get();
        //$listEquipos= Equipo::orderBy('nombre_equipo', 'asc')->get()->lists('nombre_equipo', 'idequipo');
        //dd($listArbitros);
        return view('admin.inscripcion', compact('listTorneos','mensajeOK','listEquipos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        try{
            $torneo = new Equipo($request->all());
            if ($request->es_libre<> null) {
                $torneo->es_libre = 1;
            } else {
                $torneo->es_libre = 0;
            }
            $torneo->aprobado = 1;
            $torneo->save();

            Session::flash('mensajeOk', 'Equipo Agregado con Exito');
            return redirect()->route('admin.equipos.index');
        }
        catch(QueryException  $ex)
        {

            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.equipos.index');
        }
	}

    public function buscar(Request $request)
    {
        $ar = Equipo::findOrFail($request->idequipo);
        $response = array(
            "result" => true,
            "mensaje" => "No se pudo realizar la operacion",
            "datos" => $ar
        );
        return json_encode($response, JSON_HEX_QUOT | JSON_HEX_TAG);
        //return view('articulos', compact('art'));

    }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $equipo = Equipo::findOrFail($id);
            return view('admin.equipo', compact('equipo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
        try {

            $espacios = substr_count($request->nombre_usuario, " ");
            if($request->nombre_usuario!='' && $espacios>0)
            {
                Session::flash('mensajeError','EL nombre de usuario no puede tener espacios en blanco');
                return redirect()->route('admin.equipos.index');
            }
            else{
                $ar = Equipo::findOrFail($request->idequipo);
                $ar->nombre_equipo = $request->nombre_equipo;
                $ar->mensaje = $request->mensaje;
                $ar->observaciones = $request->observaciones;
                if ($request->nombre_usuario=='')
                {
                    $ar->nombre_usuario=null;
                }
                else{
                    $ar->nombre_usuario = strtolower( $request->nombre_usuario);
                }

                if ($request->autogestion <> null) {
                    $ar->autogestion = 1;
                } else {
                    $ar->autogestion = 0;
                }

                if ($request->es_libre <> null) {
                    $ar->es_libre = 1;
                } else {
                    $ar->es_libre = 0;
                }
                $ar->save();

                Session::flash('mensajeOk', 'Equipo Modificado con Exito');
                return redirect()->route('admin.equipos.index');

            }

        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.equipos.index');
        }
	}


    /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Request $request)
	{
        try
        {
            Equipo::destroy($request->idequipo);
            Session::flash('mensajeOk', 'Equipo Eliminado con Exito');
            return redirect()->route('admin.inscripcion.index');
        }
        catch(QueryException  $ex)
        {
            $par = Equipo::findOrFail($request->idequipo);
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.inscripcion.index');
        }
	}

    public function storejugador(Request $request)
    {

    }
    public function destroyjugador(Request $request)
    {
        try {
            $torneo = Torneo::findOrFail($request->idtorneo);
            $equipo = Equipo::find($request->idequipo);
            $torneo->ListEquipos()->detach($equipo);

            Session::flash('mensajeOk', 'Equipo Eliminado con Exito');
            return Redirect::route('admin.torneos.show',array($request->idtorneo));

        } catch (QueryException  $ex) {

            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }

    public function equipoimagen($id)
    {
        $equipo = Equipo::find($id);
        return view('admin.equipoimagen', compact('equipo'));
    }

    public function equipofotoguardar(Request $request)
    {
        try
        {
            $equipo=Equipo::findOrFail($request->idequipo);

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
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.index' );
        }
    }
    public function equipofotoborrar(Request $request)
    {
        try
        {
            $equipo=Equipo::findOrFail($request->idequipo);
            $equipo->foto=null;
            $equipo->save();

            Session::flash('mensajeOk', 'Foto del Equipo '.$equipo->nombre_equipo.' Eliminada con exito');
            return  Redirect::route('admin.equipos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.index');
        }
    }

    public function equipoescudoguardar(Request $request)
    {
        try
        {
            $equipo=Equipo::findOrFail($request->idequipo);

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
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos');
        }
    }
    public function equipoescudoborrar(Request $request)
    {
        try
        {
            $equipo=Equipo::findOrFail($request->idequipo);
            $equipo->escudo=null;
            $equipo->save();

            Session::flash('mensajeOk', 'Escudo del Equipo '.$equipo->nombre_equipo.' Eliminada con exito');
            return Redirect::route('admin.equipos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.index');
        }
    }
    public function resetearclave(Request $request)
    {
        try
        {
            $equipo=Equipo::findOrFail($request->idequipo);
            $equipo->clave=Hash::make('12345678');
            $equipo->save();

            Session::flash('mensajeOk', 'Clave reseteada con Exito');
            return redirect()->route('admin.equipos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.equipos.index');
        }
    }

    public function aceptarinscripcion($id)
    {
        try {
                $ar = Equipo::findOrFail($id);
                $ar->aprobado = 1;
                $ar->save();
                Session::flash('mensajeOk', 'Equipo Aceptado con Exito');
                return redirect()->route('admin.inscripcion.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.inscripcion.index');
        }

    }


}
