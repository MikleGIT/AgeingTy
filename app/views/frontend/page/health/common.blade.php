@extends('frontend.page.consult.master')

@section('body')

@stop

@section('rightcontent')

<h2 class="access">你現在網站里的位置</h2>
<div class="breadcrumb">
    <a href="{{ URL::to($frontend_current_category->getRootCategory()->getSlug()) }}">
        {{ trans('messages.home') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getRootCategory()->getSlug()) }}">
        {{ trans('messages.section_health') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
</div>
<div class="page-header">
        @if( count( $frontend_current_category->subCategories() ) )
        <h2>{{ $frontend_current_category->translate()->name }}</h2>

        <ul class="list-inline">
            @foreach( Category::findBySlug($frontend_current_category->getFilteredSlug())->subCategories() as $posts_cat )
            @if($posts_cat->translate()->name != '')
            <li>
            	@if (URL::to($posts_cat->getSlug()) == 'http://www.ageing.ias.gov.mo/health/tips')
                    <a href="http://www.ageing.ias.gov.mo/health/video"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                        {{ $posts_cat->translate()->name }}
                    </a>
                @else
                <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                    {{ $posts_cat->translate()->name }}
                </a>
                @endif
            </li>
            @endif
            @endforeach
        </ul>
        @else
            @if( !is_null($frontend_current_category->getParentCategory()->getParentCategory()) )
            <h2>{{ $frontend_current_category->getParentCategory()->translate()->name }}</h2>

            <ul class="list-inline">
                @foreach( Category::findBySlug($frontend_current_category->getParentCategory()->getFilteredSlug())->subCategories() as $posts_cat )
                <li>
                    <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                        {{ $posts_cat->translate()->name }}
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <h2>{{ $frontend_current_category->getParentCategory()->translate()->name }}</h2>

            <ul class="list-inline">
                @foreach( Category::findBySlug('health')->subCategories() as $posts_cat )
                <li>
                @if (URL::to($posts_cat->getSlug()) == 'http://www.ageing.ias.gov.mo/health/tips')
                    <a href="http://www.ageing.ias.gov.mo/health/video"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                        {{ $posts_cat->translate()->name }}
                    </a>
                @else
                    <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                        {{ $posts_cat->translate()->name }}
                    </a>
                @endif
                </li>
                @endforeach
            </ul>
            @endif
        @endif
</div>
<div class="article">
    <h3 class="entry-title text-center">{{ $frontend_current_category->getPage()->translate()->title }}</h3>
    <div class="entry-content">
        {{ $frontend_current_category->getPage()->translate()->content }}
    </div>
</div>

<div class="clearfix"></div>
<a class="to-top" href="#hometop">
    <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
</a>
@stop