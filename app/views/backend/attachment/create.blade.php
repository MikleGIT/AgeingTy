@extends('backend.master')

@section('title', '新增資料 - 檔案')

@section('titleright')
<a href="{{ action('BackendAttachmentController@index') }}" class="btn btn-warning">取消</a>
@stop

@section('body')

{{ Form::open(array('url' => action('BackendAttachmentController@store'), 'method' => 'post', 'files' => true)) }}

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

						{{ Form::text('title', '', array('class' => 'form-control')) }}
						{{ $errors->first('title', '<p class="bg-danger">:message</p>') }}

						<hr>

						<h5>檔案</h5>

						{{ Form::file('file', array('class' => 'form-control')) }}
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

@stop





@section('js')

@stop