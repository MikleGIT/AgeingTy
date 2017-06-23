<?php

class Language extends Eloquent {
	
	protected $table = 'languages';


	public static function getIdByCode($code) {
    	
		$lang = Language::where('code', '=', $code)->first();
		return $lang->id;
	}



	public static function isLangExists($lang) {

		return ( self::where('code', '=', $lang)->count() > 0 ) ? true : false;
	}


	public static function getAvailableLanguages() {

		return self::orderBy('created_at')->get();
	}

}