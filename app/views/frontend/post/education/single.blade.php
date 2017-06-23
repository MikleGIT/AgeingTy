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
        {{ trans('messages.section_learning') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
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
                @if( $frontend_current_post->getMetaValue('organization') )
                <tr>
                    <td class="item">{{ trans('messages.learning_course_organization') }}</td>
                    <td class="desc">{{ $frontend_current_post->getMetaValue('organization') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('detail') )
                <tr>
                    <td>{{ trans('messages.learning_course_info') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('detail') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('address') )
                <tr>
                    <td>{{ trans('messages.learning_course_address') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('address') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('start_at') )
                <tr>
                    <td>{{ trans('messages.learning_course_date') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('start_at') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('lesson_time') )
                <tr>
                    <td>{{ trans('messages.learning_course_time') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('lesson_time') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('language') )
                <tr>
                    <td>{{ trans('messages.learning_course_language') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('language') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('duration') )
                <tr>
                    <td>{{ trans('messages.learning_course_duration') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('duration') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('quota') )
                <tr>
                    <td>{{ trans('messages.learning_course_quota') }}</td>
                    <td>
                        {{ $frontend_current_post->getMetaValue('quota') }}
                    </td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('audience') )
                <tr>
                    <td>{{ trans('messages.learning_course_audience') }}</td>
                    <td>
                        {{ $frontend_current_post->getMetaValue('audience') }}
                    </td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('fee') )
                <tr>
                    <td>{{ trans('messages.learning_course_fee') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('fee') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('apply') )
                <tr>
                    <td>{{ trans('messages.learning_course_apply') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('apply') }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('contact') )
                <tr>
                    <td>{{ trans('messages.learning_course_contact') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('contact') }}</td>
                </tr>
                @endif

                 @if( $frontend_current_post->getMetaValue('remark') )
                <tr>
                    <td>{{ trans('messages.learning_course_remark') }}</td>
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