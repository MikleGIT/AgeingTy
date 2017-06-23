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
        {{ trans('messages.section_service') }}
    </a>

    @if( count( $frontend_current_category->subCategories() ) )
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
    @else
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getParentCategory()->getSlug()) }}">
        {{ $frontend_current_category->getParentCategory()->translate()->name }}
    </a>

    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
    @endif

</div>

<div class="page-header">
        @if( count( $frontend_current_category->subCategories() ) )
        <h2>{{ $frontend_current_category->translate()->name }}</h2>

        <ul class="list-inline">
            @foreach( Category::findBySlug($frontend_current_category->getFilteredSlug())->subCategories() as $posts_cat )
            @if($posts_cat->translate()->name != '')
            <li>
                <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                    {{ $posts_cat->translate()->name }}
                </a>
            </li>
            @endif
            @endforeach
        </ul>
        @else
            @if( !is_null($frontend_current_category->getParentCategory()->getParentCategory()) )
            <h2>{{ $frontend_current_category->getParentCategory()->translate()->name }}</h2>

            <ul class="list-inline">
                @foreach( Category::findBySlug($frontend_current_category->getParentCategory()->getFilteredSlug())->subCategories() as $posts_cat )
                @if($posts_cat->translate()->name != '')
                <li>
                    <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                        {{ $posts_cat->translate()->name }}
                    </a>
                </li>
                @endif
                @endforeach
            </ul>
            @else
            <h2>{{ $frontend_current_category->translate()->name }}</h2>
            @endif
        @endif
</div>

<div class="article">
    <div class="post">
        <h3 class="post-title text-center">{{ $frontend_current_category->getPage()->translate()->title }}</h3>

        <div class="post-content">
            {{ $frontend_current_category->getPage()->translate()->content }}
        </div>
    </div>
</div>

    <!--
    <div class=page-nav>
        <ul class=list-inline>
            <li><a href=#>上一頁</a></li>
            <li><a href=#>1</a></li>
            <li><a href=#>2</a></li>
            <li><a href=#>3</a></li>
            <li><a href=#>4</a></li>
            <li><a href=#>5</a></li>
            <li>...</li>
            <li><a href=#>10</a></li>
            <li><a href=#>下一頁</a></li>
        </ul>
        <form role=pagination class=page-selector>
            <div class=input-group> <span class=input-group-addon>到</span>
                <input type=text class=form-control aria-label=到哪頁> <span class=input-group-addon>頁</span> </div>
            <button type=submit class="btn btn-theme">去</button>
        </form>
    </div>
    -->

<div class="clearfix"></div>
<a class="to-top" href="#hometop">
    <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
</a>
@stop