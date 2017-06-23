<?php

class BackendAttachmentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$records = Attachment::orderBy('id', 'ASC')->get();

		return View::make('backend.attachment.index')->with('records', $records);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//

		return View::make('backend.attachment.create');
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

		$validator = Validator::make($inputs, array(
			'file' => 'required'
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendAttachmentController@create')->withInput()->withErrors($validator);
		}

		$attachment = new Attachment;
		$attachment->title = $inputs['title'];
		$attachment->user_id = (Auth::user()) ? Auth::user()->id : null;

		if( Input::hasFile('file') ) {

			$filename = str_random(30) . '.' . Input::file('file')->getClientOriginalExtension();
			Input::file('file')->move(public_path() . '/' . Config::get('site.path.upload.file'), $filename);

			$attachment->filename = $filename;
		}

		$attachment->save();

		return Redirect::action('BackendAttachmentController@edit', array($attachment->id))->with('success', true);
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
		$record = Attachment::find($id);

		if( !$record ) {
			return Redirect::action('BackendAttachmentController@index');
		}

		return View::make('backend.attachment.edit')->with('record', $record);
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
		$attachment = Attachment::find($id);

		if( !$attachment ) {
			return Redirect::action('BackendAttachmentController@index');
		}

		$inputs = Input::all();

		$validator = Validator::make($inputs, array(
			'file' => 'required'
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendAttachmentController@create')->withInput()->withErrors($validator);
		}

		$attachment->title = $inputs['title'];
		$attachment->user_id = (Auth::user()) ? Auth::user()->id : null;

		if( Input::hasFile('file') ) {

			$filename = str_random(30) . '.' . Input::file('file')->getClientOriginalExtension();
			Input::file('file')->move(public_path() . '/' . Config::get('site.path.upload.file'), $filename);

			$attachment->filename = $filename;
		}

		$attachment->save();

		return Redirect::action('BackendAttachmentController@edit', array($attachment->id))->with('success', true);
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
		$attachment = Attachment::find($id);

		if( !$attachment ) {
			return Redirect::action('BackendAttachmentController@index');
		}

		$filepath = public_path() . '/' . Config::get('site.path.upload.file') . '/' . $attachment->filename;

		if( file_exists($filepath) ) {
			@unlink($filepath);
		}

		$attachment->delete();

		return Redirect::action('BackendAttachmentController@index');
	}


}
