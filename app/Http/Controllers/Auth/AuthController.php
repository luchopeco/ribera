<?php namespace torneo\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/



	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */

    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password]))
        {
            return redirect()->intended('/admin/home');
        }
        else
        {
           Session::flash('mensajeError','Usuario y/o clave Incorreta');
           return $this->getLogin();
        }
    }
    public function getLogout()
    {
        Auth::logout();
        return $this->getLogin();
    }

}
