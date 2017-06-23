<?php

class Category extends Eloquent {

	protected $table = 'categories';


	public static function findBySlug($slug) {
		if( strpos($slug, ':') ) {
			$slug = str_replace(':', '/', $slug);
		}

		return self::where('slug', '=', $slug)->first();
	}

	public static function findRootBySection($section) {
		return self::whereNull('parent_id')->where('section', '=', $section)->first();
	}

	public static function getIdBySlug($slug) {
		if( strpos($slug, ':') ) {
			$slug = str_replace(':', '/', $slug);
		}

		$category = self::where('slug', '=', $slug)->first();

		if( !$category ) return 0;

		return $category->id;
	}

	public function typePage() {
		return ($this->attributes['type'] == 'page');
	}

	public function typePost() {
		return ($this->attributes['type'] == 'post');
	}

	public function typeLink() {
		return ($this->attributes['type'] == 'link');
	}

	public function typeModule() {
		return ($this->attributes['type'] == 'module');
	}

	public function getAllowAddType() {
		if( is_null($this->attributes['allow_add_type']) ) return array();

		return explode(',', $this->attributes['allow_add_type']);
	}

	public function isAllowAddPost() {
		return in_array('post', $this->getAllowAddType());
	}

	public function isAllowAddPage() {
		return in_array('page', $this->getAllowAddType());
	}

	public function getSlugLastComponent() {
		$slug_parts = explode('/', $this->attributes['slug']);

		return end($slug_parts);
	}

	public function deleteI18nData() {
		return CategoryI18n::where('category_id', '=', $this->attributes['id'])->delete();
	}

	public function getPage() {
		if( $this->attributes['type'] != 'page' ) return null;

		Eloquent::unguard();

		$page = Page::where('category_id', '=', $this->attributes['id'])->first();

		if( !$page ) {
			$page = Page::create(array(
                'category_id' => $this->attributes['id'],
                'user_id' => (Auth::check()) ? Auth::user()->id : 0
            ));

			$empty_language_data = array();
			$title = array();

			foreach( Language::getAvailableLanguages() as $lang ) {
				$empty_language_data[$lang->code] = '';
				$title[$lang->code] = $this->translate($lang->code)->name;
			}

            $page->bulkSaveLanguages('title', $title);
            $page->bulkSaveLanguages('content', $empty_language_data);
            $page->bulkSaveLanguages('excerpt', $empty_language_data);
		}

		return $page;
	}

	public function getPostById($id) {
		return Post::where('category_id', '=', $this->attributes['id'])->where('id', '=', $id)->first();
	}

	public function getPosts($pagination = 0) {

		if( count($this->subCategories()) ) {
			$posts = $this->getAllSubcategoriesPosts($pagination);
		}else{
			$posts = Post::where('category_id', '=', $this->attributes['id'])->orderBy('created_at', 'DESC');
			$posts = $pagination > 0 ? $posts->paginate($pagination) : $posts->get();
		}

		return $posts;
	}

	public function getOnePost() {

		if( count($this->subCategories()) ) {
			$posts = $this->getAllSubcategoriesPosts();
		}else{
			$posts = Post::where('category_id', '=', $this->attributes['id'])->orderBy('created_at', 'DESC')->get();
		}

		if( count($posts) > 0 ) {
			return $posts[0];
		}else{
			return null;
		}
	}

	public function getPostsExcept($post_id, $limit = 2) {

		if( count($this->subCategories()) ) {
			$posts = $this->getAllSubcategoriesPostsExcept($post_id, $limit);
		}else{
			$posts = Post::where('category_id', '=', $this->attributes['id'])->where('id', '!=', $post_id)->orderBy('created_at', 'DESC')->limit($limit)->get();
		}

		return $posts;
	}

	public function getRootCategoryId() {

		if( !$this->attributes['parent_id'] ) return $this->attributes['id'];

		$root_category_id = $this->attributes['parent_id'];

		$i = 0;

		Eloquent::unguard();

		while( true ) {
			$root_category = self::where('id', '=', $root_category_id)->first();

			if( !$root_category || !$root_category->parent_id ) break;

			$root_category_id = $root_category->parent_id;
		}

		return $root_category_id;
	}

	public function getRootCategory() {
		return self::find($this->getRootCategoryId());
	}

	public function getParentCategory() {

		if( !is_null($this->attributes['parent_id']) ) {
			return self::find($this->attributes['parent_id']);
		}else{
			return null;
		}
	}

	public function getSlug() {
		return $this->attributes['slug'];
	}

