<?php

class BackendCategoryController extends \BaseController {

	
	public function ajaxCreate() {

		$category_name = Input::get('create_category_name');
		$category_slug = Input::get('create_category_slug');
		$type = Input::get('type');
		$parent = Input::get('parent');

		if( !in_array($type, array('page', 'post')) ) return Response::json(array('status' => 0, 'message' => 'Invalid type.'));

		$parent_category = Category::findBySlug($parent);

		if( !$parent_category ) return Response::json(array('status' => 0, 'message' => 'Invalid category.'));

		if( !in_array($type, $parent_category->getAllowAddType()) ) return Response::json(array('status' => 0, 'message' => 'Requested type is disallowed.'));

		$sub_categories = $parent_category->subCategories();

		$validator = Validator::make(array(
			'slug' => $category_slug
		), array(
			'slug' => 'required|regex:/^[A-Za-z0-9]+$/'
		));

		if( $validator->fails() ) {
			return Response::json(array('status' => 0, 'field' => 'slug', 'message' => 'Must be A-Z, a-z or 0-9 characters.'));
		}


		$validator = Validator::make(array(
			'name' => $category_name[Config::get('site.main_lang')]
		), array(
			'name' => 'required'
		));

		if( $validator->fails() ) {
			return Response::json(array('status' => 0, 'field' => 'name', 'message' => 'Category name must be provided'));
		}

		$slug_prefix = '';

		if( count($sub_categories) > 0 ) {
			$slug_parts = explode('/', $sub_categories[0]->slug);

			if( is_array($slug_parts) && count($slug_parts) > 1 )
			{
				unset($slug_parts[count($slug_parts) - 1]);
				$slug_prefix = join('/', $slug_parts);
			}else{
				$slug_prefix = $sub_categories[0]->slug;
			}
			
		}else{
			$slug_parts = explode('/', $parent_category->slug);
			
			if( is_array($slug_parts) && count($slug_parts) > 1 )
			{
				unset($slug_parts[count($slug_parts) - 1]);
				$slug_prefix = join('/', $slug_parts);
			}else{
				$slug_prefix = $parent_category->slug;
			}
		}

		$slug = $slug_prefix . '/' . $category_slug;



		$validator = Validator::make(array(
			'slug' => $slug
		), array(
			'slug' => 'required|unique:categories,slug'
		));

		if( $validator->fails() ) {
			return Response::json(array('status' => 0, 'field' => 'slug', 'message' => 'Must be unique.'));
		}


		$new_category = new Category;
		$new_category->parent_id = $parent_category->id;
		$new_category->slug = $slug; //
		$new_category->type = $type;
		$new_category->section = $parent_category->section;
		$new_category->url = null;
		$new_category->image_filename = null;
		$new_category->allow_add_type = !is_null($parent_category->allow_sub_add_type) ? $parent_category->allow_sub_add_type : null;

		// If the parent category allows to create more category, suppose subcategories can inherit metadata too.
		if( !is_null($parent_category->allow_sub_add_type) ) {
			$new_category->inherit_meta_values = $parent_category->inherit_meta_values;
		}

		$new_category->sorting = $parent_category->getSubCategoriesBiggestSortNumber() + 10; //
		$new_category->save();

		$new_category->bulkSaveLanguages('name', $category_name);


		// Inherit meta data settings from parent category if that defined
		if( !is_null($parent_category->inherit_meta_values) && $parent_category->inherit_meta_values != '' ) {
			$meta_data = new MetaData;
			$meta_data->meta_key = 'category_' . $new_category->id;
			$meta_data->meta_fields = $parent_category->inherit_meta_values;
			$meta_data->save();
		}


		if( $type == 'page' ) {
			return Response::json(array('status' => 1, 'message' => 'Category has been created.', 'redirect' => action('BackendPageController@edit', array($new_category->getFilteredSlug()))));
		}elseif( $type == 'post' ) {
			return Response::json(array('status' => 1, 'message' => 'Category has been created.', 'redirect' => action('BackendPostController@postlist', array($new_category->getFilteredSlug()))));
		}
	}



