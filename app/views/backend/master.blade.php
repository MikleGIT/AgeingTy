<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="Blupurple CMS">
	<link rel="icon" href="../../favicon.ico">

	<title>@yield('title')
	| {{ Config::get('site.name') }}</title>

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('backend_assets/css/bootstrap.min.css') }}" rel="stylesheet">

	<style>
	body {
		padding-top: 50px;
	}

	@media (min-width: 768px) {
	  .sidebar {
	    position: fixed;
	    top: 51px;
	    bottom: 0;
	    left: 0;
	    z-index: 1000;
	    display: block;
	    padding: 20px;
	    overflow-x: hidden;
	    overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
	    background-color: #f5f5f5;
	    border-right: 1px solid #eee;
	  }
	}

	/* Sidebar navigation */
	.nav-sidebar {
	  margin-right: -21px; /* 20px padding + 1px border */
	  margin-bottom: 20px;
	  margin-left: -20px;
	}
	.nav-sidebar > li > a {
	  padding-right: 20px;
	  padding-left: 20px;
	}
	.nav-sidebar > .active > a,
	.nav-sidebar > .active > a:hover,
	.nav-sidebar > .active > a:focus {
	  color: #fff;
	  background-color: #428bca;
	}


	/*
	 * Main content
	 */

	.main {
	  padding: 20px;
	  padding-top: 0;
	}

	@media (min-width: 768px) {
	  .main {
	    padding-right: 40px;
	    padding-left: 40px;
	  }
	}
	.main .page-header {
	  margin-top: 0;
	}

	/*
	 * Placeholder dashboard ideas
	 */

	.placeholders {
	  margin-bottom: 30px;
	  text-align: center;
	}
	.placeholders h4 {
	  margin-bottom: 0;
	}
	.placeholder {
	  margin-bottom: 20px;
	}
	.placeholder img {
	  display: inline-block;
	  border-radius: 50%;
	}

	.starter-template {
		padding: 40px 15px;
		text-align: center;
	}

	.subcat > li {
		text-indent: 30px;
	}

	.subcat > li.active {
		background-color: #468CC8;
		color: #fff;
	}

	.subcat > li.active > a {
		color: #fff;
	}

	.subcat > li.active > a:hover {
		background-color: inherit;
	}
	</style>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ action('BackendController@index') }}">
					{{ Config::get('site.name') }}
				</a>
			</div>

			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li{{ (strpos(Route::getCurrentRoute()->getName(), '.home.') !== false ) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendController@index') }}">首頁</a>
					</li>

					@foreach( Category::getRootCategories() as $category )

					@if( in_array($category->section, array('feedback')) )
					<?php continue; ?>
					@endif

					<li{{ ((isset($backend_category_id) && $backend_category_id == $category->id) ) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendSectionController@index', array($category->section)) }}">{{ $category->translate(Config::get('site.main_lang'))->name }}</a>
					</li>
					@endforeach

					<li{{ (strpos(Route::getCurrentRoute()->getName(), '.consults.') !== FALSE) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendConsultController@index') }}">諮詢問題及意見收集</a>
					</li>

					<li{{ (strpos(Route::getCurrentRoute()->getName(), '.consult_documents.') !== FALSE) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendConsultDocumentController@index') }}">諮詢文本</a>
					</li>

					<li{{ (strpos(Route::getCurrentRoute()->getName(), '.attachments.') !== FALSE) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendAttachmentController@index') }}">檔案</a>
					</li>

					<li{{ (strpos(Route::getCurrentRoute()->getName(), '.csv_import.') !== FALSE) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendCSVController@index') }}">匯入</a>
					</li>
				</ul>

				<ul class="nav navbar-nav pull-right">
					<li>
						<a href="#">{{ Auth::user()->username }}</a>
					</li>
					<li>
						<a href="{{ action('BackendAuthController@logout') }}">登出</a>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
		<!-- /.container -->
	</nav>


	<div class="container-fluid" style="margin-top: 20px">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">

				@if( isset($backend_category_id) )
				<ul class="nav nav-sidebar">
					@foreach( Category::getSubCategories($backend_category_id, true) as $subcategory )
					<li{{ (isset($backend_current_category_id) && $backend_current_category_id == $subcategory->id) ? ' class="active"' : '' }}>
						@if( $subcategory->typePage() )
						<a href="{{ action('BackendPageController@edit', array($subcategory->getFilteredSlug())) }}">
							{{ $subcategory->translate(Config::get('site.main_lang'))->name }}
							@if( $subcategory->is_hidden )
							(隱藏)
							@endif
						</a>
						@elseif( $subcategory->typePost() )
						<a href="{{ action('BackendPostController@postlist', array($subcategory->getFilteredSlug())) }}">
							{{ $subcategory->translate(Config::get('site.main_lang'))->name }}
							@if( $subcategory->is_hidden )
							(隱藏)
							@endif
						</a>
						@endif

						@if( $subcategory->hasSubCategories($subcategory->id, true) )
						<ul class="nav subcat">
							@foreach( $subcategory->getSubCategories($subcategory->id, true) as $subsubcategory )
							<li{{ (isset($backend_current_category_id) && $backend_current_category_id == $subsubcategory->id) ? ' class="active"' : '' }}>
								
								@if( $subsubcategory->typePage() )
								<a href="{{ action('BackendPageController@edit', array($subsubcategory->getFilteredSlug())) }}">
									{{ $subsubcategory->translate(Config::get('site.main_lang'))->name }}
									@if( $subsubcategory->is_hidden )
									(隱藏)
									@endif
								</a>
								@elseif( $subsubcategory->typePost() )
								<a href="{{ action('BackendPostController@postlist', array($subsubcategory->getFilteredSlug())) }}">
									{{ $subsubcategory->translate(Config::get('site.main_lang'))->name }}

									@if( $subsubcategory->is_hidden )
									(隱藏)
									@endif
								</a>
								@endif
							</li>
							@endforeach
						</ul>
						@endif

						@if( $subcategory->isAllowAddPost() || $subcategory->isAllowAddPage() )
							<div class="add-post-page-btn" style="padding: 12px 0; padding-left: 44px">
								<a href="{{ action('BackendCategoryController@order', array($subcategory->getFilteredSlug())) }}" class="btn btn-xs btn-success">
									調整排序
								</a>
							
								@if( $subcategory->isAllowAddPost() )
								<a href="#create-category" data-parent="{{ $subcategory->getSlug() }}" data-name="{{ $subcategory->translate(Config::get('site.main_lang'))->name }}" data-type="post" class="btn btn-xs btn-primary">
									新增分類
								</a>
								@endif

								@if( $subcategory->isAllowAddPage() )
								<a href="#create-category" data-parent="{{ $subcategory->getSlug() }}" data-name="{{ $subcategory->translate(Config::get('site.main_lang'))->name }}" data-type="page" class="btn btn-xs btn-primary">
									新增頁面
								</a>
								@endif
							</div>
						@endif
					</li>
					@endforeach

					@if( $backend_category->section == 'contact' || isset($backend_contact) )
					<li{{ (isset($backend_contact)) ? ' class="active"' : '' }}>
						<a href="{{ action('BackendContactController@index') }}">
							收到的意見 ({{ Contact::count() }})
						</a>
					</li>
					@endif
				</ul>

				@if( isset($backend_category) )
					@if( $backend_category->isAllowAddPost() || $backend_category->isAllowAddPage() )
						<div class="add-post-page-btn">
							<a href="{{ action('BackendCategoryController@order', array($backend_category->getFilteredSlug())) }}" class="btn btn-xs btn-success">
								調整排序
							</a>

							@if( $backend_category->isAllowAddPost() )
							<a href="#create-category" data-parent="{{ $backend_category->getSlug() }}" data-name="{{ $backend_category->translate(Config::get('site.main_lang'))->name }}" data-type="post" class="btn btn-xs btn-primary">
								新增分類
							</a>
							@endif

							@if( $backend_category->isAllowAddPage() )
							<a href="#create-category" data-parent="{{ $backend_category->getSlug() }}" data-name="{{ $backend_category->translate(Config::get('site.main_lang'))->name }}" data-type="page" class="btn btn-xs btn-primary">
								新增頁面
							</a>
							@endif
						</div>
					@endif
				@endif

				@endif



			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h2 class="page-header">
					<div class="row">
						<div class="col-sm-8">
							@yield('title')
						</div>

						<div class="col-sm-4 text-right">
							@yield('titleright')
						</div>
					</div>
				</h2>
				@yield('body')
			</div>
		</div>
	</div>






	<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryTitle">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="createCategoryTitle"></h4>
				</div>
				<div class="modal-body">
					<div class="panel minimal minimal-gray">
						<ul class="nav nav-tabs">
							@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
							<li{{ ($lang_index == 0) ? ' class="active"' : '' }}>
								<a href="#create_category_{{ $lang->code }}" data-toggle="tab">{{ $lang->name }}</a>
							</li>
							@endforeach
						</ul>
						
						<div class="panel-body">
							<div class="tab-content">
								@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
								<div class="tab-pane{{ ($lang_index == 0) ? ' active' : '' }}" id="create_category_{{ $lang->code }}">
									<div class="row">
										<div class="col-xs-12">
											<h5>名稱</h5>
											{{ Form::text('create_category_name[' . $lang->code . ']', '', array('class' => 'form-control create_category_name')) }}
											<p class="bg-danger create_category_name_error hidden"></p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>

						<ul class="nav nav-tabs" style="margin-top: 10px">
							<li class="active">
								<a href="#language-independent" data-toggle="tab">
									非多語言欄位
								</a>
							</li>
						</ul>
						
						<div class="panel-body">
							
							<div class="tab-content">
								<div class="tab-pane active" id="language-independent">

									<div class="row">
										<div class="col-xs-12">
											<h5>網址簡稱 (只可使用英文字元及數字)</h5>
											{{ Form::text('create_category_slug', '', array('class' => 'form-control create_category_slug')) }}
											<p class="bg-danger create_category_slug_error hidden"></p>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<!-- /.panel -->

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btnCreateCategory">確定</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">關閉</button>
				</div>
			</div>
		</div>
	</div>




	<!-- Footer -->
	<footer class="main text-center" style="margin-top: 100px; margin-bottom: 20px">
		&copy; {{ date('Y') }} <strong>{{ Config::get('site.copyright') }}</strong>
	</footer>

	<script src="{{ asset('backend_assets/js/jquery-1.11.0.min.js') }}"></script>
	<script src="{{ asset('backend_assets/js/bootstrap.min.js') }}"></script>

	@yield('js')

	<script>
	var create_category_type = '';
	var create_category_parent = '';

	$(function() {

		$('a[href="#create-category"]').on('click', function(e) {
			e.preventDefault();

			var $el = $(e.currentTarget);
			var type = $el.attr('data-type');
			var name = $el.attr('data-name');
			var parent = $el.attr('data-parent');

			create_category_type = type;
			create_category_parent = parent;

			var title = '';

			if( type == 'post' ) {
				title = name + ' - 新增分類';
			}else if( type == 'page' ) {
				title = name + ' - 新增頁面';
			}

			$('#createCategoryTitle').html(title);

			$('.create_category_name_error').addClass('hidden');
			$('.create_category_slug_error').addClass('hidden');

			$( $('#createCategory').find('input') ).each(function(i, val) {
				$(val).val('');
			});

			$('#createCategory').modal('show');
		});

		$('#btnCreateCategory').on('click', function(e) {
			e.preventDefault();

			var data = {};

			$( $('#createCategory').find('input') ).each(function(i, val) {
				data[$(val).attr('name')] = $(val).val();
			});

			data['type'] = create_category_type;
			data['parent'] = create_category_parent;

			$.ajax({
				url: '{{ action('BackendCategoryController@ajaxCreate') }}',
				type: 'post',
				dataType: 'json',
				data: data,
				cache: false,
				success: function(data) {
					
					if( data.status == 0 ) {

						$('.create_category_name_error').addClass('hidden');
						$('.create_category_slug_error').addClass('hidden');

						if( data.field == 'slug' ) {
							$('.create_category_slug_error').html(data.message).removeClass('hidden');
						}

						if( data.field == 'name' ) {
							$('.create_category_name_error').html(data.message).removeClass('hidden');
						}

					}else{
						window.location = data.redirect;
					}

				}
			});
		});


	});
	</script>

	<!-- Blupurple CMS -->

</body>
</html>