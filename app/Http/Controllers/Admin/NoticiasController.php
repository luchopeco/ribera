<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use torneo\Noticia;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;



class NoticiasController extends Controller {

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
        $listNoticias = Noticia::all();
        //dd($listArbitros);
        return view('admin.noticias', compact('listNoticias','mensajeOK'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        try{
            $noticia = new Noticia($request->all());
            $noticia->mostrar_en_home=1;
            $noticia->mostrar_en_seccion=1;
            $noticia->save();

            Session::flash('mensajeOk', 'Noticia Agregada con Exito');
            return redirect()->route('admin.noticias.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.noticias.index');
        }

	}
    public function buscar(Request $request)
    {
        $ar = Noticia::findOrFail($request->idnoticia);
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
		//
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
            $ar = Noticia::findOrFail($request->idnoticia);
            $ar->titulo = $request->titulo;
             $ar->fecha = $request->fecha;
              $ar->texto = $request->texto;
            $ar->link=$request->link;
            if ($request->mostrar_en_home <> null) {
                $ar->mostrar_en_home=1;
            } else {
                $ar->mostrar_en_home=0;
            }
            if ($request->mostrar_en_seccion <> null) {
                $ar->mostrar_en_seccion=1;
            } else {
                $ar->mostrar_en_seccion=0;
            }



            $ar->save();

            Session::flash('mensajeOk', 'Noticia Modificada con Exito');
            return redirect()->route('admin.noticias.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.noticias.index');
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
            Noticia::destroy($request->idnoticia);
            Session::flash('mensajeOk', 'Noticia Eliminado con Exito');
            return redirect()->route('admin.noticias.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.noticias.index');
        }


	}

	 public function noticiaimagen($id)
    {
        $noticia = Noticia::find($id);
        return view('admin.noticiaimagen', compact('noticia'));
    }



	 public function noticiaimagenguardar(Request $request)
    {
        try
        {
            $noticia=Noticia::findOrFail($request->idnoticia);

          

            if ( Input::hasFile('file')) {
                $file =  Input::file('file');
                $noticia->imagen = 'imagen-noticia'.$noticia->idnoticia.'.'.$file->getClientOriginalExtension();
                //guardamos la imagen en public/imagenes/articulos con el nombre original
                $file->move("imagenes", 'imagen-noticia'.$noticia->idnoticia.'.'.$file->getClientOriginalExtension());
                $extension = $file->getClientOriginalExtension();
            }
            $noticia->save();

            // y retornamos un JSON con estatus en 200
            //return Response::json(['status'=>'true'],200);
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.noticias.index' );
        }
    }
    public function noticiaimagenborrar(Request $request)
    {
        try
        {
            $noticia=Noticia::findOrFail($request->idnoticia);
            $noticia->imagen=null;
            $noticia->save();

            Session::flash('mensajeOk', 'Imagen de la noticia  '.$noticia->titulo.' Eliminada con exito');
            return  Redirect::route('admin.noticias.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return Redirect::route('admin.noticias.index');
        }
    }

}
