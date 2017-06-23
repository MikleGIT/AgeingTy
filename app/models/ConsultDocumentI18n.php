<?php

class ConsultDocumentI18n extends Eloquent {
	
	protected $table = 'consult_documents_i18n';

	public static function saveData($id, $lang_id, $attribute, $data) {
		
		$lang_record = self::where('language_id', '=', $lang_id)
							->where('consult_document_id', '=', $id)
							->first();

		if( !$lang_record )
		{
			$lang_record = new ConsultDocumentI18n;
			$lang_record->consult_document_id = $id;
			$lang_record->language_id = $lang_id;
		}

		$lang_record->$attribute = $data;
		$lang_record->save();

		return $lang_record;
	}

}