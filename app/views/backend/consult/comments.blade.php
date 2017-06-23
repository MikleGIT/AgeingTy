@extends('backend.master')

@section('title', '諮詢問題《' . $consult->translate()->title . '》收集到的意見')

@section('titleright')
<a href="{{ action('BackendConsultController@index') }}" class="btn btn-warning">返回</a>
@stop

@section('body')

@foreach( $consult->comments as $comment )
<table class="table table-bordered">
	<tbody>
		<tr>
			<td width="20%">姓名</td>
			<td>{{ $comment->name }}</td>
		</tr>
		<tr>
			<td>聯絡方式</td>
			<td>{{ $comment->contact }}</td>
		</tr>
		<tr>
			<td>意見內容</td>
			<td>{{ nl2br($comment->message) }}</td>
		</tr>
		<tr>
			<td>日期時間</td>
			<td>{{ $comment->created_at }}</td>
		</tr>
	</tbody>
</table>
@endforeach

@stop