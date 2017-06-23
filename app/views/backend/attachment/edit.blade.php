@extends('backend.master')

@section('title', '編輯資料 - 檔案')

@section('titleright')
<a href="{{ action('BackendAttachmentController@index') }}" class="btn btn-warning">取消</a>
@stop

@section('body')

{{ Form::open(array('url' => action('BackendAttachmentController@update', $record->id), 'method' => 'put', 'files' => true)) }}

@if( count($errors) > 0 )
<div class="alert alert-danger text-center"><strong>錯誤</strong> 請檢查欄位</div>
@endif

@if( Session::get('success') )
<div class="alert alert-success text-center"><strong>儲存成功!</strong></div>
@endif


<div class="row">

	<div class="col-xs-12 col-sm-12" id="language-independent-container">
		<div class="panel minimal minimal-gray" id="image-container">

			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#language-independent" data-toggle="tab">
						上傳檔案
					</a>
				</li>
			</ul>


			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active" id="language-independent">
						<h5>檔案備註 (只供內部參考)</h5>

						{{ Form::text('title', $record->title, array('class' => 'form-control')) }}
						{{ $errors->first('title', '<p class="bg-danger">:message</p>') }}

						<hr>

						<h5>檔案</h5>

						@if( $record->filename )
						<a href="{{ asset(Config::get('site.path.upload.file') . '/' . $record->filename) }}" class="btn btn-info" target="_blank">
							瀏覽檔案
						</a>
						@endif

						{{ Form::file('file', array('class' => 'form-control', 'style' => 'margin-top: 8px')) }}
						{{ $errors->first('file', '<p class="bg-danger">:message</p>') }}

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



{{ Form::open(array('url' => action('BackendAttachmentController@destroy', array($record->id)), 'method' => 'delete', 'onsubmit' => 'return confirm("確定刪除?")')) }}
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

@stop