<?php

class BackendCSVController extends \BaseController {

	
	public function index()
	{
		//
		
		return View::make('backend.csv_import.index');
	}


	public function import_to_learning() {

		$inputs = Input::all();

		$validator = Validator::make($inputs, array(
			'learning_csv' => 'required'
		), array(
			'learning_csv.required' => '請選擇 Excel 檔案',
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendCSVController@index')->withInput()->withErrors($validator);
		}

		if( !in_array(Input::file('learning_csv')->getMimeType(), array('application/vnd.ms-office', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/plain', 'text/csv', 'application/octet-stream')) ) {
			return Redirect::action('BackendCSVController@index')->with('error', '請上傳 Excel 檔案');
		}

		$filename = str_random(30) . '.xlsx';
		Input::file('learning_csv')->move( public_path() . '/' . Config::get('site.path.upload.file'), $filename );

		$filepath = public_path() . '/' . Config::get('site.path.upload.file') . '/' . $filename;

		if( !file_exists($filepath) ) {
			return Redirect::action('BackendCSVController@index')->with('error', '未能讀取 Excel 檔案');
		}

		$xls_content = Excel::load($filepath, function($reader) {

		})->toArray();

		//$csv_content = explode("\n", file_get_contents( $filepath ));

		$total_imported = 0;

		Eloquent::unguard();

		foreach( $xls_content as $row => $data ) {

			// Header and Title
			if( $row < 1 ) continue;

			//$data = explode(',', $row_content);

			if( count($data) != 27 ) {
				continue;
			}

			$post = new Post;
			$post->category_id = Input::get('learning_category');
			$post->user_id = (Auth::user()) ? Auth::user()->id : 0;
			$post->image_filename = null;
			$post->save();

			$post->bulkSaveLanguages('title', array('cn' => $data[0], 'gb' => $data[0], 'en' => '', 'pt' => $data[0 + 14]));
			
			$meta_data = new MetaData;
			$meta_data->meta_key = 'post_' . $post->id;
			$meta_data->meta_fields = "[i18n]\n主辦機構[organization,text]\n課程內容[detail,textarea]\n上課地點[address,text]\n開課日期[start_at,text]\n上課時間及形式[lesson_time,text]\n授課語言[language,text]\n學時[duration,text]\n招生對象/名額[quota,text]\n費用[fee,text]\n報名方式[apply,text]\n查詢電話[contact,text]\n備註[remark,textarea]\n[/i18n]\n[hidden:content]\n[hidden:excerpt]\n[hidden:image]";
			

			$fields = array();
			array_push($fields, array('organization__cn' => $data[1]));
			array_push($fields, array('organization__gb' => $data[1]));
			array_push($fields, array('organization__en' => ''));
			array_push($fields, array('organization__pt' => $data[1 + 14]));

			array_push($fields, array('detail__cn' => $data[2]));
			array_push($fields, array('detail__gb' => $data[2]));
			array_push($fields, array('detail__en' => ''));
			array_push($fields, array('detail__pt' => $data[2 + 14]));

			array_push($fields, array('address__cn' => $data[3]));
			array_push($fields, array('address__gb' => $data[3]));
			array_push($fields, array('address__en' => ''));
			array_push($fields, array('address__pt' => $data[3 + 14]));

			array_push($fields, array('start_at__cn' => $data[4]));
			array_push($fields, array('start_at__gb' => $data[4]));
			array_push($fields, array('start_at__en' => ''));
			array_push($fields, array('start_at__pt' => $data[4 + 14]));

			array_push($fields, array('lesson_time__cn' => $data[5]));
			array_push($fields, array('lesson_time__gb' => $data[5]));
			array_push($fields, array('lesson_time__en' => ''));
			array_push($fields, array('lesson_time__pt' => $data[5 + 14]));

			array_push($fields, array('language__cn' => $data[6]));
			array_push($fields, array('language__gb' => $data[6]));
			array_push($fields, array('language__en' => ''));
			array_push($fields, array('language__pt' => $data[6 + 14]));

			array_push($fields, array('duration__cn' => $data[7]));
			array_push($fields, array('duration__gb' => $data[7]));
			array_push($fields, array('duration__en' => ''));
			array_push($fields, array('duration__pt' => $data[7 + 14]));

			array_push($fields, array('quota__cn' => $data[8]));
			array_push($fields, array('quota__gb' => $data[8]));
			array_push($fields, array('quota__en' => ''));
			array_push($fields, array('quota__pt' => $data[8 + 14]));

			array_push($fields, array('fee__cn' => $data[9]));
			array_push($fields, array('fee__gb' => $data[9]));
			array_push($fields, array('fee__en' => ''));
			array_push($fields, array('fee__pt' => $data[9 + 14]));

			array_push($fields, array('apply__cn' => $data[10]));
			array_push($fields, array('apply__gb' => $data[10]));
			array_push($fields, array('apply__en' => ''));
			array_push($fields, array('apply__pt' => $data[10 + 14]));

			array_push($fields, array('contact__cn' => $data[11]));
			array_push($fields, array('contact__gb' => $data[11]));
			array_push($fields, array('contact__en' => ''));
			array_push($fields, array('contact__pt' => $data[11 + 14]));

			array_push($fields, array('remark__cn' => $data[12]));
			array_push($fields, array('remark__gb' => $data[12]));
			array_push($fields, array('remark__en' => ''));
			array_push($fields, array('remark__pt' => $data[12 + 14]));

			$meta_data->data = json_encode($fields);
			$meta_data->save();

			$total_imported++;
		}

		return Redirect::action('BackendCSVController@index')->with('successful_message', '成功匯入 ' . $total_imported . ' 筆資料');
	}

	public function import_to_events() {

		$inputs = Input::all();

		$validator = Validator::make($inputs, array(
			'events_csv' => 'required'
		), array(
			'events_csv.required' => '請選擇 Excel 檔案',
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendCSVController@index')->withInput()->withErrors($validator);
		}

		if( !in_array(Input::file('events_csv')->getMimeType(), array('application/vnd.ms-office', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/plain', 'text/csv', 'application/octet-stream')) ) {
			return Redirect::action('BackendCSVController@index')->with('error', '請上傳 Excel 檔案');
		}

		$filename = str_random(30) . '.xlsx';
		Input::file('events_csv')->move( public_path() . '/' . Config::get('site.path.upload.file'), $filename );

		$filepath = public_path() . '/' . Config::get('site.path.upload.file') . '/' . $filename;

		if( !file_exists($filepath) ) {
			return Redirect::action('BackendCSVController@index')->with('error', '未能讀取 Excel 檔案');
		}

		$xls_content = Excel::load($filepath, function($reader) {

		})->toArray();

		//$csv_content = explode("\n", file_get_contents( $filepath ));

		$total_imported = 0;

		Eloquent::unguard();

		foreach( $xls_content as $row => $data ) {

			// Header and Title
			if( $row < 1 ) continue;

			//$data = explode(',', $row_content);
			
			if( count($data) != 19 ) {
				continue;
			}

			$post = new Post;
			$post->category_id = Input::get('events_category');
			$post->user_id = (Auth::user()) ? Auth::user()->id : 0;
			$post->image_filename = null;
			$post->save();

			$post->bulkSaveLanguages('title', array('cn' => $data[0], 'gb' => $data[0], 'en' => '', 'pt' => $data[0 + 10]));
			
			$meta_data = new MetaData;
			$meta_data->meta_key = 'post_' . $post->id;
			$meta_data->meta_fields = "[i18n]\n地點[place,text]\n舉辦日期及時間[date,text]\n對象/名額[quota,text]\n聯絡電話[contact,text]\n演出者/主講者[performer,text]\n舉辦機構[organization,text]\n報名方式及費用[fee,text]\n備註[remark,textarea]\n[/i18n]\n[hidden:content]\n[hidden:excerpt]\n[hidden:language-independent]";
			

			$fields = array();
			array_push($fields, array('place__cn' => $data[1]));
			array_push($fields, array('place__gb' => $data[1]));
			array_push($fields, array('place__en' => ''));
			array_push($fields, array('place__pt' => $data[1 + 10]));

			array_push($fields, array('date__cn' => $data[2]));
			array_push($fields, array('date__gb' => $data[2]));
			array_push($fields, array('date__en' => ''));
			array_push($fields, array('date__pt' => $data[2 + 10]));

			array_push($fields, array('quota__cn' => $data[3]));
			array_push($fields, array('quota__gb' => $data[3]));
			array_push($fields, array('quota__en' => ''));
			array_push($fields, array('quota__pt' => $data[3 + 10]));

			array_push($fields, array('contact__cn' => $data[4]));
			array_push($fields, array('contact__gb' => $data[4]));
			array_push($fields, array('contact__en' => ''));
			array_push($fields, array('contact__pt' => $data[4 + 10]));

			array_push($fields, array('performer__cn' => $data[5]));
			array_push($fields, array('performer__gb' => $data[5]));
			array_push($fields, array('performer__en' => ''));
			array_push($fields, array('performer__pt' => $data[5 + 10]));

			array_push($fields, array('organization__cn' => $data[6]));
			array_push($fields, array('organization__gb' => $data[6]));
			array_push($fields, array('organization__en' => ''));
			array_push($fields, array('organization__pt' => $data[6 + 10]));

			array_push($fields, array('fee__cn' => $data[7]));
			array_push($fields, array('fee__gb' => $data[7]));
			array_push($fields, array('fee__en' => ''));
			array_push($fields, array('fee__pt' => $data[7 + 10]));

			array_push($fields, array('remark__cn' => $data[8]));
			array_push($fields, array('remark__gb' => $data[8]));
			array_push($fields, array('remark__en' => ''));
			array_push($fields, array('remark__pt' => $data[8 + 10]));

			$meta_data->data = json_encode($fields);
			$meta_data->save();

			$total_imported++;
		}

		return Redirect::action('BackendCSVController@index')->with('successful_message', '成功匯入 ' . $total_imported . ' 筆資料');
	}


	public function downloadCourseCSV() {
		return Response::download( public_path() . '/csv/course_xls_template.xlsx' );
	}

	public function downloadEventCSV() {
		return Response::download( public_path() . '/csv/event_xls_template.xlsx' );
	}


}
