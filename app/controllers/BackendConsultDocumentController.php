<?php

class BackendConsultDocumentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$consult_documents = ConsultDocument::orderBy('created_at', 'ASC')->get();

		return View::make('backend.consult_document.list')->with('consult_documents', $consult_documents);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//

		return View::make('backend.consult_document.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//

		$inputs = Input::all();

		$new_consult_document = new ConsultDocument;
		$new_consult_document->save();
		
		$new_consult_document->bulkSaveLanguages('title', $inputs['title']);

		foreach( $inputs['file'] as $lang_code => $file ) {
			if( Input::hasFile('file.' . $lang_code) ) {
				$new_consult_document->bulkSaveFiles('filename', $file, $lang_code);
			}
		}

		return Redirect::action('BackendConsultDocumentController@edit', array($new_consult_document->id))->with('success', true);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$consult_document = ConsultDocument::find($id);

		if( !$consult_document ) {
			return Redirect::action('BackendConsultDocumentController@index');
		}

		return View::make('backend.consult_document.edit')->with('consult_document', $consult_document);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$inputs = Input::all();

		$consult_document = ConsultDocument::find($id);

		if( !$consult_document ) {
			return Redirect::action('BackendConsultDocumentController@index');
		}

		$consult_document->bulkSaveLanguages('title', $inputs['title']);

		$filename = array();

		foreach( Language::getAvailableLanguages() as $language ) {
			if( Input::get('remove_file.' . $language->code) ) {
				$filename[$language->code] = '';
			}else{
				$filename[$language->code] = $consult_document->translate($language->code)->filename;
			}
		}

		$consult_document->bulkSaveLanguages('filename', $filename);

		foreach( $inputs['file'] as $lang_code => $file ) {
			if( Input::hasFile('file.' . $lang_code) ) {
				$consult_document->bulkSaveFiles('filename', $file, $lang_code);
			}
		}

		return Redirect::action('BackendConsultDocumentController@edit', array($id))->with('success', true);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$consult_document = ConsultDocument::find($id);

		if( $consult_document ) {
			ConsultDocumentI18n::where('consult_document_id', '=', $consult_document->id)->delete();
			$consult_document->delete();
		}

		return Redirect::action('BackendConsultDocumentController@index');
	}

}
