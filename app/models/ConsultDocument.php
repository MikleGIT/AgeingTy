<?php

class ConsultDocument extends Eloquent {
	
	protected $table = 'consult_documents';


	public static function getConsultsForSelect() {

		$select = array();
		$select[0] = trans('messages.consult_question_placeholder');

		foreach( ConsultDocument::orderBy('created_at', 'ASC')->get() as $consult ) {
			$select[$consult->id] = $consult->translate()->title;
		}

		return $select;
	}

	public function hasFile($lang = null) {
		if( is_null($lang) ) {
			$lang = App::getLocale();
		}

		return ($this->translate($lang)->filename != '' && !is_null($this->translate($lang)->filename));
	}

	public function getFileUrl($lang = null) {
		if( is_null($lang) ) {
			$lang = App::getLocale();
		}

		return asset( Config::get('site.path.upload.file') . '/' . $this->translate($lang)->filename );
	}


	public function translate($lang_code = '') {
		if($lang_code == '')
			$lang_id = Language::getIdByCode( Config::get('app.locale') );
		else
			$lang_id =  Language::getIdByCode($lang_code);

		$i18n = ConsultDocumentI18n::where('consult_document_id', '=', $this->attributes['id'])
						  			 ->where('language_id', '=', $lang_id)
						  			 ->first();
		
		if( !$i18n ) {
			$stdclass = new stdClass();
			$stdclass->title = '';
			$stdclass->filename = '';
			return $stdclass;
		}

		return $i18n;
	}

	public function bulkSaveLanguages($attribute, $inputs) {
		foreach( Language::all() as $lang )
		{
			if( isset($inputs[$lang->code]) )
			{
				ConsultDocumentI18n::saveData($this->attributes['id'], $lang->id, $attribute, $inputs[$lang->code]);
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

			ConsultDocumentI18n::saveData($this->attributes['id'], Language::getIdByCode($lang_code), $attribute, $filename);
		}
	}

}