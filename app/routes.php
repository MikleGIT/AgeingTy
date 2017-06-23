<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Route::resource('test','testConstroller);

App::before(function($request) {
    if ($request->getMethod() == 'OPTIONS') {
        $response = Response::make('', 204);
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Origin', '*');
        return $response;
    }
});

App::after(function($request, $response) {
    $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS');
    $response->header('Access-Control-Allow-Origin', '*');
});


//Route::get('/my/bar','MyController@index');
Route::get('/backend/login', array('as' => 'backend_login', 'uses' => 'BackendAuthController@login'));
Route::post('/backend/login', 'BackendAuthController@postLogin');
Route::get('/backend/logout', 'BackendAuthController@logout');

Route::group(array('before' => 'backend_auth', 'prefix' => 'backend'), function() {
	Route::get('/', array('as' => 'backend.home.index', 'uses' => 'BackendController@index'));

	Route::post('/upload/image', 'BackendUploadController@image');

	Route::get('/section/{section}', array('as' => 'backend.section.index', 'uses' => 'BackendSectionController@index'));

	Route::post('/category/create', array('as' => 'backend.category.create', 'uses' => 'BackendCategoryController@ajaxCreate'));
	Route::get('/category/{slug}/edit', array('as' => 'backend.category.edit', 'uses' => 'BackendCategoryController@edit'));
	Route::post('/category/{slug}/edit', array('as' => 'backend.category.update', 'uses' => 'BackendCategoryController@postEdit'));
	Route::post('/category/{slug}/delete', array('as' => 'backend.category.delete', 'uses' => 'BackendCategoryController@delete'));
	Route::get('/category/{slug}/order', array('as' => 'backend.category.order', 'uses' => 'BackendCategoryController@order'));
	Route::post('/category/{slug}/order', array('as' => 'backend.category.updateOrder', 'uses' => 'BackendCategoryController@postOrder'));

	Route::get('/page/{slug}/edit', array('as' => 'backend.page.edit', 'uses' => 'BackendPageController@edit'));
	Route::post('/page/{slug}/edit', array('as' => 'backend.page.update', 'uses' => 'BackendPageController@postEdit'));

	Route::post('/post/{slug}/batch_delete', array('as' => 'backend.post.batch_delete', 'uses' => 'BackendPostController@postBatchDelete'));

	Route::get('/post/{slug}/list', array('as' => 'backend.post.list', 'uses' => 'BackendPostController@postlist'));
	Route::get('/post/{slug}/create', array('as' => 'backend.post.create', 'uses' => 'BackendPostController@create'));
	Route::post('/post/{slug}/create', array('as' => 'backend.post.store', 'uses' => 'BackendPostController@postCreate'));
	Route::get('/post/{slug}/{id}/edit', array('as' => 'backend.post.edit', 'uses' => 'BackendPostController@edit'));
	Route::post('/post/{slug}/{id}/edit', array('as' => 'backend.post.update', 'uses' => 'BackendPostController@postEdit'));
	Route::post('/post/{slug}/{id}/delete', array('as' => 'backend.post.delete', 'uses' => 'BackendPostController@delete'));

	Route::get('/metafields/getform', array('as' => 'backend.meta.form', 'uses' => 'MetaDataController@getFields'));


	Route::get('/consults/comment/{id}', array('as' => 'backend.consults.comment', 'uses' => 'BackendConsultController@comments'));
	Route::resource('/consults', 'BackendConsultController');
	Route::resource('/consult_documents', 'BackendConsultDocumentController');

	Route::resource('/attachments', 'BackendAttachmentController');

	Route::get('/consults/export/{id}', array('as' => 'backend.consults.export', 'uses' => 'BackendConsultController@export'));

	Route::get('/contact/list', array('as' => 'backend.contact.list', 'uses' => 'BackendContactController@index'));
	Route::get('/contact/export', array('as' => 'backend.contact.export', 'uses' => 'BackendContactController@export'));

	Route::get('/import_csv', array('as' => 'backend.csv_import.index', 'uses' => 'BackendCSVController@index'));
	Route::post('/import_csv/import_to_learning', array('as' => 'backend.csv_import.learning', 'uses' => 'BackendCSVController@import_to_learning'));
	Route::post('/import_csv/import_to_events', array('as' => 'backend.csv_import.events', 'uses' => 'BackendCSVController@import_to_events'));

	Route::get('/import_csv/download_course_csv', array('uses' => 'BackendCSVController@downloadCourseCSV'));
	Route::get('/import_csv/download_event_csv', array('uses' => 'BackendCSVController@downloadEventCSV'));
});



Route::get('/', 'HomeController@index');
Route::get('/test','testConstroller@index');
Route::get('/myon', 'MyController@index');
Route::get('/app/page/{slug}', 'PageController@index');
Route::get('/app/post/{slug}', 'PostController@index');
Route::post('/submit_consult_comment', 'HomeController@submitConsultComment');
Route::post('/submit_contact', 'HomeController@submitContact');

Route::get('/set_lang/{lang_code}', 'LanguageController@setLang');

Route::get('/search', 'HomeController@search');
Route::get('/search_google', 'HomeController@searchGoogle');

Route::get('/api/carousel', 'HomeController@carousel');
//例子：如果返回slug为care，传care到/api/service/healthcare/{slug}
Route::get('/api/health_care/category', 'ApiController@healthCareCategory');
Route::get('/api/service/healthcare', 'ApiController@healthCare');
//Route::get('/api/service/healthcare/{slug}', 'ApiController@healthCareDetail');

Route::get('/api/discount', 'ApiController@discount');
Route::get('/api/discount/category', 'ApiController@discountCategory');
Route::get('/api/discount/{slug}', 'ApiController@discountSlug')
	->where('slug', '^(?!.*categories).*$');
//{id}中的值为/api/discount返回的id的值
Route::get('/api/discount/detail/{id}', 'ApiController@discountDetail')
	->where('id', '[\d]+');

Route::get('/api/education', 'ApiController@education');
Route::get('/api/education/category', 'ApiController@educationCategory')
	->where('slug', '^(?!.*categories).*$');
Route::get('/api/education/{id}', 'ApiController@educationDetail')
	->where('id', '[\d]+');

Route::get('/api/event/category', 'ApiController@eventCategory');
//slug取值：art,health,finance,relationships,other
Route::get('/api/event/{slug}', 'ApiController@event')
	->where('slug', '^(?!.*categories).*$');
Route::get('/api/event/detail/{id}', 'ApiController@eventDetail')
	->where('id', '[\d]+');

Route::get('/api/news/category', 'ApiController@newsCategory');
Route::get('/api/news/{slug}', 'ApiController@newsSlug')
	->where('slug', '^(?!.*categories).*$');
Route::get('/api/news/detail/{id}', 'ApiController@newsDetail')
	->where('id', '[\d]+');

//health应该就是其他新闻了
Route::get('/api/health/category', 'ApiController@healthCategory');
Route::get('/api/health/{slug}', 'ApiController@healthSlug')
	->where('slug', '^(?!.*categories).*$');
Route::get('/api/health/news/{id}', 'ApiController@newsDetail')
	->where('id', '[\d]+');

Route::get('/api/consult/category', 'ApiController@consultCategory');
Route::get('/api/consult/{slug}', 'ApiController@consultSlug')
	->where('slug', '^(?!.*categories).*$');

Route::get('/api/{slug1}/{slug2?}/{slug3?}/{slug4?}', 'ApiController@apiSlug');


// Route::get('/create_acc', function() {
// 	DB::table('users')->truncate();

// 	Eloquent::unguard();

//     User::create(array(
//     	'username' => 'admin',
//     	'password' => Hash::make('ageing2015'),
//     	'password_md5' => md5('ageing2015')
//     ));

//     User::create(array(
//     	'username' => 'ias',
//     	'password' => Hash::make('ERPnWM48'),
//     	'password_md5' => md5('ERPnWM48')
//     ));
// });


// Route::get('/generate_category_metadata', function() {

// 	Eloquent::unguard();

// 	$fields = "[i18n]
// 機構[organization,text]
// 優惠[discount,textarea]
// 優惠圖片[discount_image,image]
// 地址[address,text]
// 電話[contact,text]
// 實行日期[date,text]
// [/i18n]
// [hidden:content]
// [hidden:excerpt]
// [hidden:language-independent]";

// 	for( $i = 71; $i <= 101; $i++ ) {
// 		$metadata = new Metadata;
// 		$metadata->meta_key = 'category_' . $i;
// 		$metadata->meta_fields = $fields;
// 		$metadata->save();
// 	}

// });


Route::get('/{slug}', array('as' => 'go.to.slug', 'uses' => function($slug)
{
	// If this is a single for a post (pattern /post_xxx at the end of the url), pass the cateory check and handle the request in PostController
	if( preg_match('/\/post\_(\d+)$/', $slug) ) {
		//$slug = preg_replace('/\/post\_\d+/', '', $slug);

		$request = Request::create('/app/post/' . str_replace('/', ':', $slug), 'GET');
		$response = Route::dispatch($request);

		return $response;
	}

	$category = Category::findBySlug($slug);

	if( !$category ) {
		return 'Page not found.';
	}

	if( in_array($category->type, array('page', 'post')) ) {
		$request = Request::create('/app/' . $category->type . '/' . str_replace('/', ':', $slug), 'GET');
		$response = Route::dispatch($request);

		return $response;
	}

	if( $category->type == 'link' ) {
		return Redirect::to( $category->url );
	}

	return $category->slug;

}))->where('slug', '(.*)');
//Route::any('test','testConstroller');

