<?php

class PageI18n extends Eloquent {
	
	protected $table = 'pages_i18n';

	public static function saveData($id, $lang_id, $attribute, $data) {
		
		$lang_record = self::where('language_id', '=', $lang_id)
							->where('page_id', '=', $id)
							->first();

		if( !$lang_record )
		{
			$lang_record = new PageI18n;
			$lang_record->page_id = $id;
			$lang_record->language_id = $lang_id;
		}

		$lang_record->$attribute = $data;
		$lang_record->save();

		return $lang_record;
	}


	public function getExcerpt($length = 200) {
		return mb_substr(strip_tags($this->content), 0, $length, 'utf-8');
	}


}