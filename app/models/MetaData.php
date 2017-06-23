<?php

class MetaData extends Eloquent {
	
	protected $table = 'meta_data';


	public static function findByMetaKey($meta_key) {
		return self::where('meta_key', '=', $meta_key)->first();
	}

	public function extractFormData() {

		$fields_data = explode("\n", $this->attributes['meta_fields']);

		$form_data = array();

		$is_i18n = false;

		foreach( $fields_data as $field_data ) {

			$field_data = trim($field_data);

			if( $field_data == '[hidden:title]' ) {

				array_push($form_data, array(
					'type' => 'hidden:title'
				));

				continue;
			}

			if( $field_data == '[hidden:content]' ) {

				array_push($form_data, array(
					'type' => 'hidden:content'
				));

				continue;
			}

			if( $field_data == '[hidden:excerpt]' ) {

				array_push($form_data, array(
					'type' => 'hidden:excerpt'
				));

				continue;
			}

			if( $field_data == '[hidden:image]' ) {

				array_push($form_data, array(
					'type' => 'hidden:image'
				));

				continue;
			}

			if( $field_data == '[hidden:editor]' ) {

				array_push($form_data, array(
					'type' => 'hidden:editor'
				));

				continue;
			}

			if( $field_data == '[hidden:language-independent]' ) {

				array_push($form_data, array(
					'type' => 'hidden:language-independent'
				));

				continue;
			}

			if( $field_data == '[i18n]' ) {
				$is_i18n = true;

				array_push($form_data, array(
					'type' => 'i18n-open'
				));

				continue;
			}

			if( $field_data == '[/i18n]' ) {
				$is_i18n = false;

				array_push($form_data, array(
					'type' => 'i18n-close'
				));

				continue;
			}

			preg_match('/(.*?)\[(.*?)\]/is', $field_data, $matches);

			if( count($matches) != 3 ) {
				// Invalid form data
				continue;
			}

			$name_and_type = explode(',', $matches[2]);

			array_push($form_data, array(
				'title' => $matches[1],
				'name' => $name_and_type[0],
				'type' => $name_and_type[1],
				'i18n' => $is_i18n
			));
		}

		return $form_data;
	}

	public static function saveFormData($inputs, $save_as_new_metakey = null) {

		if( !isset($inputs['__metafield_io']) ) return;

		$metafields = $inputs['__metafield_io'];

		Eloquent::unguard();

		foreach( $metafields as $metakey => $metafield ) {

			$metadata = MetaData::findByMetaKey($metakey);

			if( $metadata ) {

				$is_i18n = false;

				$fields = $metadata->extractFormData();
				$saveData = array();

				foreach( $fields as $field ) {

					$field['type'] = trim($field['type']);

					if( $field['type'] == 'i18n-open' ) {
						$is_i18n = true;
						continue;
					}

					if( $field['type'] == 'i18n-close' ) {
						$is_i18n = false;
						continue;
					}

					if( in_array($field['type'], array('text', 'date', 'textarea')) ) {

						if( $is_i18n ) {

							foreach(Language::getAvailableLanguages() as $lang_index => $lang) {

								$i18n_field_name = $field['name'] . '__' . $lang->code;

								if( isset($metafield[$i18n_field_name]) ) {
									array_push($saveData, array(
										$i18n_field_name => $metafield[$i18n_field_name]
									));
								}
							}

						}else{
							array_push($saveData, array(
								$field['name'] => $metafield[$field['name']]
							));
						}
						
					}

					if( $field['type'] == 'image' ) {

						if( $is_i18n ) {

							foreach(Language::getAvailableLanguages() as $lang_index => $lang) {

								$i18n_field_name = $field['name'] . '__' . $lang->code;

								$image_field_name = '__metafield_io.' . $metakey . '.' . $i18n_field_name;

								// Old data
								$image_file_link = array(
									$i18n_field_name => $metadata->getImageUrl($i18n_field_name)
								);

								if( isset($inputs['__metafield_io'][$metakey][$field['name'] . '_remove__' . $lang->code]) ) {
									$image_file_link = array(
										$i18n_field_name => ''
									);
								}

								$validator = Validator::make($inputs, array(
									$image_field_name => 'sometimes|image'
								));

								if( $validator->fails() ) {
									continue;
								}

								if( Input::hasFile($image_field_name) )
								{

									$filename = str_random(60) . '.' . Input::file($image_field_name)->getClientOriginalExtension();
									Input::file($image_field_name)->move(public_path() . '/' . Config::get('site.path.upload.image'), $filename);

									$filelink = Config::get('site.path.upload.image') . '/' . $filename;

									$image_file_link = array(
										$i18n_field_name => $filelink
									);
								}

								array_push($saveData, $image_file_link);
							}


						}else{

							$image_field_name = '__metafield_io.' . $metakey . '.' . $field['name'];

							// Old data
							$image_file_link = array(
								$field['name'] => $metadata->getImageUrl($field['name'])
							);

							if( isset($inputs['__metafield_io'][$metakey][$field['name'] . '_remove']) ) {
								$image_file_link = array(
									$field['name'] => ''
								);
							}

							$validator = Validator::make($inputs, array(
								$image_field_name => 'sometimes|image'
							));

							if( $validator->fails() ) {
								continue;
							}

							if( Input::hasFile($image_field_name) )
							{
								$filename = str_random(60) . '.' . Input::file($image_field_name)->getClientOriginalExtension();
								Input::file($image_field_name)->move(public_path() . '/' . Config::get('site.path.upload.image'), $filename);

								$filelink = Config::get('site.path.upload.image') . '/' . $filename;

								$image_file_link = array(
									$field['name'] => $filelink
								);
							}

							array_push($saveData, $image_file_link);
						}
					}

				}

				if( !is_null($save_as_new_metakey) ) {

					// Clone the existing metadata and save as new
					$new_metadata = new MetaData;
					$new_metadata->meta_key = $save_as_new_metakey;
					$new_metadata->meta_fields = $metadata->meta_fields;
					$new_metadata->data = json_encode($saveData);
					$new_metadata->save();

				}else{
					$metadata->data = json_encode($saveData);
					$metadata->save();
				}

			}
		}
	}

	public function getTextValue($name) {

		if( !$this->attributes['data'] ) return '';

		$json_data = json_decode($this->attributes['data'], true);

		foreach( $json_data as $one_data ) {
			if( isset($one_data[$name]) ) return $one_data[$name];
		}

		return '';
	}

	public function getImageUrl($name) {
		return $this->getTextValue($name);
	}


}