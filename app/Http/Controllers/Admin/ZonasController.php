<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use torneo\Equipo;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;

use Illuminate\Http\Request;
use torneo\Zona;

class ZonasController extends Controller {

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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        try{
            $z = new Zona($request->all());
            $z->save();

            Session::flash('mensajeOk', 'Zona Agregada con Exito');
            return back();

        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return back();
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
        $z = Zona::findOrFail($id);

        $listEquipos= Equipo::where('aprobado','1')->orderBy('nombre_equipo', 'asc')->get()->lists('nombre_equipo', 'idequipo');

        return view('admin.zona', compact('z','listEquipos'));
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
            $ar = Zona::findOrFail($request->idzona);
            $ar->nombre = $request->nombre;
            $ar->orden = $request->orden;
            $ar->save();

            Session::flash('mensajeOk', 'Zona Modificada con Exito');
            return back();
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return back();
        }
	}

    public function buscar(Request $request)
    {
        $ar = Zona::findOrFail($request->idzona);
        $response = array(
            "result" => true,
            "datos" => $ar
        );
        return json_encode($response, JSON_HEX_QUOT | JSON_HEX_TAG);
        //return view('articulos', compact('art'));

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
            Zona::destroy($request->idzona);
            Session::flash('mensajeOk', 'Zona Eliminada con Exito');
            return back();
        }
        catch(\Exception  $ex)
        {
            $z = Zona::findOrFail($request->idzona);
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.torneos.show', ['id' => $z->idtorneo]);
        }

    }

}
