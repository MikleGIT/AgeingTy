@extends('frontend.template.master')

@section('body')

@stop

@section('leftnav')
	@foreach( Category::findBySlug('consult')->subCategories() as $subcategory )
	<li>
		<a href="{{ URL::to($subcategory->getSlug()) }}"{{ (isset($frontend_current_category) && $frontend_current_category->getFilteredSlug() == $subcategory->getFilteredSlug()) ? ' class="active"' : '' }}>
			{{ $subcategory->translate()->name }}
		</a>
	</li>
	@endforeach
@stop

@section('rightcontent')

<style>
.highlight {
    background-color: yellow;
    font-weight: bold;
}
</style>


<div class="hentry">
    <h3 class="entry-title text-center">
        {{ trans('messages.search') }}
        <span class="highlight">{{ $keyword }}</span>
    </h3>
    <div class="entry-content">
        @foreach( $results as $result )
        <div class="search-result-row">
            <p style="font-size: 26px; font-weight: bold">
                <a href="{{ route('go.to.slug', array(Category::find( Page::find($result->page_id)->category_id )->slug)) }}">
                    {{ $result->title }}
                </a>
            </p>

            <p>
                {{ $result->highlight }}
            </p>
        </div>

        <hr>
        @endforeach
    </div>
</div>


@stop