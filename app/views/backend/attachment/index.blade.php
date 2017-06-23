@extends('backend.master')

@section('title', '所有資料 - 檔案')

@section('body')
<style>
.table td {
	word-break: break-all;
}
</style>


<div class="row">
	<div class="col-xs-12 text-right">
		<a href="{{ action('BackendAttachmentController@create') }}" class="btn btn-info" style="margin-top: 18px">
			新增
		</a>
	</div>
</div>


@if( Session::get('success') )
<div class="alert alert-success">
	<strong>更新成功!</strong>
</div>
@endif


<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="20%">檔案備註</th>
				<th width="55%">檔案網址</th>
				<th width="15%">建立日期</th>
				<th width="10%">管理</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach( $records as $record )
			<tr>
				<td>{{ $record->title }}</td>
				<td>
					{{ Form::text('url[]', asset(Config::get('site.path.upload.file') . '/' . $record->filename), array('class' => 'form-control')) }}
				</td>
				<td>{{ $record->created_at }}</td>
				<td>
					<a href="{{ action('BackendAttachmentController@edit', $record->id) }}" class="btn btn-xs btn-warning">
						編輯
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
		
</div>

@stop