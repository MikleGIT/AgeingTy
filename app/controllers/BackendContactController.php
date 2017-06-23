<?php

class BackendContactController extends \BaseController {


	public function __construct() {
		
		$this_instance = $this;

		$this->beforeFilter(function() use ($this_instance) {

			$category = Category::findBySlug('contact');

			View::share('backend_category_id', $category->id);
			View::share('backend_category', $category);
			View::share('backend_contact', true);
		});
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$contacts = Contact::orderBy('id', 'DESC')->get();

		return View::make('backend.contact.index')->with('contacts', $contacts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	}



	public function export()
	{
		$contacts = Contact::orderBy('created_at', 'ASC')->get();

		return Excel::create('聯絡我們-' . date('YmdHis'), function($excel) use ($contacts) {

			$excel->sheet('Contacts', function($sheet) use ($contacts) {
				$sheet->setOrientation('landscape');

				//$sheet->mergeCells('A1:D1');

				$sheet->row(1, array(
				     '姓名', '聯絡方式', '意見內容', '日期時間'
				));

				$row_index = 2;

				foreach($contacts as $contact)
				{
					$sheet->row($row_index, array(
					    $contact->name, $contact->contact, $contact->message, $contact->created_at
					));

					$row_index++;
				}

		    });

		})->download('xlsx');
	}


}
