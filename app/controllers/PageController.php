<?php

class PageController extends \BaseController {

	public $category;

	public function __construct() {

		$this_instance = $this;

		$this->beforeFilter(function() use ($this_instance) {
			$params = Route::current()->parameters();
			if( !isset($params['slug']) ) return App::abort(404);

			$category = Category::findBySlug($params['slug']);

			if( !$category ) return App::abort(404);

			$this_instance->category = $category;

			View::share('frontend_category_id', $category->getRootCategoryId());
			View::share('frontend_current_category_id', $category->id);
			View::share('frontend_category', $category->getRootCategory());
			View::share('frontend_current_category', $category);

			View::share('cssName', $category->cssName());
		});
	}


	public function index($slug)
	{
		//

		if( View::exists('frontend.page.' . $this->category->getSlugTemplateName()) ) {
			return View::make('frontend.page.' . $this->category->getSlugTemplateName());
		}else{
			// Return page root category's common template
			return View::make('frontend.page.' . $this->category->getRootCategory()->getFilteredSlug() . '.common');
		}
	}

}
