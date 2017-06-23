<?php

class ConsultI18n extends Eloquent {
	
	protected $table = 'consults_i18n';

	public static function saveData($id, $lang_id, $attribute, $data) {
		
		$lang_record = self::where('language_id', '=', $lang_id)
							->where('consult_id', '=', $id)
							->first();

		if( !$lang_record )
		{
			$lang_record = new ConsultI18n;
			$lang_record->consult_id = $id;
			$lang_record->language_id = $lang_id;
		}

		$lang_record->$attribute = $data;
		$lang_record->save();

		return $lang_record;
	}

}