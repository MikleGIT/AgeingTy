@extends('backend.master')

@section('title', '所有資料 - ' . $category->translate(Config::get('site.main_lang'))->name)

@section('titleright')
<a href="{{ action('BackendCategoryController@edit', array($category->getFilteredSlug())) }}" class="btn btn-warning">分類設定</a>
@stop

@section('body')
<style>
.table td {
	word-break: break-all;
}
</style>


<div class="row">
	<div class="col-xs-12 text-right">
		<a href="{{ action('BackendPostController@create', array($category->getFilteredSlug())) }}" class="btn btn-info" style="margin-top: 18px">
			新增
		</a>
	</div>
</div>


@if( Session::get('success') )
<div class="alert alert-success">
	<strong>更新成功!</strong>
</div>
@endif


{{ Form::open(array('url' => action('BackendPostController@postBatchDelete', array($category->getFilteredSlug())), 'method' => 'post')) }}

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th width="5%"></th>
				<th width="45%">標題</th>
				<th width="20%">封面圖片</th>
				<th width="20%">建立日期</th>
				<th width="10%">管理</th>
			</tr>
		</thead>
		
		<tbody>
			@foreach( $posts as $post )
			<tr>
				<td>
					{{ Form::checkbox('delete_posts[]', $post->id, false) }}
				</td>
				<td>{{ $post->translate('cn')->title }}</td>
				<td>
					@if( $post->hasImage() )
					<img src="{{ $post->getImageUrl() }}" class="img-responsive img-thumbnail">
					@endif
				</td>
				<td>{{ $post->created_at }}</td>
				<td>
					<a href="{{ action('BackendPostController@edit', array($category->getFilteredSlug(), $post->id)) }}" class="btn btn-xs btn-warning">
						編輯
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
		
</div>

{{ Form::submit('刪除已選項目', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("確認刪除所選項目？")']) }}

{{ Form::close() }}

@stop