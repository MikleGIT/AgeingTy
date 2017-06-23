<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('LanguageTableSeeder');
		$this->call('CategoryTableSeeder');
	}

}



class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create(array(
        	'username' => 'admin',
        	'password' => Hash::make('ageing2015')
        ));
    }
}


class LanguageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('languages')->truncate();

        Language::create(array(
        	'code' => 'cn',
        	'name' => '繁體中文'
        ));

        Language::create(array(
        	'code' => 'gb',
        	'name' => '简体中文'
        ));

        Language::create(array(
        	'code' => 'en',
        	'name' => 'English'
        ));

        Language::create(array(
        	'code' => 'pt',
        	'name' => 'Português'
        ));
    }
}


class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->truncate();


        $categories = array(
        	//
        	array(
        		'cn' => '養老保障機制諮詢專頁',
        		'gb' => '养老保障机制谘询专页',
        		'type' => 'link',
                'section' => 'consult',
        		'url' => 'consult/intro',
        		'slug' => 'consult',
                'allow_add_type' => 'page',
        		'subcategories' => array(
        			array(
        				'cn' => '前言',
        				'gb' => '前言',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/intro',
        			),
        			array(
        				'cn' => '人口老化挑戰',
        				'gb' => '人口老化挑战',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/challenge',
        			),
        			array(
        				'cn' => '建構澳門養老保障機制',
        				'gb' => '建构澳门养老保障机制',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/construction',
        			),
        			array(
        				'cn' => '理念原則',
        				'gb' => '理念原则',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/principle',
        			),
        			array(
        				'cn' => '醫社服務',
        				'gb' => '医社服务',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/health',
        			),
        			array(
        				'cn' => '權益保障',
        				'gb' => '权益保障',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/rights',
        			),
        			array(
        				'cn' => '社會參與',
        				'gb' => '社会参与',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/society',
        			),
        			array(
        				'cn' => '生活環境',
        				'gb' => '生活环境',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/living',
        			),
        			array(
        				'cn' => '協作、推行與評檢',
        				'gb' => '协作丶推行与评检',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/cooperation',
        			),
        			array(
        				'cn' => '諮詢文本下載',
        				'gb' => '谘询文本下载',
        				'type' => 'page',
                        'section' => 'consult',
		        		'url' => null,
		        		'slug' => 'consult/documents',
        			),

        		)
        	),

			//
			array(
        		'cn' => '學習',
        		'gb' => '学习',
        		'type' => 'link',
                'section' => 'course',
        		'url' => 'education/courses',
        		'slug' => 'education',
                'allow_add_type' => 'page',
        		'subcategories' => array(
        			array(
        				'cn' => '課程資訊',
        				'gb' => '课程资讯',
        				'type' => 'page',
                        'section' => 'course',
		        		'url' => null,
		        		'slug' => 'education/courses',
                        'allow_add_type' => 'post',
		        		'subcategories' => array(
		        			array(
		        				'cn' => '文化',
		        				'gb' => '文化',
		        				'type' => 'post',
                                'section' => 'course',
				        		'url' => null,
				        		'slug' => 'education/courses/culture',
		        			),
		        			array(
		        				'cn' => '藝術',
		        				'gb' => '艺术',
		        				'type' => 'post',
                                'section' => 'course',
				        		'url' => null,
				        		'slug' => 'education/courses/art',
		        			),
		        			array(
		        				'cn' => '運動',
		        				'gb' => '运动',
		        				'type' => 'post',
                                'section' => 'course',
				        		'url' => null,
				        		'slug' => 'education/courses/sport',
		        			),
		        			array(
		        				'cn' => '養生',
		        				'gb' => '养生',
		        				'type' => 'post',
                                'section' => 'course',
				        		'url' => null,
				        		'slug' => 'education/courses/health',
		        			),
		        			array(
		        				'cn' => '科技',
		        				'gb' => '科技',
		        				'type' => 'post',
                                'section' => 'course',
				        		'url' => null,
				        		'slug' => 'education/courses/technology',
		        			),
		        			array(
		        				'cn' => '其他',
		        				'gb' => '其他',
		        				'type' => 'post',
                                'section' => 'course',
				        		'url' => null,
				        		'slug' => 'education/courses/other',
		        			),
		        		)
        			),
        			array(
        				'cn' => '學習小貼士',
        				'gb' => '学习小贴士',
        				'type' => 'page',
                        'section' => 'course',
		        		'url' => null,
		        		'slug' => 'education/tips',
        			),
        			array(
        				'cn' => '通訊錄',
        				'gb' => '通讯录',
        				'type' => 'page',
                        'section' => 'course',
		        		'url' => null,
		        		'slug' => 'education/phonebook',
        			),
        		)
        	),
			//
			array(
        		'cn' => '健康',
        		'gb' => '健康',
        		'type' => 'link',
                'section' => 'health',
        		'url' => 'health/news',
        		'slug' => 'health',
                'allow_add_type' => 'post',
        		'subcategories' => array(
        			array(
        				'cn' => '長者健聞',
        				'gb' => '长者健闻',
        				'type' => 'post',
                        'section' => 'health',
		        		'url' => null,
		        		'slug' => 'health/news',
        			),
        			array(
        				'cn' => '疾病知識',
        				'gb' => '疾病知识',
        				'type' => 'post',
                        'section' => 'health',
		        		'url' => null,
		        		'slug' => 'health/disease',
        			),
        			array(
        				'cn' => '保健貼士',
        				'gb' => '保健贴士',
        				'type' => 'post',
                        'section' => 'health',
		        		'url' => null,
		        		'slug' => 'health/tips',
        			),
        			array(
        				'cn' => '講座資訊',
        				'gb' => '讲座资讯',
        				'type' => 'post',
                        'section' => 'health',
		        		'url' => null,
		        		'slug' => 'health/info',
        			),
        		)
        	),
			//
			array(
        		'cn' => '活動',
        		'gb' => '活动',
        		'type' => 'link',
                'section' => 'event',
        		'url' => 'event/art',
        		'slug' => 'event',
                'allow_add_type' => 'post',
        		'subcategories' => array(
        			array(
        				'cn' => '文化藝術',
        				'gb' => '文化艺术',
        				'type' => 'post',
                        'section' => 'event',
		        		'url' => null,
		        		'slug' => 'event/art',
        			),
        			array(
        				'cn' => '健康養生',
        				'gb' => '健康养生',
        				'type' => 'post',
                        'section' => 'event',
		        		'url' => null,
		        		'slug' => 'event/health',
        			),
        			array(
        				'cn' => '娛樂休閒',
        				'gb' => '娱乐休闲',
        				'type' => 'post',
                        'section' => 'event',
		        		'url' => null,
		        		'slug' => 'event/entertainment',
        			),
        			array(
        				'cn' => '其他',
        				'gb' => '其他',
        				'type' => 'post',
                        'section' => 'event',
		        		'url' => null,
		        		'slug' => 'event/other',
        			),
        		)
        	),
			//
			array(
        		'cn' => '服務',
        		'gb' => '服务',
        		'type' => 'link',
                'section' => 'service',
        		'url' => 'service/healthcare',
        		'slug' => 'service',
                'allow_add_type' => 'page',
        		'subcategories' => array(
        			array(
        				'cn' => '健康照顧',
        				'gb' => '健康照顾',
        				'type' => 'page',
                        'section' => 'service',
		        		'url' => null,
		        		'slug' => 'service/healthcare',
        			),
        			array(
        				'cn' => '經濟支持',
        				'gb' => '经济支持',
        				'type' => 'page',
                        'section' => 'service',
		        		'url' => null,
		        		'slug' => 'service/economics',
        			),
        			array(
        				'cn' => '房屋政策',
        				'gb' => '房屋政策',
        				'type' => 'page',
                        'section' => 'service',
		        		'url' => null,
		        		'slug' => 'service/housing',
        			),
        			array(
        				'cn' => '文娛休閒',
        				'gb' => '文娱休闲',
        				'type' => 'page',
                        'section' => 'service',
		        		'url' => null,
		        		'slug' => 'service/entertainment',
        			),
        			array(
        				'cn' => '日常生活',
        				'gb' => '日常生活',
        				'type' => 'page',
                        'section' => 'service',
		        		'url' => null,
		        		'slug' => 'service/living',
        			),
        			array(
        				'cn' => '其他',
        				'gb' => '其他',
        				'type' => 'page',
                        'section' => 'service',
		        		'url' => null,
		        		'slug' => 'service/other',
        			),
        		)
        	),
			//
			array(
        		'cn' => '優惠',
        		'gb' => '优惠',
        		'type' => 'page',
                'section' => 'discount',
        		'url' => null,
        		'slug' => 'discount',
                'allow_add_type' => 'post',
        		'subcategories' => array(
        			array(
        				'cn' => '衣',
        				'gb' => '衣',
        				'type' => 'post',
                        'section' => 'discount',
		        		'url' => null,
		        		'slug' => 'discount/clothing',
        			),
        			array(
        				'cn' => '食',
        				'gb' => '食',
        				'type' => 'post',
                        'section' => 'discount',
		        		'url' => null,
		        		'slug' => 'discount/dining',
        			),
        			array(
        				'cn' => '住',
        				'gb' => '住',
        				'type' => 'post',
                        'section' => 'discount',
		        		'url' => null,
		        		'slug' => 'discount/living',
        			),
        			array(
        				'cn' => '行',
        				'gb' => '行',
        				'type' => 'post',
                        'section' => 'discount',
		        		'url' => null,
		        		'slug' => 'discount/outgoing',
        			),
        		)
        	),
        	//
			array(
        		'cn' => '新聞',
        		'gb' => '新闻',
        		'type' => 'post',
                'section' => 'news',
        		'url' => null,
        		'slug' => 'news',
                'allow_add_type' => 'post',
        	),
        	//
        	array(
        		'cn' => '意見',
        		'gb' => '意见',
        		'type' => 'module',
                'section' => 'feedback',
        		'url' => 'app/feedback',
        		'slug' => 'feedback',
        	),
        	//
        	array(
        		'cn' => '聯絡我們',
        		'gb' => '联络我们',
        		'type' => 'module',
                'section' => 'contact',
        		'url' => 'app/contact',
        		'slug' => 'contact',
        	),
        );




		foreach($categories as $category_index => $category) {

			//
	        $root_category = Category::create(array(
	        	'parent_id' => null,
	        	'slug' => $category['slug'],
	        	'type' => $category['type'],
                'section' => $category['section'],
	        	'url' => $category['url'],
                'allow_add_type' => (isset($category['allow_add_type'])) ? $category['allow_add_type'] : null,
	        	'sorting' => $category_index * 10
	        ));

	        $category['en'] = '';
	        $category['pt'] = '';

	        $root_category->bulkSaveLanguages('name', $category);

            /*
            // Create Empty Page
            if( $category['type'] == 'page' ) {
                $new_page = Page::create(array(
                    'category_id' => $root_category->id,
                    'user_id' => 1
                ));

                $new_page->bulkSaveLanguages('title', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                $new_page->bulkSaveLanguages('content', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                $new_page->bulkSaveLanguages('excerpt', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
            }
            */


	        if( isset($category['subcategories']) ) {

	        	foreach( $category['subcategories'] as $subcategory_index => $subcategory )
	        	{
		        	$new_subcategory = Category::create(array(
			        	'parent_id' => $root_category->id,
			        	'slug' => $subcategory['slug'],
			        	'type' => $subcategory['type'],
                        'section' => $subcategory['section'],
			        	'url' => $subcategory['url'],
                        'allow_add_type' => (isset($subcategory['allow_add_type'])) ? $subcategory['allow_add_type'] : null,
			        	'sorting' => $subcategory_index * 10
			        ));

			        $subcategory['en'] = '';
	        		$subcategory['pt'] = '';

			        $new_subcategory->bulkSaveLanguages('name', $subcategory);


                    // if( $subcategory['type'] == 'single' ) {
                    //     $new_page = Page::create(array(
                    //         'category_id' => $new_subcategory->id,
                    //         'user_id' => 1
                    //     ));

                    //     $new_page->bulkSaveLanguages('title', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                    //     $new_page->bulkSaveLanguages('content', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                    //     $new_page->bulkSaveLanguages('excerpt', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                    // }


			        if( isset($subcategory['subcategories']) ) {

			        	foreach( $subcategory['subcategories'] as $subsubcategory_index => $subsubcategory )
			        	{
				        	$new_subsubcategory = Category::create(array(
					        	'parent_id' => $new_subcategory->id,
					        	'slug' => $subsubcategory['slug'],
					        	'type' => $subsubcategory['type'],
                                'section' => $subsubcategory['section'],
					        	'url' => $subsubcategory['url'],
                                'allow_add_type' => (isset($subsubcategory['allow_add_type'])) ? $subsubcategory['allow_add_type'] : null,
					        	'sorting' => $subsubcategory_index * 10
					        ));

					        $subsubcategory['en'] = '';
	        				$subsubcategory['pt'] = '';

					        $new_subsubcategory->bulkSaveLanguages('name', $subsubcategory);

                            // if( $subsubcategory['type'] == 'single' ) {
                            //     $new_page = Page::create(array(
                            //         'category_id' => $new_subsubcategory->id,
                            //         'user_id' => 1
                            //     ));

                            //     $new_page->bulkSaveLanguages('title', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                            //     $new_page->bulkSaveLanguages('content', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                            //     $new_page->bulkSaveLanguages('excerpt', array('cn' => '', 'gb' => '', 'en' => '', 'pt' => ''));
                            // }
					    }
			        }
			    }
	        }
		}

    }
}
