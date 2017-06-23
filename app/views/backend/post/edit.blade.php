@extends('backend.master')

@section('title', '編輯資料 - ' . $category->translate(Config::get('site.main_lang'))->name . ' - ' . $post->translate(Config::get('site.main_lang'))->title)

@section('body')

{{ Form::open(array('url' => action('BackendPostController@postEdit', array($category->getFilteredSlug(), $post->id)), 'files' => true)) }}

@if( count($errors) > 0 )
<div class="alert alert-danger text-center"><strong>錯誤</strong> 請檢查欄位</div>
@endif

@if( Session::get('success') )
<div class="alert alert-success text-center"><strong>儲存成功!</strong></div>
@endif


<div class="row">
	<div class="col-xs-12 col-sm-12" id="editor-container">
		<div class="panel minimal minimal-gray">
			<ul class="nav nav-tabs">
				@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
				<li{{ ($lang_index == 0) ? ' class="active"' : '' }}>
					<a href="#{{ $lang->code }}" data-toggle="tab">{{ $lang->name }}</a>
				</li>
				@endforeach
			</ul>
			
			<div class="panel-body">
				
				<div class="tab-content">

					@foreach(Language::getAvailableLanguages() as $lang_index => $lang)
					<div class="tab-pane{{ ($lang_index == 0) ? ' active' : '' }}" id="{{ $lang->code }}">
						
						<div class="row title-container">
							<div class="col-xs-12">
								<h5>標題</h5>

								{{ Form::text('title[' . $lang->code . ']', $post->translate($lang->code)->title, array('class' => 'form-control')) }}
								{{ $errors->first('title.' . $lang->code, '<p class="bg-danger">:message</p>') }}

								<hr>
							</div>
						</div>

						<div class="row content-container">
							<div class="col-xs-12">
								<h5>內容</h5>

								{{ Form::textarea('content[' . $lang->code . ']', $post->translate($lang->code)->content, array('class' => 'form-control content-editor')) }}
								{{ $errors->first('content.' . $lang->code, '<p class="bg-danger">:message</p>') }}

								<hr>
							</div>
						</div>

						<div class="row excerpt-container">
							<div class="col-xs-12">
								<h5>簡述</h5>

								{{ Form::textarea('excerpt[' . $lang->code . ']', $post->translate($lang->code)->excerpt, array('class' => 'form-control', 'style' => 'height: 80px')) }}
								{{ $errors->first('excerpt.' . $lang->code, '<p class="bg-danger">:message</p>') }}
							</div>
						</div>

					</div>
					@endforeach
				</div>
				
			</div>
		</div>
		<!-- /.panel -->

	</div>


	<div class="col-xs-12 col-sm-12" id="metafield-container" style="display: none">
		<div class="panel minimal minimal-gray">

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#language-independent" data-toggle="tab">
						更多欄位
					</a>
				</li>
			</ul>

			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active" id="language-independent">
						<div id="metafield"></div>
					</div>
				</div>
			</div>
			
		</div>
	</div>


	<div class="col-xs-12 col-sm-12" id="language-independent-container">
		<div class="panel minimal minimal-gray">

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#language-independent" data-toggle="tab">
						非多語言欄位
					</a>
				</li>
			</ul>


			<div class="panel-body" id="image-container">
				<div class="tab-content">
					<div class="tab-pane active" id="language-independent">
						<h5>封面圖片</h5>

						@if( $post->hasImage() )
						<img src="{{ $post->getImageUrl() }}" class="img-thumbnail img-responsive">
						<br>
						<label class="form-control">
							{{ Form::checkbox('remove_image', 1) }}
							刪除圖片?
						</label>
						@endif

						{{ Form::file('image', array('class' => 'form-control')) }}
						{{ $errors->first('image', '<p class="bg-danger">:message</p>') }}

						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-12" id="language-independent-container">
		<div class="panel minimal minimal-gray">
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active">
						<h5>建立日期</h5>

						{{ Form::text('created_at', $post->created_at, array('class' => 'form-control')) }}
						{{ $errors->first('created_at', '<p class="bg-danger">:message</p>') }}

						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-xs-12 col-sm-12">
		<div class="panel minimal minimal-gray">
			
			<div class="panel-body">
				
				<div class="tab-content">
					<div class="tab-pane active" id="language-independent">

						<div class="row">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-info btn-block">儲存變更</button>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
		<!-- /.panel -->

	</div>
</div>

{{ Form::close() }}


{{ Form::open(array('url' => action('BackendPostController@delete', array($category->getFilteredSlug(), $post->id)), 'method' => 'post', 'onsubmit' => 'return confirm("確定刪除?")')) }}
<div class="row">
	<div class="col-xs-12 col-sm-12">
		<div class="panel minimal minimal-gray">
			<div class="panel-body">
				
				<div class="tab-content">
					<div class="tab-pane active" id="language-independent">

						<div class="row">
							<div class="col-xs-12 text-right">
								<button type="submit" class="btn btn-danger">刪除</button>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}




