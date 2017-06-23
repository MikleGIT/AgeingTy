@extends('frontend.template.master')

@section('title', $frontend_current_category->translate()->name)

@section('leftnav')

	@foreach( Category::findBySlug('consult')->subCategories() as $subcategory )
	<li>
		<a href="{{ URL::to($subcategory->getSlug()) }}"{{ ($frontend_current_category->getFilteredSlug() == $subcategory->getFilteredSlug()) ? ' class="active"' : '' }}>
			{{ $subcategory->translate()->name }}
		</a>
	</li>
	@endforeach
@stop