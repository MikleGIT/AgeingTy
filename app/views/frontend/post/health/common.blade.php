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
    <h2>{{ trans('messages.section_health') }}</h2>
    <ul class="list-inline">
        @foreach( Category::findBySlug('health')->subCategories() as $posts_cat )
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
</div>

<div class=list>
    @foreach( $frontend_current_category->getPosts() as $post )
    @if($post->translate()->title != '')
    <div class="post">
        <div class="post-title">
            <h3>
                <a href="{{ URL::to($post->getSlug()) }}">
                    {{ $post->translate()->title }}
                </a>
            </h3>
            <p class="date">{{ $post->getTranslatedCreatedAt() }}</p>
        </div>
        <div class="row">
            @if( $post->hasImage() )
            <div class="post-thumb col-sm-6">
                <img class="video-cover" src="{{ $post->getImageUrl() }}" alt="...">
            </div>
            <div class="post-excerpt col-sm-6">
            @else
            <div class="post-excerpt col-sm-12">
            @endif
                {{ $post->translate()->getExcerpt() }}
                <br>
                <a href="{{ URL::to($post->getSlug()) }}">
                    {{ trans('messages.continue-reading') }}
                </a>
            </div>
        </div>
    </div>
    @endif
    @endforeach

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
    <div class=clearfix></div>
    <a class=to-top href=#content> <span class="glyphicon glyphicon-chevron-up"></span>頁首 </a>
    -->
</div>

<div class="clearfix"></div>
<a class="to-top" href="#hometop">
    <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
</a>

@stop