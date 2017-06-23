<?php

class Page extends Eloquent {
	
	protected $table = 'pages';


	public function deleteI18nData() {
		return PageI18n::where('page_id', '=', $this->attributes['id'])->delete();
	}

	public function translate($lang_code = '') {

		if($lang_code == '')
		{
			$lang_id = Language::getIdByCode( Config::get('app.locale') );
		}else{
			$lang_id =  Language::getIdByCode($lang_code);
		}


		if( Config::get('site.auto_gb') && $lang_id == Language::getIdByCode('gb') ) {
			$lang_id = Language::getIdByCode('cn');
		}


		$i18n = PageI18n::where('page_id', '=', $this->attributes['id'])
						  ->where('language_id', '=', $lang_id)
						  ->first();


		if( Config::get('site.auto_gb') && $i18n && Config::get('app.locale') == 'gb' ) {
			$i18n->title = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->title);
			$i18n->description = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->description);
			$i18n->content = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->content);
			$i18n->excerpt = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->excerpt);
		}


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


	public function bulkSaveLanguages($attribute, $inputs) {
		foreach( Language::all() as $lang )
		{
			if( isset($inputs[$lang->code]) )
			{
				PageI18n::saveData($this->attributes['id'], $lang->id, $attribute, $inputs[$lang->code]);
			}
		}
	}

}