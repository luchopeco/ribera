<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PhpSpec\Exception\Exception;
use torneo\Arbitro;
use torneo\Http\Requests;
use torneo\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class ArbitrosController extends Controller {


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
        $listArbitros = Arbitro::all();
        //dd($listArbitros);
        return view('admin.arbitros', compact('listArbitros','mensajeOK'));
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
            $arbitro = new Arbitro($request->all());
            $arbitro->save();

            Session::flash('mensajeOk', 'Arbitro Agregado con Exito');
            return redirect()->route('admin.arbitros.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.arbitros.index');
        }

	}
    public function buscar(Request $request)
    {
        $ar = Arbitro::findOrFail($request->idarbitro);
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
            $ar = Arbitro::findOrFail($request->idarbitro);
            $ar->nombre = $request->nombre;
            $ar->save();

            Session::flash('mensajeOk', 'Arbitro Modificado con Exito');
            return redirect()->route('admin.arbitros.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.arbitros.index');
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
            Arbitro::destroy($request->idarbitro);
            Session::flash('mensajeOk', 'Arbitro Eliminado con Exito');
            return redirect()->route('admin.arbitros.index');
        }
        catch(QueryException  $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.arbitros.index');
        }


	}
    public function  mail()
    {
        try{
            Mail::raw('Mail de ejemplo', function($message)
            {
                $message->from('contacto@wiphalasistemas.com.ar', 'Wiphala');

                $message->to('caca');
            });

            Session::flash('mensajeOk', 'Mail enviado con exito');
            return redirect()->route('admin.arbitros.index');
        }
        catch(\Exception $ex)
        {
            Session::flash('mensajeError', $ex->getMessage());
            return redirect()->route('admin.arbitros.index');
        }

    }

}
