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
        <li>
            <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                {{ $posts_cat->translate()->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>


<div class="sheet">

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        @foreach( Category::findBySlug($frontend_current_category->getFilteredSlug())->subCategories() as $cat_index => $posts_cat )

        @if( count($posts_cat->getPosts()) == 0 )
        <?php continue; ?>
        @endif
        @if($posts_cat->translate()->name != '')
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="cat-group-{{ $posts_cat->id }}">
                <h4 class="panel-title">
                    <a role="button"<?php /*{{ ($cat_index > 0) ? ' class=collapsed' : '' }}*/ ?> data-toggle="collapse" data-parent="#accordion--" href="#collapse-{{ $posts_cat->id }}" aria-expanded="{{ ($cat_index > 0) ? 'true' : 'false' }}" aria-controls="collapse-{{ $posts_cat->id }}">
                        {{ $posts_cat->translate()->name }}
                    </a>
                </h4>
            </div>
			
            <div id="collapse-{{ $posts_cat->id }}" class="panel-collapse collapse<?php /*{{ ($cat_index == 0) ? ' in' : '' }}*/ ?>" role="tabpanel" aria-labelledby="{{ $posts_cat->translate()->name }}">
                <div class="panel-body">
                    <ul class="nav nav-tabs" role="tablist">

                        @foreach( $posts_cat->getPosts() as $i => $post )
                        <li role="post-{{ $post->id }}"{{ ($i == 0) ? ' class="active"' : '' }}>
                            <a href="#post-{{ $post->id }}" aria-controls="post-{{ $post->id }}" role="tab" data-toggle="tab">
                                {{ $post->translate()->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach( $posts_cat->getPosts() as $i => $post )
                        <div role="tabpanel" class="tab-pane{{ ($i == 0) ? ' active' : '' }}" id="post-{{ $post->id }}">
                            {{ $post->translate()->content }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach

    </div>
    

    <a class="to-top" href="#hometop">
        <span class="glyphicon glyphicon-chevron-up"></span>
        {{ trans('messages.back-to-top') }}
    </a>
</div>


@stop