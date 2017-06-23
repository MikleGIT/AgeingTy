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
        {{ trans('messages.section_learning') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
</div>
<div class="page-header">
    <h2>{{ trans('messages.section_learning') }}</h2>
    <ul class="list-inline">
        @foreach( Category::findBySlug('education')->subCategories() as $posts_cat )
        <li>
            <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                {{ $posts_cat->translate()->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>
<div class="sheet">
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