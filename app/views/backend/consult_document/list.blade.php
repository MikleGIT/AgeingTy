@extends('backend.master')

@section('title', '所有資料 - 諮詢文本檔案')

@section('body')
<style>
.table td {
	word-break: break-all;
}
</style>


<div class="row">
	<div class="col-xs-12 text-right">
		<a href="{{ action('BackendConsultDocumentController@create') }}" class="btn btn-info" style="margin-top: 18px">
			新增諮詢文本
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
				<th width="45%">標題</th>
				<th width="20%">建立日期</th>
				<th width="10%">管理</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach( $consult_documents as $i => $consult_document )
			<tr>
				<td>{{ $i + 1 }}</td>
				<td>{{ $consult_document->translate('cn')->title }}</td>
				<td>{{ $consult_document->created_at }}</td>
				<td>
					<a href="{{ action('BackendConsultDocumentController@edit', $consult_document->id) }}" class="btn btn-xs btn-warning">
						編輯
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
		
</div>

@stop