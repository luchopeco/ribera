<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;

use Illuminate\Http\Request;
use torneo\Imagen;
use torneo\TipoImagen;

class ImagenesController extends Controller {

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
        $listTipoImagen = TipoImagen::lists('descripcion', 'idtipo_imagen');
        $listSlider = Imagen::all();
        return view('admin.paginainicio', compact('listSlider','listTipoImagen'));
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
            $slider = new Imagen($request->all());
            $slider->save();

            Session::flash('mensajeOk', 'Imagen Agregada con Exito');
            return redirect()->route('admin.imagenes.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.imagenes.index');
        }
	}
    public function buscar(Request $request)
    {
        $ar = Imagen::findOrFail($request->idimagen);
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
        $slider = Imagen::find($id);
        return view('admin.imagenes', compact('slider'));
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
            $ar = Imagen::findOrFail($request->idimagen);
            $ar->titulo = $request->titulo;
            if ($request->mostrar <> null) {
                $ar->mostrar = 1;
            } else {
                $ar->mostrar = 0;
            }
            $ar->save();

            Session::flash('mensajeOk', 'Imagen Modificada con Exito');
            return redirect()->route('admin.imagenes.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.imagenes.index');
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
            Imagen::destroy($request->idimagen);
            Session::flash('mensajeOk', 'Imagen Eliminada con Exito');
            return redirect()->route('admin.imagenes.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.imagenes.index');
        }
	}

	 public function imagenshow($id)
    {
        $slider = Imagen::find($id);
        return view('admin.imagenes', compact('slider'));
    }



	 public function imagenguardar(Request $request)
    {
        try
        {
            $slider=Imagen::findOrFail($request->idimagen);

            if ( Input::hasFile('file')) {
                $file =  Input::file('file');
                $slider->imagen = $slider->TipoImagen->descripcion.'-'.$slider->idimagen.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", $slider->imagen);
            }
            $slider->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.paginainicio.index' );
        }
    }
    public function imagenborrar(Request $request)
    {
        try
        {
            $slider=Imagen::findOrFail($request->idimagen);
            $slider->imagen=null;
            $slider->save();

            Session::flash('mensajeOk', 'Imagen  '.$slider->titulo.' Eliminada con exito');
            return  Redirect::route('admin.imagenes.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.paginainicio.index');
        }
    }

	/*
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

    */

}
