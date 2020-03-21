<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Model;


class LoginController extends Controller {
	/*
		        |--------------------------------------------------------------------------
		        | Login Controller
		        |--------------------------------------------------------------------------
		        |
		        | This controller handles authenticating users for the application and
		        | redirecting them to your home screen. The controller uses a trait
		        | to conveniently provide its functionality to your applications.
		        |
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/member/dashboard';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest:client')->except('logout');
	}

	    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        $goto = urldecode ($request->goto);
        Session::put('goto', $goto);
        
        return view('eCommerce.account');
        
    }

	/**
	 * Validate the user login request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function validateLogin(Request $request) {
		$request->validate([
			'email_or_username' => 'required|string',
			'password' => 'required|string',
		]);
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request) {
		$email_or_username = $request->email_or_username;
		$model = User::where('username', $email_or_username)->first();
		if (!$model) {
			$model = User::where('email', $email_or_username)->first();
        }
		if ($model != null) { 
			if ($model->status != 'activated') {
				return ['email' => 'inactive', 'password' => 'suspend'];
			} else {
				return ['email' => $model->email, 'password' => $request->password, 'status' => 'activated'];
			}
		} else {
			return ['email' => $request->email_or_username, 'password' => $request->password, 'status' => 'suspend'];
		}
	}

	/**
	 * Get the failed login response instance.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function sendFailedLoginResponse(Request $request) {
        $fields = $this->credentials($request);
		if ($fields['email'] == 'inactive' && $fields['password'] == 'suspend') {
			throw ValidationException::withMessages([
				'email_or_username' => [trans('auth.suspend')],
			]);
		} else {
			throw ValidationException::withMessages([
				'email_or_username' => [trans('auth.failed')],
			]);
		}
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user) {
	    dd('hello world');
        $goto = Session::get('goto') ? Session::get('goto') :  redirect()->intended($this->redirectPath())->getTargetUrl();
        dd('hello');
		return response()->json(['message' => trans('auth.logged_in'), 'goto' => $goto]);
		
		
		Session::flash('goto');
	}
/**
 * The user has logged out of the application.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return mixed
 */
	protected function loggedOut(Request $request) {
		return response()->json(['message' => trans('auth.logged_out'), 'goto' => route('login')]);
	}


	protected function guard()
    {
        return Auth::guard('client');
    }


}
