<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use torneo\Equipo;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;

use Illuminate\Http\Request;
use torneo\TipoTorneo;
use torneo\Torneo;
use torneo\User;
use torneo\Zona;

class TorneosController extends Controller {

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

        //$user = User::find(1);
        //$user->password = Hash::make('admin');
        //$user->save();

        $listTorneos = Torneo::withTrashed()->get();
        $listTipoToneo = TipoTorneo::lists('nombre_tipo_torneo', 'idtipo_torneo');
        //dd($listArbitros);
        return view('admin.torneos', compact('listTorneos','listTipoToneo'));
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
            $torneo = new Torneo($request->all());
            if ($request->tablas_x_torneo<> null) {
                $torneo->tablas_x_torneo = 1;
            } else {
                $torneo->tablas_x_torneo  = 0;
            }
            if ($request->estadisticas_x_torneo<> null) {
                $torneo->estadisticas_x_torneo = 1;
            } else {
                $torneo->estadisticas_x_torneo  = 0;
            }
            $torneo->save();

            Session::flash('mensajeOk', 'Torneo Agregado con Exito');
            return redirect()->route('admin.torneos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.torneos.index');
        }
	}

    public function buscar(Request $request)
    {
        $ar = Torneo::withTrashed()->where('idtorneo', $request->idtorneo)->first();
        $response = array(
            "result" => true,
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
        $torneo = Torneo::withTrashed()->where('idtorneo', $id)->first();
        ///Le mando todos los equipos!!
        $listEquipos= Equipo::where('aprobado','1')->orderBy('nombre_equipo', 'asc')->get()->lists('nombre_equipo', 'idequipo');
        //dd($listArbitros);
        if($torneo->Activo()=='NO')
        {
            Session::flash('mensajeError','El Torneo se encuentra inactivo. No puede Gestionar sus Fechas');
            return redirect()->route('admin.torneos.index');
        }
        return view('admin.torneo', compact('torneo','mensajeOK','listEquipos'));

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
            $ar = Torneo::withTrashed()->where('idtorneo',$request->idtorneo)->first();
            $ar->nombre_torneo = $request->nombre_torneo;
            $ar->observaciones_torneo = $request->observaciones_torneo;
            $ar->idtipo_torneo = $request->idtipo_torneo;
            if ($request->tablas_x_torneo<> null) {
                $ar->tablas_x_torneo = 1;
            } else {
                $ar->tablas_x_torneo  = 0;
            }
            if ($request->estadisticas_x_torneo<> null) {
                $ar->estadisticas_x_torneo = 1;
            } else {
                $ar->estadisticas_x_torneo  = 0;
            }


            $ar->save();

            Session::flash('mensajeOk', 'Torneo Modificado con Exito');
            return redirect()->route('admin.torneos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.torneos.index');
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
            $tor = Torneo::withTrashed()->where('idtorneo', $request->idtorneo)->first();
            $tor->forceDelete();
            Session::flash('mensajeOk', 'Torneo Eliminado con Exito');
            return redirect()->route('admin.torneos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.torneos.index');
        }
	}

    public function storeequipo(Request $request)
    {
        try {
            $z =Zona::findOrFail($request->idzona);
            $equipo = Equipo::find($request->idequipo);
            $z->ListEquipos()->attach($equipo);

            Session::flash('mensajeOk', 'Equipo Agregado con Exito');
            return back();
            //return Redirect::route('admin.torneos.show',array($request->idtorneo));

        } catch (QueryException  $ex) {

            Session::flash('mensajeError', $ex->getMessage());
            return back();
            //return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }
    public function destroyequipo(Request $request)
    {
        try {
            $z =Zona::findOrFail($request->idzona);
            $equipo = Equipo::find($request->idequipo);
            $z->ListEquipos()->detach($equipo);

            Session::flash('mensajeOk', 'Equipo Eliminado con Exito');
            return back();
            //return Redirect::route('admin.torneos.show',array($request->idtorneo));

        } catch (QueryException  $ex) {

            Session::flash('mensajeError', $ex->getMessage());
            return back();
            //return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }

    public function baja(Request $request)
    {

        try
        {
            Torneo::destroy($request->idtorneo);
            Session::flash('mensajeOk', 'Torneo Dado de baja con Exito');
            return redirect()->route('admin.torneos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.torneos.index');
        }

    }
    public function alta(Request $request)
    {

        try
        {
            $tor = Torneo::withTrashed()->where('idtorneo', $request->idtorneo)->first();
            $tor->restore();
            Session::flash('mensajeOk', 'Torneo Dado de Alta con Exito');
            return redirect()->route('admin.torneos.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.torneos.index');
        }

    }


    public function torneoimagenguardar(Request $request)
    {
        try
        {
            $tor = Torneo::withTrashed()->where('idtorneo',$request->idtorneo)->first();

            if ( Input::hasFile('file')) {
                $file = Input::file('file');
                $tor->imagen = 'imagen-torneo'.$tor->idtorneo.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'imagen-torneo'.$tor->idtorneo.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $tor->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }

    public function torneoimagenborrar(Request $request)
    {
        try
        {
            $tor = Torneo::withTrashed()->where('idtorneo',$request->idtorneo)->first();
            $tor ->imagen=null;
            $tor ->save();

            Session::flash('mensajeOk', 'Imagen del torneo Eliminada con exito');
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }
}
