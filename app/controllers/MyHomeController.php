<?php

class MyHomeController extends BaseController {




	public function index() {

		//return Redirect::to('/consult');

		return View::make('frontend.home.index')->with('cssName', 'home');
	}
	
	public function default_index() {

		return View::make('frontend.home.default_index')->with('cssName', 'home');
	}
	
	public function sitemap() {

		return View::make('frontend.home.sitemap')->with('cssName', 'home');
	}


	public function submitConsultComment() {

		$inputs = Input::all();

		$new_consult_comment = new ConsultComment;
		$new_consult_comment->name = $inputs['name'];
		$new_consult_comment->contact = $inputs['contact'];
		$new_consult_comment->consult_id = $inputs['consult_id'];
		$new_consult_comment->message = $inputs['message'];
		$new_consult_comment->save();

		return Redirect::back()->with('success', true);
	}

	public function submitContact() {

		$inputs = Input::all();

		$new_contact = new Contact;
		$new_contact->name = $inputs['name'];
		$new_contact->contact = $inputs['contact'];
		$new_contact->message = $inputs['message'];
		$new_contact->save();

		return Redirect::back()->with('success', true);
	}

	public function search() {
		
		$keyword = trim(Input::get('q'));

		if( $keyword != '' )
		{
			$lang_id = Language::getIdByCode(App::getLocale());

			if( App::getLocale() == 'gb' ) {
				$lang_id = Language::getIdByCode('cn');
				$keyword = Blupurple\Cn2Gb\Cn2Gb::trans($keyword, true);
			}

			$results = PageI18n::where(function($query) use ($keyword) {
				$query->where('title', 'LIKE', '%' . $keyword . '%')
					    ->orWhere('content', 'LIKE', '%' . $keyword . '%');
			})->where('language_id', '=', $lang_id)
			  ->get();

			foreach( $results as $i => $result ) {
				$results[$i]['title'] = $this->highlight(strip_tags($result->title), $keyword);
				$results[$i]['highlight'] = $this->highlight(strip_tags($result->content), $keyword);

				if( App::getLocale() == 'gb' ) {
					$keyword = Blupurple\Cn2Gb\Cn2Gb::trans($keyword);
					$results[$i]['title'] = Blupurple\Cn2Gb\Cn2Gb::trans($results[$i]['title']);
					$results[$i]['highlight'] = Blupurple\Cn2Gb\Cn2Gb::trans($results[$i]['highlight']);
				}
			}

		}else{
			$results = array();
		}

		return View::make('frontend.home.search')->with('results', $results)->with('keyword', $keyword);
	}

	public function searchGoogle() {
		$keyword = trim(Input::get('q'));

		return View::make('frontend.home.search-googlecse')->with('keyword', $keyword)->with('cssName', 'home');
	}

	public function highlight($text, $words) {
	    
	    $wordsArray = array();
	    $markedWords = array();
	    // explode the phrase in words
	    $wordsArray = explode(' ', $words); 

	    foreach ($wordsArray as $k => $word) {
	      $markedWords[$k] = '<span class="highlight">' . $word . '</span>';
	    }

	    $text = str_ireplace($wordsArray, $markedWords, $text);

	    //right trows results
	    return $text;
	}

}
