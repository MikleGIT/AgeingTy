@extends('backend.master')

@section('title', '新增資料 - 諮詢文本')

@section('body')

{{ Form::open(array('url' => action('BackendConsultDocumentController@store'), 'method' => 'post', 'files' => true)) }}

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

								{{ Form::text('title[' . $lang->code . ']', '', array('class' => 'form-control')) }}
								{{ $errors->first('title.' . $lang->code, '<p class="bg-danger">:message</p>') }}
							</div>
						</div>

						<hr>
						<div class="row">
							<div class="col-xs-12">
								<h5>諮詢文本</h5>

								{{ Form::file('file[' . $lang->code . ']', array('class' => 'form-control')) }}
								{{ $errors->first('file[' . $lang->code . ']', '<p class="bg-danger">:message</p>') }}
							</div>
						</div>

					</div>
					@endforeach
				</div>
				
			</div>
		</div>
		<!-- /.panel -->

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

@stop





@section('js')
<link rel="stylesheet" href="{{ asset('backend_assets/js/redactor/redactor.css') }}" />
<script src="{{ asset('backend_assets/js/redactor/redactor.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/redactor.undoredo.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/table.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/fontsize.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/fontfamily.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/fontcolor.js') }}"></script>
<script src="{{ asset('backend_assets/js/redactor/clips/clips.js') }}"></script>

<link rel="stylesheet" href="{{ asset('backend_assets/js/redactor/clips/clips.css') }}">

<script>
$(function()
{
    $('.content-editor').redactor({
    	minHeight: 500,
    	imageUpload: '{{ action('BackendUploadController@image') }}',
    	plugins: ['bufferbuttons', 'table', 'fontsize', 'fontfamily', 'fontcolor', 'clips']
    });


});
</script>
@stop