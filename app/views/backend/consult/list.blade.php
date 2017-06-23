@extends('backend.master')

@section('title', '所有資料 - 諮詢問題及意見收集')

@section('body')
<style>
.table td {
	word-break: break-all;
}
</style>


<div class="row">
	<div class="col-xs-12 text-right">
		<a href="{{ action('BackendConsultController@create') }}" class="btn btn-info" style="margin-top: 18px">
			新增諮詢問題
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
				<th width="5%">#</th>
				<th width="45%">諮詢問題</th>
				<th width="10%">意見總數</th>
				<th width="10%">Excel 匯出</th>
				<th width="20%">建立日期</th>
				<th width="10%">管理</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach( $consults as $i => $consult )
			<tr>
				<td>{{ $i + 1 }}</td>
				<td>{{ $consult->translate('cn')->title }}</td>
				<td>
					@if( $consult->getCommentsCount() > 0 )
					<a href="{{ action('BackendConsultController@comments', $consult->id) }}" class="btn btn-xs btn-primary">共收到 {{ $consult->getCommentsCount() }} 個意見</a>
					@else
					0
					@endif
				</td>
				<td>
					<a href="{{ action('BackendConsultController@export', $consult->id) }}" class="btn btn-xs btn-info">下載</a>
				</td>
				<td>{{ $consult->created_at }}</td>
				<td>
					<a href="{{ action('BackendConsultController@edit', $consult->id) }}" class="btn btn-xs btn-warning">
						編輯
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
		
</div>

@stop