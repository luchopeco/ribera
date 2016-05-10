<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use torneo\Arbitro;
use torneo\Fecha;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FechasController extends Controller {

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
        $ar = Fecha::findOrFail($request->idfecha);
        $ar->fecha=implode('/',array_reverse(explode('-',$ar->fecha)));
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
        try{
            $fech = new Fecha($request->all());
            if ($request->es_play_off <> null) {
                $fech->es_play_off = 1;
            } else {
                $fech->es_play_off = 0;
            }
            $fech->fecha=implode('-',array_reverse(explode('/',$request->fecha)));

            $fech->save();

            Session::flash('mensajeOk', 'Fecha Agregada con Exito');
            return back();
            //Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
        catch(QueryException  $ex)
        {

            Session::flash('mensajeError', $ex->getMessage());
            return back();
            //Redirect::route('admin.torneos.show',array($request->idtorneo));
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
        $fecha=Fecha::findOrFail($id);
        //dd($listArbitros);

        if ($fecha->Torneo==null)
        {
            Session::flash('mensajeError','El Torneo se encuentra inactivo. No puede Gestionar sus partidos');
            return redirect()->route('admin.torneos.index');
        }
        $listEquipos = $fecha->Zona->ListEquipos()->lists('nombre_equipo', 'idequipo');
        $listArbitros= Arbitro::all()->lists('nombre','idarbitro');
        return view('admin.partidos', compact('fecha','listEquipos','listArbitros'));
	}

    public function imagen($id)
    {
        $fecha=Fecha::findOrFail($id);
        //dd($listArbitros);
        return view('admin.fecha', compact('fecha'));
    }
    public function imagenguardar(Request $request)
    {
        try
        {
            $fecha=Fecha::findOrFail($request->idfecha);

            if (Input::hasFile('file')) {
                $file = Input::file('file');
                $fecha->imagen_fecha = $fecha->idfecha.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", $fecha->idfecha.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $fecha->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }
    public function imagenborrar(Request $request)
    {
        try
        {
            $fecha=Fecha::findOrFail($request->idfecha);
            $fecha->imagen_fecha=null;
            $fecha->save();

            Session::flash('mensajeOk', 'Imagen de la fecha '.$fecha->numero_fecha.' Eliminada con exito');
            return Redirect::route('admin.torneos.show',array($fecha->idtorneo));
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }

    public function imagenequipoguardar(Request $request)
    {
        try
        {
            $fecha=Fecha::findOrFail($request->idfecha);

            if (Input::hasFile('file')) {
                $file = Input::file('file');
                $fecha->imagen_equipo_ideal ='equipo-ideal-'. $fecha->idfecha.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'equipo-ideal-'.$fecha->idfecha.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $fecha->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }
    public function imagenequipoborrar(Request $request)
    {
        try
        {
            $fecha=Fecha::findOrFail($request->idfecha);
            $fecha->imagen_equipo_ideal=null;
            $fecha->save();

            Session::flash('mensajeOk', 'Imagen del equipo ideal de la fecha '.$fecha->numero_fecha.' Eliminada con exito');
            return Redirect::route('admin.torneos.show',array($fecha->idtorneo));
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }

    public function imagenfiguraguardar(Request $request)
    {
        try
        {
            $fecha=Fecha::findOrFail($request->idfecha);

            if (Input::hasFile('file')) {
                $file = Input::file('file');
                $fecha->imagen_figura_fecha ='figura-'. $fecha->idfecha.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'figura-'.$fecha->idfecha.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $fecha->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
    }
    public function imagenfiguraborrar(Request $request)
    {
        try
        {
            $fecha=Fecha::findOrFail($request->idfecha);
            $fecha->imagen_figura_fecha=null;
            $fecha->save();

            Session::flash('mensajeOk', 'Imagen de la figura de la fecha '.$fecha->numero_fecha.' Eliminada con exito');
            return Redirect::route('admin.torneos.show',array($fecha->idtorneo));
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
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
            $ar = Fecha::findOrFail($request->idfecha);
            $ar->fecha=implode('-',array_reverse(explode('/',$request->fecha)));
            $ar->observaciones = $request->observaciones;
            $ar->numero_fecha = $request->numero_fecha;
            if ($request->es_play_off <> null) {
                $ar->es_play_off = 1;
            } else {
                $ar->es_play_off = 0;
            }

            $ar->save();

            Session::flash('mensajeOk', 'Fecha Modificada con Exito');
            return back();
            //Redirect::route('admin.torneos.show',array($ar->idtorneo));
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return back();
            //return Redirect::route('admin.torneos.show',array($ar->idtorneo));
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
            Fecha::destroy($request->idfecha);
            Session::flash('mensajeOk', 'Fecha Eliminada con Exito');
            return back();
            //return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return back();
            //return Redirect::route('admin.torneos.show',array($request->idtorneo));
        }
	}

    public function planilla(Request $request)
    {
        $fecha=Fecha::findOrFail($request->id);
        $view = \View::make('admin.pdf.planillafecha',compact('fecha'))->render();
        $pdf =  \App::make('dompdf.wrapper');
        $pdf->setPaper("A4", "landscape");
        $pdf->loadHTML($view);
        return $pdf->stream('planilaa');
        //return view('admin.pdf.planillafecha', compact('fecha'));
    }

}