@stop





@section('js')
<script src="{{ asset('backend_assets/js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend_assets/js/ckeditor/adapters/jquery.js') }}"></script>


<script>
$(function()
{
    $('.content-editor').ckeditor({
    	language: 'zh',
    	height: 350,
    	allowedContent: true,
    	extraAllowedContent: 'span;ul;li;table;td;style;*[id];*(*);*{*}',
    	extraPlugins: 'htmlbuttons,uploadimage',
		filebrowserImageUploadUrl: '{{ action('BackendUploadController@image') }}',
    	contentsCss: '{{ asset('/backend_assets/css/ckeditor.css') }}',
    });

    CKEDITOR.config.protectedSource.push( /<icon-block[\s\S]*?\/icon-block>/g );

    $.each(CKEDITOR.dtd.$removeEmpty, function (i, value) {
        CKEDITOR.dtd.$removeEmpty[i] = false;
    });

    $.ajax({
    	url: '{{ action('MetaDataController@getFields') }}',
    	type: 'get',
    	dataType: 'html',
    	data: {
    		'meta_key': 'post_{{ $post->id }}'
    	},
    	cache: false,
    	success: function(data) {

    		if( data == '' ) {
    			$('#metafield-container').hide(0);
    			return;
    		}

    		$('#metafield-container').show(0);

    		$('#metafield').html(data).promise().done(function() {

    			var first_lang = $('div[data-metafield-lang]').first().attr('data-metafield-lang');

    			$('div[data-metafield-lang]').hide(0);
    			$('div[data-metafield-lang="' + first_lang + '"]').show(0);

    			$('div[data-metafield-group="i18n"] ul.nav li a').on('click', function(e) {
    				e.preventDefault();

    				var $el = $(e.currentTarget);
    				var group_id = $el.closest('[data-metafield-group="i18n"]').attr('data-metafield-group-id');
    				var lang = $el.closest('li').attr('data-metafield-lang');

    				$('[data-metafield-lang="' + lang + '"][data-metafield-group-id="' + group_id + '"]:not([data-metafield-group="i18n"])').show(0);
    				$('[data-metafield-lang!="' + lang + '"][data-metafield-group-id="' + group_id + '"]:not([data-metafield-group="i18n"])').hide(0);
    			});

    		});
    	}
    });

});
</script>
@stop




@section('js_old')
<link rel="stylesheet" href="{{ asset('backend_assets/js/redactor/redactor.css') }}" />
<script src="{{ asset('backend_assets/js/redactor/redactor.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/redactor.undoredo.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/table.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/fontsize.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/fontfamily.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/fontcolor.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/clips/clips.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/lang-zh_TW.js') }}"></script>

<link rel="stylesheet" href="{{ asset('backend_assets/js/redactor/clips/clips.css') }}">

<script>
$(function()
{
    $('.content-editor').redactor({
    	minHeight: 500,
    	imageUpload: '{{ action('BackendUploadController@image') }}',
    	plugins: ['bufferbuttons', 'table', 'fontsize', 'fontfamily', 'fontcolor', 'clips']
    });



    $.ajax({
    	url: '{{ action('MetaDataController@getFields') }}',
    	type: 'get',
    	dataType: 'html',
    	data: {
    		'meta_key': 'post_{{ $post->id }}'
    	},
    	cache: false,
    	success: function(data) {

    		if( data == '' ) {
    			$('#metafield-container').hide(0);
    			return;
    		}

    		$('#metafield-container').show(0);

    		$('#metafield').html(data).promise().done(function() {

    			var first_lang = $('div[data-metafield-lang]').first().attr('data-metafield-lang');

    			$('div[data-metafield-lang]').hide(0);
    			$('div[data-metafield-lang="' + first_lang + '"]').show(0);

    			$('div[data-metafield-group="i18n"] ul.nav li a').on('click', function(e) {
    				e.preventDefault();

    				var $el = $(e.currentTarget);
    				var group_id = $el.closest('[data-metafield-group="i18n"]').attr('data-metafield-group-id');
    				var lang = $el.closest('li').attr('data-metafield-lang');

    				$('[data-metafield-lang="' + lang + '"][data-metafield-group-id="' + group_id + '"]:not([data-metafield-group="i18n"])').show(0);
    				$('[data-metafield-lang!="' + lang + '"][data-metafield-group-id="' + group_id + '"]:not([data-metafield-group="i18n"])').hide(0);
    			});

    		});
    	}
    });

});
</script>
@stop