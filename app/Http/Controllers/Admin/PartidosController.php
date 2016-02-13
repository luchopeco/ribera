<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use torneo\Equipo;
use torneo\Fecha;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;

use Illuminate\Http\Request;
use torneo\Jugador;
use torneo\Partido;

class PartidosController extends Controller {

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

            $partido = new Partido($request->all());
            $partido->save();

            Session::flash('mensajeOk', 'Partido Agregado con Exito');
            return Redirect::route('admin.fechas.show',$request->idfecha);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.fechas.show',$request->idfecha);
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $partido = Partido::findOrFail($id);

        ///mando todos los jugadores locales con goles
        $listGoleadoresLocal = array();
        $sum=0;
        $equipo = Equipo::findOrFail($partido->EquipoLocal->idequipo);
        foreach($equipo->ListJugadores as $jugador)
        {
            foreach($partido->ListGoleadores as $goleador)
            {
                if ($jugador->idjugador == $goleador->idjugador)
                {
                    $jugador->goles_favor= $goleador->pivot->goles_favor;
                    $jugador->goles_contra=$goleador->pivot->goles_contra;
                    $jugador->cantidad_fechas_sancion=$goleador->pivot->cantidad_fechas_sancion;
                    $jugador->tarjeta_amarilla=$goleador->pivot->tarjeta_amarilla;
                    $jugador->tarjeta_azul=$goleador->pivot->tarjeta_azul;
                    $jugador->tarjeta_roja=$goleador->pivot->tarjeta_roja;
                    $listGoleadoresLocal[$sum] = $jugador;
                    $sum=$sum+1;
                }
            }

        };

        ///mando todos los jugadores visitantes con goles
        $listGoleadoresVisitante = array();
        $sum=0;
        $equipos = Equipo::findOrFail($partido->EquipoVisitante->idequipo);
        foreach($equipos->ListJugadores as $jugador)
        {
            foreach($partido->ListGoleadores as $goleador)
            {
                if ($jugador->idjugador == $goleador->idjugador)
                {
                    $jugador->goles_favor= $goleador->pivot->goles_favor;
                    $jugador->goles_contra=$goleador->pivot->goles_contra;
                    $jugador->cantidad_fechas_sancion=$goleador->pivot->cantidad_fechas_sancion;
                    $jugador->tarjeta_amarilla=$goleador->pivot->tarjeta_amarilla;
                    $jugador->tarjeta_azul=$goleador->pivot->tarjeta_azul;
                    $jugador->tarjeta_roja=$goleador->pivot->tarjeta_roja;
                    $listGoleadoresVisitante[$sum] = $jugador;
                    $sum=$sum+1;
                }
            }

        };
        $golesLocal = 0;
        $golesVisitante = 0;
        foreach($listGoleadoresLocal as $aux )
        {
            $golesLocal=$golesLocal+$aux->goles_favor;
            $golesVisitante=$golesVisitante+$aux->goles_contra;
        }
        foreach($listGoleadoresVisitante as $aux )
        {
            $golesLocal=$golesLocal+$aux->goles_contra;
            $golesVisitante=$golesVisitante+$aux->goles_favor;
        }
        if($golesLocal==$partido->goles_local && $golesVisitante==$partido->goles_visitante)
        {
            Session::flash('resultadoOk', 'No puede modificar un partido q ya fue jugado');
        }
        $listJugadoresVisitantes= $equipos->ListJugadores->lists('nombre_jugador', 'idjugador');
        $listJugadoresLocales= $equipo->ListJugadores->lists('nombre_jugador', 'idjugador');
        return view('admin.partido', compact('partido','listGoleadoresLocal','listGoleadoresVisitante','listJugadoresLocales','listJugadoresVisitantes'));


	}

    public function buscar(Request $request)
    {
        $ar = Partido::findOrFail($request->idpartido);
        $response = array(
            "result" => true,
            "mensaje" => "No se pudo realizar la operacion",
            "datos" => $ar
        );
        return json_encode($response, JSON_HEX_QUOT | JSON_HEX_TAG);
        //return view('articulos', compact('art'));
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

            $ar = Partido::findOrFail($request->idpartido);
            if($ar->goles_local!=null)
            {
                Session::flash('mensajeError', 'No puede modificar un partido q ya fue jugado');
                return Redirect::route('admin.fechas.show',$ar->idfecha);
            }
            $ar->hora=$request->hora;
            $ar->idequipo_local = $request->idequipo_local;
            $ar->idequipo_visitante = $request->idequipo_visitante;
            $ar->idarbitro = $request->idarbitro;
            $ar->save();

            Session::flash('mensajeOk', 'Partido Modificado con Exito');
            return Redirect::route('admin.fechas.show',$ar->idfecha);

        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.fechas.show',$ar->idfecha);
        }
	}
    public function resultado(Request $request)
    {
        try {

            $ar = Partido::findOrFail($request->idpartido);
            $ar->goles_local =$request->goles_local;
            $ar->goles_visitante=$request->goles_visitante;
            $ar->fue_jugado=1;
            if($ar->goles_local > $ar->goles_visitante)
            {
                $ar->puntos_local=3;
                $ar->puntos_visitante = 0;
                $ar->ganado_local=1;
                $ar->perdido_visitante=1;
            }
            else if ($ar->goles_visitante > $ar->goles_local )
            {
                $ar->puntos_visitante=3;
                $ar->puntos_local=0;
                $ar->ganado_visitante=1;
                $ar->perdido_local=1;
            }
            else if($ar->goles_visitante == $ar->goles_local )
            {
                $ar->puntos_visitante=1;
                $ar->puntos_local=1;
                $ar->empatado_local=1;
                $ar->empatado_visitante=1;
            }
            $ar->save();

            Session::flash('mensajeOk', 'Resultado Partido Actualizado con Exito');
            return Redirect::route('admin.partidos.show',$ar->idpartido);

        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.partidos.show',$ar->idpartido);

        }
    }
    public function goles(Request $request)
    {
        try {

            $ar = Partido::findOrFail($request->idpartido);

            $ar->ListGoleadores()->attach($request->idjugador,['goles_favor'=>$request->goles_favor, 'goles_contra'=>$request->goles_contra,'cantidad_fechas_sancion'=>$request->cantidad_fechas_sancion,'tarjeta_amarilla'=>$request->tarjeta_amarilla,
                'tarjeta_azul'=>$request->tarjeta_azul,'tarjeta_roja'=>$request->tarjeta_roja]);
            Session::flash('mensajeOk', 'Gol Agregado con Exito');
            return Redirect::route('admin.partidos.show',$ar->idpartido);

        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.partidos.show',$ar->idpartido);

        }
    }
    public function goleseliminar($idpartido,$idjugador)
    {
        try {
            $partido = Partido::findOrFail($idpartido);
            $jugador = Jugador::find($idjugador);
            $partido->ListGoleadores()->detach($jugador);

            Session::flash('mensajeOk', 'Gol Eliminado con Exito');
            return Redirect::route('admin.partidos.show',array($idpartido));

        } catch (QueryException  $ex) {

            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.partidos.show',array($idpartido));
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
            $par = Partido::findOrFail($request->idpartido);
            Partido::destroy($request->idpartido);
            Session::flash('mensajeOk', 'Partido Eliminado con Exito');
            return Redirect::route('admin.fechas.show',$par->idfecha);
        }
        catch(QueryException  $ex)
        {
            $par = Partido::findOrFail($request->idpartido);
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.fechas.show',$par->idfecha);
        }
	}

}
