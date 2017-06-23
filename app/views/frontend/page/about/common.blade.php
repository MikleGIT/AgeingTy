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
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
</div>
<div class="page-header">
    <h2>{{ $frontend_current_category->translate()->name }}</h2>
</div>
<div class="sheet">
    <div class="article">
        <div class="post">
            <h3 class="post-title text-center">{{ $frontend_current_category->getPage()->translate()->title }}</h3>
            <div class="post-content">
                {{ $frontend_current_category->getPage()->translate()->content }}
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<a class="to-top" href="#hometop">
    <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
</a>
@stop