<?php

class CategoryI18n extends Eloquent {
	
	protected $table = 'categories_i18n';

	public static function saveData($id, $lang_id, $attribute, $data) {
		
		$lang_record = self::where('language_id', '=', $lang_id)
							->where('category_id', '=', $id)
							->first();

		if( !$lang_record )
		{
			$lang_record = new CategoryI18n;
			$lang_record->category_id = $id;
			$lang_record->language_id = $lang_id;
		}

		$lang_record->$attribute = $data;
		$lang_record->save();

		return $lang_record;
	}

}