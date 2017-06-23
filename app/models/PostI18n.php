<?php

class PostI18n extends Eloquent {
	
	protected $table = 'posts_i18n';

	public static function saveData($id, $lang_id, $attribute, $data) {
		
		$lang_record = self::where('language_id', '=', $lang_id)
							->where('post_id', '=', $id)
							->first();

		if( !$lang_record )
		{
			$lang_record = new PostI18n;
			$lang_record->post_id = $id;
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