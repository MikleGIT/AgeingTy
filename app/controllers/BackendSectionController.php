<?php

class BackendSectionController extends \BaseController {

	public $category;

	public function __construct() {
		
		$this_instance = $this;

		$this->beforeFilter(function() use ($this_instance) {

			$params = Route::current()->parameters();
			if( !isset($params['section']) ) return Redirect::action('BackendController@index');

			$category = Category::findRootBySection($params['section']);

			if( !$category ) return Redirect::action('BackendController@index');

			$this_instance->category = $category;

			View::share('backend_category_id', $category->getRootCategoryId());
			View::share('backend_current_category_id', $category->id);
			View::share('backend_category', $category->getRootCategory());
			View::share('backend_current_category', $category);
		});
	}

	public function index($section) {

		if( $this->category->typeLink() && $this->category->url ) {

			$category_to_go = Category::findBySlug($this->category->url);

			if( !$category_to_go ) return Redirect::action('BackendController@index');

			if( $category_to_go->typePost() ) {
				return Redirect::action('BackendPostController@postlist', array($category_to_go->getFilteredSlug()));
			}else if( $category_to_go->typePage() ) {
				return Redirect::action('BackendPageController@edit', array($category_to_go->getFilteredSlug()));
			}

		}else if( $this->category->typePage() ) {
			return Redirect::action('BackendPageController@edit', array($this->category->getFilteredSlug()));
		}else if( $this->category->typePost() ) {
			return Redirect::action('BackendPostController@postlist', array($this->category->getFilteredSlug()));
		}else if( $this->category->typeModule() ) {
			
		}

		return View::make('backend.section.index');
	}


}
