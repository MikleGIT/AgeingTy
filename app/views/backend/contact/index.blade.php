@extends('backend.master')

@section('title', '收到的意見')

@section('body')

<div class="text-right" style="margin-bottom: 20px;">
	<a href="{{ action('BackendContactController@export') }}" class="btn btn-info">匯出 Excel</a>
</div>

@foreach( $contacts as $contact )
<table class="table table-bordered">
	<tbody>
		<tr>
			<td width="20%">姓名</td>
			<td>{{ $contact->name }}</td>
		</tr>
		<tr>
			<td>聯絡方式</td>
			<td>{{ $contact->contact }}</td>
		</tr>
		<tr>
			<td>意見內容</td>
			<td>{{ nl2br($contact->message) }}</td>
		</tr>
		<tr>
			<td>日期時間</td>
			<td>{{ $contact->created_at }}</td>
		</tr>
	</tbody>
</table>
@endforeach

@stop