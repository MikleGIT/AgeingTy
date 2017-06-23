<?php

class PostController extends \BaseController {

	public $category;
	public $post_id;

	public function __construct() {

		$this_instance = $this;

		$this->beforeFilter(function() use ($this_instance) {
			$params = Route::current()->parameters();
			if( !isset($params['slug']) ) return App::abort(404);

			if( preg_match('/:post\_(\d+)$/', $params['slug']) ) {
				preg_match('/:post\_(\d+)$/', $params['slug'], $matches);

				$this->post_id = $matches[1];

				$params['slug'] = preg_replace('/:post\_\d+/', '', $params['slug']);
			}

			$category = Category::findBySlug($params['slug']);

			if( !$category ) return App::abort(404);

			$this_instance->category = $category;

			View::share('frontend_category_id', $category->getRootCategoryId());
			View::share('frontend_current_category_id', $category->id);
			View::share('frontend_category', $category->getRootCategory());
			View::share('frontend_current_category', $category);

			if( isset($this->post_id) ) {
				View::share('frontend_current_post_id', $this->post_id);

				$current_post = Post::find($this->post_id);

				if( $current_post ) {
					View::share('frontend_current_post', $current_post);
				}
			}

			View::share('cssName', $category->cssName());
		});
	}


	public function index($slug)
	{
		//

		// Should load single template
		if( isset($this->post_id) && View::exists('frontend.post.' . $this->category->getRootCategory()->getFilteredSlug() . '.single') ) {
			return View::make('frontend.post.' . $this->category->getRootCategory()->getFilteredSlug() . '.single');
		}

		if( View::exists('frontend.post.' . $this->category->getSlugTemplateName()) ) {
			return View::make('frontend.post.' . $this->category->getSlugTemplateName());
		}else{
			// Return page root category's common template
			return View::make('frontend.post.' . $this->category->getRootCategory()->getFilteredSlug() . '.common');
		}
	}


}
