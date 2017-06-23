<?php

class MetaDataController extends \BaseController {

	
	public function getFields() {

		$meta_key = Input::get('meta_key');

		$metadata = MetaData::findByMetaKey($meta_key);

		if( $metadata ) {
			return View::make('backend.metadata.form')->with('metadata', $metadata);
		}
	}


}
