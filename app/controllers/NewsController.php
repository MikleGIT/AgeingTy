<?php

class NewsController extends \BaseController {

	
	public function index($slug) {

		return 'News: ' . $slug;
	}


}
