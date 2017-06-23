@extends('backend.master')

@section('title', '[' . $category->translate(Config::get('site.main_lang'))->name . '] 調整排序')

@section('body')
<h5>拖拉以下項目排序</h5>

<style>
.items-sorting {
	margin: 0 0 9px 0;
	min-height: 10px;
	list-style: none;
	padding: 0;
}

.items-sorting li {
	display: block;
	color: #0088cc;
	background: #eeeeee;
	line-height: 40px;
	height: 40px;
	cursor: move;
	border-radius: 5px;
	margin: 10px 0;
	padding: 0 10px;
	border-bottom: 1px solid #e1e1e1;
}

.items-sorting li:hover, .items-sorting li.dragged {
	background: #cccccc;
}

.items-sorting li.placeholder {
	height: 4px;
	padding: 2px;
	background: #468CC8;
}

li.cancelled {
	background-color: #f9a3a3 !important;
}
</style>

@if( Session::get('success') )
<div class="alert alert-success" role="alert">
	排序更新成功
</div>
@endif

<ol class="items-sorting">
	@foreach( $category->subcategories() as $subcategory )
	<li data-id="{{ $subcategory->id }}"{{ (date('Y', strtotime($subcategory->activated_at)) > (date('Y') + 2)) ? ' class="cancelled"' : '' }}>
		{{ $subcategory->translate(Config::get('site.main_lang'))->name }}
	</li>
	@endforeach
</ol>

<hr>

{{ Form::open( array('url' => action('BackendCategoryController@postOrder', array($category->getFilteredSlug())), 'method' => 'post') ) }}

	<div id="sorting-container"></div>
	{{ Form::submit('更新排序', array('class' => 'btn btn-info')) }}

{{ Form::close() }}

@stop



@section('js')
<script src="{{ asset('backend_assets/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('backend_assets/js/jquery-sortable.js') }}"></script>

<script>
$(function()
{
	$("ol.items-sorting").sortable({
		group: 'items-sorting',
		pullPlaceholder: false,
		onDrag: function ($item, position) {
			$item.css({
				height: $item.outerHeight()
			});
		},

		onDrop: function(item, targetContainer, _super) {
			var $items = $('ol.items-sorting li');

			$('#sorting-container').html('');

			$items.each(function(i, val)
			{
				$('#sorting-container').append('<input type="hidden" name="sorting[' + $(val).attr('data-id') + ']" value="' + i + '">');
			});

			_super(item);
		}
	});

	$('#sorting-container').html('');

	$('ol.items-sorting li').each(function(i, val)
	{
		$('#sorting-container').append('<input type="hidden" name="sorting[' + $(val).attr('data-id') + ']" value="' + i + '">');
	});
});
</script>
@stop