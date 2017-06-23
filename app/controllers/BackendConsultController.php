<?php

class BackendConsultController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$consults = Consult::orderBy('created_at', 'ASC')->get();

		return View::make('backend.consult.list')->with('consults', $consults);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//

		return View::make('backend.consult.create');
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

		$new_consult = new Consult;
		$new_consult->save();

		$new_consult->bulkSaveLanguages('title', $inputs['title']);

		/*
		foreach( $inputs['file'] as $lang_code => $file ) {
			if( Input::hasFile('file.' . $lang_code) ) {
				$new_consult->bulkSaveFiles('filename', $file, $lang_code);
			}
		}
		*/

		return Redirect::action('BackendConsultController@edit', array($new_consult->id))->with('success', true);
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
		$consult = Consult::find($id);

		if( !$consult ) {
			return Redirect::action('BackendConsultController@index');
		}

		return View::make('backend.consult.edit')->with('consult', $consult);
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

		$consult = Consult::find($id);

		if( !$consult ) {
			return Redirect::action('BackendConsultController@index');
		}

		$consult->bulkSaveLanguages('title', $inputs['title']);

		/*
		$filename = array();

		foreach( Language::getAvailableLanguages() as $language ) {
			if( Input::get('remove_file.' . $language->code) ) {
				$filename[$language->code] = '';
			}else{
				$filename[$language->code] = $consult->translate($language->code)->filename;
			}
		}

		$consult->bulkSaveLanguages('filename', $filename);

		foreach( $inputs['file'] as $lang_code => $file ) {
			if( Input::hasFile('file.' . $lang_code) ) {
				$consult->bulkSaveFiles('filename', $file, $lang_code);
			}
		}
		*/

		return Redirect::action('BackendConsultController@edit', array($id))->with('success', true);
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
		$consult = Consult::find($id);

		if( $consult ) {
			ConsultI18n::where('consult_id', '=', $consult->id)->delete();
			$consult->delete();
		}

		return Redirect::action('BackendConsultController@index');
	}


	public function comments($id)
	{
		$consult = Consult::find($id);

		if( !$consult ) {
			return Redirect::action('BackendConsultController@index');
		}

		return View::make('backend.consult.comments')->with('consult', $consult);
	}



	public function export($id)
	{
		$consult = Consult::find($id);

		if( !$consult ) {
			return App::abort(404);
		}


		// $csv = "\xEF\xBB\xBF" . "諮詢意見: " . $consult->translate('cn')->title . "\n";
		// $csv .= "姓名\t聯絡方式\t意見內容\t日期時間\n";

		// foreach($consult->comments as $comment)
		// {
		// 	$csv .= $comment->name . "\t" . $comment->contact . "\t" . $comment->message . "\t" . $comment->created_at . "\n";
		// }

		// $filename = date('YmdHis') . '.csv';
		// $filepath = public_path() . '/uploads/csv/' . $filename;

		// file_put_contents( $filepath, $csv, LOCK_EX );

		// return Response::download($filepath, $filename, array('Content-Type' => 'text/csv'));

		return Excel::create($consult->translate('cn')->title . '-' . date('YmdHis'), function($excel) use ($consult) {

			$excel->sheet('Comments', function($sheet) use ($consult) {
				$sheet->setOrientation('landscape');

				$sheet->row(1, array(
				    '諮詢意見: ' . $consult->translate('cn')->title
				));

				$sheet->mergeCells('A1:D1');

				$sheet->row(2, array(
				     '姓名', '聯絡方式', '意見內容', '日期時間'
				));

				$row_index = 3;

				foreach($consult->comments as $comment)
				{
					$sheet->row($row_index, array(
					    $comment->name, $comment->contact, $comment->message, $comment->created_at
					));

					$row_index++;
				}

		    });

		})->download('xlsx');
	}



}
