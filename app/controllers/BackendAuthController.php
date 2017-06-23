<?php

class BackendAuthController extends \BaseController {

	
	public function login()
	{
		//
		return View::make('backend.login');
	}

	public function postLogin()
	{
		$inputs = Input::all();

		$user = User::where('username', '=', $inputs['username'])->where('password_md5', '=', md5($inputs['password']))->first();

		if( $user ) {
			Auth::loginUsingId($user->id);

			return Redirect::action('BackendController@index');
		}

		// if( Auth::attempt(array('username' => $inputs['username'], 'password' => $inputs['password'])) )
		// {
		// 	return Redirect::action('BackendController@index');
		// }

		return Redirect::action('BackendAuthController@login')->with('login_incorrect', true);
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::action('BackendAuthController@login')->with('logged_out', true);
	}


}
