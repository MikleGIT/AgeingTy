@extends('backend.master')

@section('title', '[' . $category->translate(Config::get('site.main_lang'))->name . '] 設定')

@section('body')

{{ Form::open(array('url' => action('BackendCategoryController@postEdit', array($category->getFilteredSlug())), 'files' => true)) }}

@if( count($errors) > 0 )
<div class="alert alert-danger text-center"><strong>錯誤</strong> 請檢查欄位</div>
@endif

@if( Session::get('success') )
<div class="alert alert-success text-center"><strong>儲存成功!</strong></div>
@endif


<div class="row">
	<div class="col-xs-12 col-sm-12">
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
						
						<div class="row">
							<div class="col-xs-12">
								<h5>標題</h5>

								{{ Form::text('name[' . $lang->code . ']', $category->translate($lang->code)->name, array('class' => 'form-control')) }}
								{{ $errors->first('name.' . $lang->code, '<p class="bg-danger">:message</p>') }}
							</div>
						</div>

						<hr>
					</div>
					@endforeach
				</div>
				
			</div>
		</div>
		<!-- /.panel -->

	</div>


	<div class="col-xs-12 col-sm-12">
		<div class="panel minimal minimal-gray">

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#language-independent" data-toggle="tab">
						非多語言欄位
					</a>
				</li>
			</ul>

			<div class="panel-body">
							
				<div class="tab-content">
					<div class="tab-pane active" id="language-independent">

						<!-- <div class="row">
							<div class="col-xs-12">
								<h5>網址簡稱 (只可使用英文字元及數字)</h5>
								{{ Form::text('slug', $category->getSlugLastComponent(), array('class' => 'form-control')) }}
								{{ $errors->first('slug', '<p class="bg-danger">:message</p>') }}
							</div>
						</div>

						<hr> -->

						<div class="row">
							<div class="col-xs-12">
								<h5>顯示 / 隱藏</h5>
								<label class="form-control">
									{{ Form::radio('is_hidden', 0, ($category->is_hidden == false)) }}
									顯示
								</label>

								<label class="form-control">
									{{ Form::radio('is_hidden', 1, ($category->is_hidden == true)) }}
									隱藏
								</label>
								{{ $errors->first('is_hidden', '<p class="bg-danger">:message</p>') }}
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
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

@if( $category->typePost() )
{{ Form::open(array('url' => action('BackendCategoryController@delete', array($category->getFilteredSlug())), 'method' => 'post', 'onsubmit' => 'return confirm("確定刪除此分類? 此分類下的資料將會同時刪除")')) }}
@elseif( $category->typePage() )
{{ Form::open(array('url' => action('BackendCategoryController@delete', array($category->getFilteredSlug())), 'method' => 'post', 'onsubmit' => 'return confirm("確定刪除此頁面?")')) }}
@endif

@if( $category->typePost() || $category->typePage() )
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
@endif

@stop





@section('js')
@stop