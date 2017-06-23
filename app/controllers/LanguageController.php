<?php

class LanguageController extends \BaseController {

	
	public function setLang($lang_code)
	{
		if( Language::isLangExists($lang_code) ) {
			Session::put('locale', $lang_code);
			App::setLocale($lang_code);
		}else{
			Session::put('locale', Config::get('app.fallback_locale'));
			App::setLocale(Config::get('app.fallback_locale'));
		}

		return Redirect::back();
	}
	
	public function setIndexLang($lang_code)
	{
		if( Language::isLangExists($lang_code) ) {
			Session::put('locale', $lang_code);
			App::setLocale($lang_code);
		}else{
			Session::put('locale', Config::get('app.fallback_locale'));
			App::setLocale(Config::get('app.fallback_locale'));
		}
		//return Redirect::back();
		return Redirect::action('HomeController@index');
	}
	
	public function setDocumentsLang($lang_code)
	{
		if( Language::isLangExists($lang_code) ) {
			Session::put('locale', $lang_code);
			App::setLocale($lang_code);
		}else{
			Session::put('locale', Config::get('app.fallback_locale'));
			App::setLocale(Config::get('app.fallback_locale'));
		}
		return Redirect::to('/consult/documents');
	}


}
