<?php

class BackendPostController extends \BaseController {

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

	public function postlist($slug) {

		$posts = $this->category->getPosts();

		return View::make('backend.post.list')->with('category', $this->category)->with('posts', $posts);
	}


	public function create($slug) {

		return View::make('backend.post.create')->with('category', $this->category);
	}

	public function postCreate($slug) {

		$inputs = Input::all();
		
		$post = new Post;
		$post->category_id = $this->category->id;
		$post->user_id = Auth::user()->id;

		$validator = Validator::make($inputs, array(
			'image' => 'sometimes|image'
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendPostController@create', array($slug))->withInput($inputs)->withErrors($validator);
		}

		if( Input::hasFile('image') ) {

			$filename = str_random(30) . '.' . Input::file('image')->getClientOriginalExtension();
			Input::file('image')->move(public_path() . '/' . Config::get('site.path.upload.image'), $filename);

			$post->image_filename = $filename;
		}

		$post->save();

		$post->bulkSaveLanguages('title', $inputs['title']);
		$post->bulkSaveLanguages('content', $inputs['content']);
		$post->bulkSaveLanguages('excerpt', $inputs['excerpt']);

		MetaData::saveFormData(Input::all(), 'post_' . $post->id);

		return Redirect::action('BackendPostController@edit', array($slug, $post->id))->with('success', true);
	}

	
	public function edit($slug, $id) {

		$post = $this->category->getPostById($id);

		if( !$post ) return Redirect::action('BackendPostController@postlist', array($slug));

		return View::make('backend.post.edit')->with('category', $this->category)->with('post', $post);
	}

	public function postEdit($slug, $id) {

		$inputs = Input::all();
		
		$post = $this->category->getPostById($id);
		if( !$post ) return Redirect::action('BackendPostController@postlist', array($slug));

		// $post->category_id = $this->category->id;
		$post->user_id = Auth::user()->id;

		$validator = Validator::make($inputs, array(
			'image' => 'sometimes|image'
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendPostController@edit', array($slug, $id))->withInput($inputs)->withErrors($validator);
		}

		if( isset($inputs['remove_image']) ) {
			$post->image_filename = '';
		}

		if( Input::hasFile('image') ) {

			$filename = str_random(30) . '.' . Input::file('image')->getClientOriginalExtension();
			Input::file('image')->move(public_path() . '/' . Config::get('site.path.upload.image'), $filename);

			$post->image_filename = $filename;
		}

		if( isset($inputs['created_at']) ) $post->created_at = $inputs['created_at'];
		$post->save();

		$post->bulkSaveLanguages('title', $inputs['title']);
		$post->bulkSaveLanguages('content', $inputs['content']);
		$post->bulkSaveLanguages('excerpt', $inputs['excerpt']);

		MetaData::saveFormData(Input::all());

		return Redirect::action('BackendPostController@edit', array($slug, $id))->with('success', true);
	}

	public function delete($slug, $id) {

		$post = $this->category->getPostById($id);
		if( !$post ) return Redirect::action('BackendPostController@postlist', array($slug));

		$post->delete();

		return Redirect::action('BackendPostController@postlist', array($slug));
	}

	public function postBatchDelete($slug) {

		$inputs = Input::all();

		if( isset($inputs['delete_posts']) ) {

			Eloquent::unguard();

			foreach( $inputs['delete_posts'] as $post_id ) {

				$post = $this->category->getPostById($post_id);
				if( $post ) $post->delete();
			}
		}

		return Redirect::action('BackendPostController@postlist', array($slug));
	}


}
