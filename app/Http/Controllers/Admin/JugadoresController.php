<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;

use Illuminate\Http\Request;
use torneo\Jugador;

class JugadoresController extends Controller
{

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
        //
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

    public function buscar(Request $request)
    {
        $ar = Jugador::findOrFail($request->idjugador);
        $response = array(
            "result" => true,
            "mensaje" => "No se pudo realizar la operacion",
            "datos" => $ar
        );
        return json_encode($response, JSON_HEX_QUOT | JSON_HEX_TAG);
        //return view('articulos', compact('art'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $jugador = new Jugador($request->all());

            if ($request->delegado <> null) {
                $jugador->delegado = 1;
            } else {
                $jugador->delegado = 0;
            }

            if ($request->certificado <> null) {
                $jugador->certificado = 1;
            } else {
                $jugador->certificado = 0;
            }
            $jugador->validaralta();
            $jugador->save();

            Session::flash('mensajeOk', 'Jugador Agregado con Exito');
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        } catch (QueryException  $ex) {

            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        }
        catch (\Exception  $ex) {

            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request)
    {
        try {
            $ar = Jugador::findOrFail($request->idjugador);
            $ar->nombre_jugador = $request->nombre_jugador;
            $ar->apellido_jugador = $request->apellido_jugador;
            $ar->dni = $request->dni;
            $ar->observaciones = $request->observaciones;

            $ar->telefono = $request->telefono;
            $ar->grupo_sanguineo = $request->grupo_sanguineo;
            $ar->mail = $request->mail;
            $ar->direccion = $request->direccion;
            $ar->obra_social = $request->obra_social;

            if ($request->delegado <> null) {
                $ar->delegado = 1;
            } else {
                $ar->delegado = 0;
            }

            if ($request->certificado <> null) {
                $ar->certificado = 1;
            } else {
                $ar->certificado = 0;
            }


            $ar->save();

            Session::flash('mensajeOk', 'Jugador Modificado con Exito');
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        } catch (QueryException  $ex) {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        try {
            $jug = Jugador::withTrashed()->where('idjugador', $request->idjugador)->first();
            $jug->forceDelete();

            Session::flash('mensajeOk', 'Jugador Eliminado con Exito');
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        } catch (QueryException  $ex) {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        }
    }

    public function baja(Request $request)
    {
        try {
            Jugador::destroy($request->idjugador);
            Session::flash('mensajeOk', 'Jugador En Lista Negra con Exito');
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        } catch (QueryException  $ex) {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.equipos.show', array($request->idequipo));
        }

    }

    public function alta(Request $request)
    {

        try {
            $tor = Jugador::withTrashed()->where('idjugador', $request->idjugador)->first();
            $tor->restore();
            Session::flash('mensajeOk', 'Jugador Quitado de la Lista Negra Con Exito');
            $listJugador = Jugador::onlyTrashed()->get();
            return view('admin.listanegra', compact('listJugador'));
        } catch (QueryException  $ex) {
            Session::flash('mensajeError', $ex->getMessage());
            $listJugador = Jugador::onlyTrashed()->get();
            return view('admin.listanegra', compact('listJugador'));
        }

    }

    public function imagenjugadorguardar(Request $request)
    {
        try {

            $jug = Jugador::withTrashed()->where('idjugador', $request->idjugador)->first();

            if (Input::hasFile('file')) {
                $file = Input::file('file');
                $jug->pathfoto = 'jugador' . $jug->idjugador . '.' . $file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'jugador' . $jug->idjugador . '.' . $file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $jug->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        } catch (QueryException  $ex) {

        }
    }

    public function imagenjugadorborrar(Request $request)
    {
        try {
            $jug = Jugador::withTrashed()->where('idjugador', $request->idjugador)->first();
            $jug->pathfoto = null;
            $jug->save();
            Session::flash('mensajeOk', 'Imagen Eliminada Con Exito');
            $listJugador = Jugador::onlyTrashed()->get();
            return view('admin.listanegra', compact('listJugador'));

        } catch (QueryException  $ex) {
            Session::flash('mensajeError', $ex->getMessage());
            return view('admin.listanegra');

        }
    }


    public function listanegra()
    {
        try {
            $listJugador = Jugador::onlyTrashed()->get();
            return view('admin.listanegra', compact('listJugador'));

        } catch (QueryException  $ex) {
            Session::flash('mensajeError', $ex->getMessage());
            return view('admin.listanegra', compact('listJugador'));
        }
    }








}
