@extends('backend.master')

@section('title', '匯入 Excel 檔案')

@section('body')
<style>
.table td {
	word-break: break-all;
}
</style>


<!--
<div class="alert alert-info" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	由於伺服器不支援 Excel 模組，只接受上傳 CSV 格式的檔案匯入資料。
	必須使用系統提供之 CSV 模版輸入資料，才能正確對應欄位資料。
</div>
-->


@if( Session::get('error') )
<div class="alert alert-danger" role="alert">
	{{ Session::get('error') }}
</div>
@endif

@if( Session::get('successful_message') )
<div class="alert alert-success" role="alert">
	{{ Session::get('successful_message') }}
</div>
@endif


{{ Form::open( array('url' => action('BackendCSVController@import_to_learning'), 'method' => 'post', 'files' => true) ) }}
	<h4 style="margin-top: 60px">課程資訊	 <a href="{{ action('BackendCSVController@downloadCourseCSV') }}" class="btn btn-xs btn-default">下載模版</a></h4>

	<hr>

	<h5>選擇 Excel 檔案</h5>
	{{ Form::file('learning_csv', array('class' => 'form-control')) }}
	{{ $errors->first('learning_csv', '<p class="bg-danger">:message</p>') }}

	<h5>分類</h5>
	{{ Form::select('learning_category', Category::findBySlug('education:courses')->getSubCategoriesForSelect(), null, array('class' => 'form-control')) }}

	<div class="row" style="margin-top: 12px">
		<div class="col-xs-12">
			{{ Form::submit('匯入資料', array('class' => 'btn btn-info')) }}
		</div>
	</div>

{{ Form::close() }}


<hr>



{{ Form::open( array('url' => action('BackendCSVController@import_to_events'), 'method' => 'post', 'files' => true) ) }}
	<h4 style="margin-top: 60px">活動 <a href="{{ action('BackendCSVController@downloadEventCSV') }}" class="btn btn-xs btn-default">下載模版</a></h4>

	<hr>

	<h5>選擇 Excel 檔案</h5>
	{{ Form::file('events_csv', array('class' => 'form-control')) }}
	{{ $errors->first('events_csv', '<p class="bg-danger">:message</p>') }}

	<h5>分類</h5>
	{{ Form::select('events_category', Category::findBySlug('event')->getSubCategoriesForSelect(), null, array('class' => 'form-control')) }}

	<div class="row" style="margin-top: 12px">
		<div class="col-xs-12">
			{{ Form::submit('匯入資料', array('class' => 'btn btn-info')) }}
		</div>
	</div>

{{ Form::close() }}


@if( Session::get('success') )
<div class="alert alert-success">
	<strong>更新成功!</strong>
</div>
@endif

@stop