	public function edit($slug) {

		$category = Category::findBySlug($slug);

		if( !$category ) return Redirect::action('BackendController@index');

		View::share('backend_category_id', $category->getRootCategoryId());
		View::share('backend_current_category_id', $category->id);
		View::share('backend_category', $category->getRootCategory());
		View::share('backend_current_category', $category);

		return View::make('backend.category.edit')->with('category', $category);
	}

	public function postEdit($slug) {
		$category = Category::findBySlug($slug);
		
		if( !$category ) return Redirect::action('BackendController@index');

		$inputs = Input::all();

		$validator = Validator::make(array(
			//'slug' => $inputs['slug'],
			'is_hidden' => $inputs['is_hidden'],
			'name.' . Config::get('site.main_lang') => $inputs['name'][Config::get('site.main_lang')]
		), array(
			//'slug' => 'required|regex:/^[A-Za-z0-9]+$/',
			'is_hidden' => 'required',
			'name.' . Config::get('site.main_lang') => 'required'
		), array(
			//'slug.regex' => 'Must be A-Z, a-z or 0-9 characters.',
			'is_hidden.required' => 'The value of is_hidden is either true or false',
			'name.required' => 'Category name must be provided'
		));

		if( $validator->fails() ) {
			return Redirect::action('BackendCategoryController@edit', array($category->getFilteredSlug()))->withInput($inputs)->withErrors($validator);	
		}

		// $slug_prefix = '';

		// $slug_parts = explode('/', $category->slug);
		
		// if( is_array($slug_parts) && count($slug_parts) > 1 )
		// {
		// 	unset($slug_parts[count($slug_parts) - 1]);
		// 	$slug_prefix = join('/', $slug_parts);
		// }else{
		// 	$slug_prefix = $category->slug;
		// }

		// $slug = $slug_prefix . '/' . $inputs['slug'];


		// $validator = Validator::make(array(
		// 	'slug' => $slug
		// ), array(
		// 	'slug' => 'required|unique:categories,slug,' . $category->id
		// ), array(
		// 	'slug.unique' => 'Must be unique.'
		// ));

		if( $validator->fails() ) {
			return Redirect::action('BackendCategoryController@edit', array($category->getFilteredSlug()))->withInput($inputs)->withErrors($validator);	
		}

		$category->is_hidden = ($inputs['is_hidden'] == '1') ? true : false;
		//$category->slug = $slug;
		$category->save();

		$category->bulkSaveLanguages('name', $inputs['name']);

		return Redirect::action('BackendCategoryController@edit', array($category->getFilteredSlug()))->with('success', true);

	}


	public function delete($slug) {

		$category = Category::findBySlug($slug);
		
		if( !$category ) return Redirect::action('BackendController@index');

		Eloquent::unguard();

		foreach( $category->getPosts() as $post ) {
			$post->deleteI18nData();
			$post->delete();
		}

		foreach( Page::where('category_id', '=', $category->id)->get() as $page ) {
			$page->deleteI18nData();
			$page->delete();
		}

		$category->deleteI18nData();
		$section = $category->section;
		$category->delete();

		if( $section ) {
			return Redirect::action('BackendSectionController@index', array($section));
		}else{
			return Redirect::action('BackendController@index');
		}
	}


	public function order($slug) {

		$category = Category::findBySlug($slug);
		
		if( !$category ) return Redirect::action('BackendController@index');

		View::share('backend_category_id', $category->getRootCategoryId());
		View::share('backend_current_category_id', $category->id);
		View::share('backend_category', $category->getRootCategory());
		View::share('backend_current_category', $category);

		return View::make('backend.category.order')->with('category', $category);
	}


	public function postOrder($slug) {

		$category = Category::findBySlug($slug);
		
		if( !$category ) return Redirect::action('BackendController@index');

		Eloquent::unguard();

		$sorting = Input::get('sorting');

		foreach( $sorting as $category_id => $index ) {
			$the_category = Category::find($category_id);

			if( $the_category ) {
				$the_category->sorting = $index * 10;
				$the_category->save();
			}
		}

		return Redirect::action('BackendCategoryController@order', array($category->getFilteredSlug()))->with('success', true);
	}



}
