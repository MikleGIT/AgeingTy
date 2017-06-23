<?php

class BackendUploadController extends \BaseController {

	
	public function image() {

		$inputs = Input::all();

		$validator = Validator::make($inputs, array(
			'upload' => 'required|image'
		));

		if( $validator->fails() ) {
			return Response::json(array());
		}

		if(Input::hasFile('upload')) {
			$filename = Str::random(20) . '.' . Input::file('upload')->getClientOriginalExtension();
		    Input::file('upload')->move( public_path() . '/' . Config::get('site.path.upload.image'), $filename );

		    $filelink = asset(Config::get('site.path.upload.image') . '/' . $filename);

		    //return Response::json(array('filelink' => $filelink, 'filename' => $filename));
		    //return Response::json(array('uploaded' => 1, 'fileName' => $filename, 'url' => $filelink));

		    return '<script type="text/javascript">' . "\n" . 'window.parent.CKEDITOR.tools.callFunction("' . Input::get('CKEditorFuncNum') . '", "' . $filelink . '", "");' . "\n" . '</script>';
		}

	}


}