	public function getFilteredSlug() {
		return str_replace('/', ':', $this->attributes['slug']);
	}

	public function getSlugTemplateName() {
		return str_replace('/', '.', $this->attributes['slug']);
	}

	public static function getRootCategories() {
		return self::whereNull('parent_id')->orderBy('sorting', 'ASC')->get();
	}

	public static function isRoot() {
		return is_null($this->attributes['parent_id']);
	}

	public static function getSubCategories($category_id = 0, $show_hidden = false) {
		$query = self::where('parent_id', '=', $category_id);

		if( !$show_hidden ) {
			$query = $query->where('is_hidden', '=', false);
		}

		return $query->orderBy('sorting', 'ASC')->get();
	}

	public static function hasSubCategories($category_id = 0, $show_hidden = false) {
		$query = self::where('parent_id', '=', $category_id);

		if( !$show_hidden ) {
			$query = $query->where('is_hidden', '=', false);
		}

		return ($query->orderBy('sorting', 'ASC')->count() > 0);
	}

	public function subCategories($show_hidden = false) {
		$query = self::where('parent_id', '=', $this->attributes['id']);

		if( !$show_hidden ) {
			$query = $query->where('is_hidden', '=', false);
		}

		return $query->orderBy('sorting', 'ASC')->get();
	}

	public function getSubCategoriesBiggestSortNumber($show_hidden = false) {
		$category = self::where('parent_id', '=', $this->attributes['id']);

		if( !$show_hidden ) {
			$category = $category->where('is_hidden', '=', false);
		}

		$category = $category->orderBy('sorting', 'DESC')->first();

		if( !$category ) return 0;

		return $category->sorting;
	}


	public function getAllSubcategoriesPosts($pagination = 0) {

		$subcat_ids = array(0);

		// Current Category
		array_push($subcat_ids, $this->attributes['id']);

		foreach( $this->subCategories() as $subcategory ) {
			array_push($subcat_ids, $subcategory->id);

			foreach( $subcategory->subCategories() as $subsubcategory ) {
				array_push($subcat_ids, $subsubcategory->id);

				foreach ($subsubcategory->subCategories() as $category) {
					array_push($subcat_ids, $category->id);
				}
			}
		}

		$posts = Post::whereIn('category_id', $subcat_ids)->orderBy('created_at', 'DESC');
		$posts = $pagination > 0 ? $posts->paginate($pagination) : $posts->get();

		return $posts;
	}

	public function getAllSubcategoriesPostsExcept($post_id, $limit = 2) {

		$subcat_ids = array(0);

		foreach( $this->subCategories() as $subcategory ) {
			array_push($subcat_ids, $subcategory->id);
		}

		$posts = Post::whereIn('category_id', $subcat_ids)->where('id', '!=', $post_id)->orderBy('created_at', 'DSEC')->limit($limit)->get();

		return $posts;
	}


	public function translate($lang_code = '') {
		if($lang_code == '')
		{
			$lang_id = Language::getIdByCode( Config::get('app.locale') );
		}else{
			$lang_id =  Language::getIdByCode($lang_code);
		}


		if( Config::get('site.auto_gb') && $lang_id == Language::getIdByCode('gb') ) {
			$lang_code = 'cn';
			$lang_id = Language::getIdByCode('cn');
		}

		$i18n = CategoryI18n::where('category_id', '=', $this->attributes['id'])
							->where('language_id', '=', $lang_id)
							->first();

		if( Config::get('site.auto_gb') && $i18n && Config::get('app.locale') == 'gb' ) {
			$i18n->name = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->name);
		}

		return $i18n;
	}


	public function bulkSaveLanguages($attribute, $inputs) {
		foreach( Language::all() as $lang )
		{
			if( isset($inputs[$lang->code]) )
			{
				CategoryI18n::saveData($this->attributes['id'], $lang->id, $attribute, $inputs[$lang->code]);
			}
		}
	}

	public function cssName() {

		switch( $this->section ) {

			case 'consult':
				return 'advisory';
			case 'course':
				return 'learning';
			case 'health':
				return 'health';
			case 'event':
				return 'event';
			case 'service':
				return 'service';
			case 'discount':
				return 'benefits';
			case 'news':
				return 'news';
			case 'contact':
				return 'contact';
			case 'about':
				return 'intro';
		}

	}


	public function getSubCategoriesForSelect() {

		$categories = self::getSubCategories($this->attributes['id']);

		$results = array();

		foreach( $categories as $category ) {
			$results[$category->id] = $category->translate()->name;
		}

		return $results;
	}




}