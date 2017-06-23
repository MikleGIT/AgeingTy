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
        {{ trans('messages.section_event') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>

    <span> > </span>
    <a href="#">
        {{ trans('messages.info') }}
    </a>
</div>
<div class="sheet-article">
    <div class="post">
        <div class="post-title">
            <h2>{{ $frontend_current_post->translate()->title }}</h2>
            <p class="date">{{ $frontend_current_post->getTranslatedCreatedAt() }}</p>
        </div>
        <div class="post-content">

            <table class="table">
                @if( $frontend_current_post->getMetaValue('date') )
                <tr>
                    <td class="item">{{ trans('messages.event_date') }}</td>
                    <td class="desc">{{ $frontend_current_post->getMetaValue('date') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('place') )
                <tr>
                    <td>{{ trans('messages.event_place') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('place') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('performer') )
                <tr>
                    <td>{{ trans('messages.event_performer') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('performer') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('organization') )
                <tr>
                    <td>{{ trans('messages.event_organization') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('organization') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('fee') )
                <tr>
                    <td>{{ trans('messages.event_fee') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('fee') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('contact') )
                <tr>
                    <td>{{ trans('messages.event_contact') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('contact') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('remark') )
                <tr>
                    <td>{{ trans('messages.event_remark') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('remark') }}</td>
                </tr>
                @endif
            </table>

            {{ $frontend_current_post->translate()->content }}

        </div>
        <a href="{{ URL::previous() }}" class="btn btn-theme">{{ trans('messages.back') }}</a>
    </div>

    <div class="clearfix"></div>
    <a class="to-top" href="#hometop">
        <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
    </a>
</div>

@stop