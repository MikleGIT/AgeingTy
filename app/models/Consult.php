<?php

class Consult extends Eloquent {
	
	protected $table = 'consults';


	public static function getConsultsForSelect() {

		$select = array();
		$select[0] = trans('messages.consult_question_placeholder');

		foreach( Consult::orderBy('created_at', 'ASC')->get() as $consult ) {
			$select[$consult->id] = $consult->translate()->title;
		}

		return $select;
	}


	public function getFileUrl($lang = null) {
		if( is_null($lang) ) {
			$lang = App::getLocale();
		}

		return asset( Config::get('site.path.upload.file') . '/' . $this->translate($lang)->filename );
	}

	public function hasFile($lang = null) {
		if( is_null($lang) ) {
			$lang = App::getLocale();
		}

		return ($this->translate($lang)->filename != '' && !is_null($this->translate($lang)->filename));
	}

	public function deleteI18nData() {
		return ConsultI18n::where('consult_id', '=', $this->attributes['id'])->delete();
	}


	public function comments() {
		return $this->hasMany('ConsultComment', 'consult_id');
	}



	public function translate($lang_code = '') {
		if($lang_code == '')
			$lang_id = Language::getIdByCode( Config::get('app.locale') );
		else
			$lang_id =  Language::getIdByCode($lang_code);

		$i18n = ConsultI18n::where('consult_id', '=', $this->attributes['id'])
						  ->where('language_id', '=', $lang_id)
						  ->first();
		
		if( !$i18n ) {
			$stdclass = new stdClass();
			$stdclass->title = '';
			$stdclass->description = '';
			$stdclass->content = '';
			$stdclass->excerpt = '';
			$stdclass->image_filename = '';
			return $stdclass;
		}

		return $i18n;
	}


	public function getCommentsCount() {
		return ConsultComment::where('consult_id', '=', $this->attributes['id'])->count();
	}


	public function bulkSaveLanguages($attribute, $inputs) {
		foreach( Language::all() as $lang )
		{
			if( isset($inputs[$lang->code]) )
			{
				ConsultI18n::saveData($this->attributes['id'], $lang->id, $attribute, $inputs[$lang->code]);
			}
		}
	}

	public function bulkSaveFiles($attribute, $file, $lang_code)
	{
		if( $file )
		{
			$filename = md5( microtime() * rand() ) . '.' . $file->getClientOriginalExtension();

			if( !file_exists(public_path() . '/' . Config::get('site.path.upload.file')) )
			{
				mkdir(public_path() . '/' . Config::get('site.path.upload.file'), 0777);
			}

			$file->move(public_path() . '/' . Config::get('site.path.upload.file'), $filename);

			ConsultI18n::saveData($this->attributes['id'], Language::getIdByCode($lang_code), $attribute, $filename);
		}
	}

}