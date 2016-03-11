<?php namespace torneo\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Tests\Controller;
use torneo\Equipo;
use torneo\Torneo;
use torneo\User;

class HomeController extends \Illuminate\Routing\Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $listEquipos = Equipo::EquiposSinInscripcion();
        $listTorneos = Torneo::all()->sortBy(function($hackathon)
        {
            return $hackathon->ListEquipos()->count();
        });

		return view('admin.home', compact('listTorneos','listEquipos'));
	}

    public function modificarclave()
    {
        try
        {
            if(Input::get('clave-nueva')==''||Input::get('clave-nueva-2')=='')
            {
                Session::flash('mensajeErrorSession', 'Ingrese una clave nueva');
                return redirect()->action('Admin\HomeController@index');

            }
            else if(Input::get('clave-nueva')!=Input::get('clave-nueva-2'))
            {
                Session::flash('mensajeErrorSession', 'Las claves nuevas no coinciden');
                return redirect()->action('Admin\HomeController@index');
            }
            else{
                $eq = User::findOrFail( Auth::user()->id);
                if (Hash::check(Input::get('clave-actual'),$eq->password))
                {
                    $eq->password=Hash::make(Input::get('clave-nueva'));
                    $eq->save();
                    Session::flash('mensajeOkSession', 'Clave modificada Correctamente');
                    return redirect()->action('Admin\HomeController@index');
                }
                else
                {
                    Session::flash('mensajeErrorSession', 'La clave actual es incorrecta');
                    return redirect()->action('Admin\HomeController@index');
                }

            }
        }
        catch(\Exception $ex)
        {
            Session::flash('mensajeErrorSession', $ex->getMessage());
            return redirect()->action('Admin\HomeController@index');
        }

    }


}
