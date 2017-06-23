<?php

class Post extends Eloquent {
	
	protected $table = 'posts';

	public function getSlug() {

		$parent_category = Category::find($this->category_id);

		if( !$parent_category ) {
			return '';
		}

		return '/' . $parent_category->getSlug() . '/post_' . $this->id;
	}

	public function getImageUrl() {
		return asset( Config::get('site.path.upload.image') . '/' . $this->attributes['image_filename'] );
	}

	public function hasImage() {
		return ($this->attributes['image_filename'] != '' && !is_null($this->attributes['image_filename']));
	}

	public function deleteI18nData() {
		return PostI18n::where('post_id', '=', $this->attributes['id'])->delete();
	}

	public function translate($lang_code = '') {
		if($lang_code == '')
		{
			$lang_id = Language::getIdByCode( Config::get('app.locale') );
		}else{
			$lang_id =  Language::getIdByCode($lang_code);
		}


		if( Config::get('site.auto_gb') && $lang_id == Language::getIdByCode('gb') ) {
			$lang_id = Language::getIdByCode('cn');
		}

		$i18n = PostI18n::where('post_id', '=', $this->attributes['id'])
						  ->where('language_id', '=', $lang_id)
						  ->first();
		
		if( Config::get('site.auto_gb') && $i18n && Config::get('app.locale') == 'gb' ) {
			$i18n->title = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->title);
			$i18n->content = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->content);
			$i18n->excerpt = Blupurple\Cn2Gb\Cn2Gb::trans($i18n->excerpt);
		}


		if( !$i18n ) {
			$stdclass = new stdClass();
			$stdclass->title = '';
			$stdclass->description = '';
			$stdclass->content = '';
			$stdclass->excerpt = '';
			$stdclass->image_filename = '';
			return $stdclass;
		}

		return $i18n;
	}


	public function bulkSaveLanguages($attribute, $inputs) {
		foreach( Language::all() as $lang )
		{
			if( isset($inputs[$lang->code]) )
			{
				PostI18n::saveData($this->attributes['id'], $lang->id, $attribute, $inputs[$lang->code]);
			}
		}
	}


	public function getTranslatedCreatedAt() {

		if( Config::get('app.locale') == 'cn' || Config::get('app.locale') == 'gb' ) {

			return date('Y年m月d日', strtotime($this->attributes['created_at']));

		}else{

			return date('Y/m/d', strtotime($this->attributes['created_at']));

		}

	}


	public function getMetaValue($meta_key, $lang = null) {

		$metadata = MetaData::findByMetaKey('post_' . $this->id);

		if( !$metadata ) {
			return '';
		}

		if( Config::get('site.auto_gb') && Config::get('app.locale') == 'gb' ) {
			return Blupurple\Cn2Gb\Cn2Gb::trans( $metadata->getTextValue($meta_key . '__cn') );
		}else{

			if( !is_null($lang) ) {
				return $metadata->getTextValue($meta_key . '__' . $lang);
			}else{
				return $metadata->getTextValue($meta_key . '__' . Config::get('app.locale'));
			}

		}
	}

}