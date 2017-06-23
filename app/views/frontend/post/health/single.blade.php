@extends('frontend.page.consult.master')

@section('title', $frontend_current_post->translate()->title)

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

<div class="article">
    <div class="post">
        <div class="post-title">
            <h3>{{ $frontend_current_post->translate()->title }}</h3>
            <p class="date">{{ $frontend_current_post->getTranslatedCreatedAt() }}</p>
        </div>
        
        <div class="post-content">
            {{ nl2br($frontend_current_post->translate()->content) }}
        </div>
        <a href="{{ URL::to($frontend_current_category->getRootCategory()->getSlug()) }}" class="btn btn-theme">
        	{{ trans('messages.back') }}
        </a>
    </div>

    @if( count($frontend_current_category->getPostsExcept($frontend_current_post_id)) > 0 )
    <div class="next-article">
        <h4>{{ trans('messages.next-news') }}</h4>
        <div class="row">

            @foreach( $frontend_current_category->getPostsExcept($frontend_current_post_id) as $more_news )
            <div class="col-sm-6">
                <div class="post">
                        <p class="date">{{ $more_news->getTranslatedCreatedAt() }}</p>
                        <a href="{{ $more_news->getSlug() }}">{{ $more_news->translate()->title }}
                            <div class="post-thumb">
                                @if( $more_news->hasImage() )
                                <img class="video-cover" src="{{ $more_news->getImageUrl() }}" alt="...">
                                @else
                                
                                @endif
                            </div>
                        </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="clearfix"></div>
    <a class="to-top" href="#hometop">
        <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
    </a>
</div>

@stop