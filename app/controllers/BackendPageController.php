<?php

class BackendPageController extends \BaseController {
	
	public $category;

	public function __construct() {
		
		$this_instance = $this;

		$this->beforeFilter(function() use ($this_instance) {

			$params = Route::current()->parameters();
			if( !isset($params['slug']) ) return Redirect::action('BackendController@index');

			$category = Category::findBySlug($params['slug']);

			if( !$category ) return Redirect::action('BackendController@index');

			$this_instance->category = $category;

			View::share('backend_category_id', $category->getRootCategoryId());
			View::share('backend_current_category_id', $category->id);
			View::share('backend_category', $category->getRootCategory());
			View::share('backend_current_category', $category);
		});
	}

	public function edit($slug) {

		$page = $this->category->getPage();

		return View::make('backend.page.edit')->with('category', $this->category)->with('page', $page);
	}

	public function postEdit($slug) {

		$page = $this->category->getPage();

		$inputs = Input::all();

		$page->bulkSaveLanguages('title', $inputs['title']);
		$page->bulkSaveLanguages('content', $inputs['content']);
		$page->bulkSaveLanguages('excerpt', $inputs['excerpt']);

		MetaData::saveFormData(Input::all());

		return Redirect::action('BackendPageController@edit', array($this->category->getFilteredSlug()))->with('success', true);
	}


}
