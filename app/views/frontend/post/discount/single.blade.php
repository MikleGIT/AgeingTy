@extends('frontend.page.consult.master')

@section('body')

@stop

@section('rightcontent')
<h2 class="access">你現在網站里的位置</h2>
<div class="breadcrumb">
    <a href="{{ URL::to('/') }}">
        {{ trans('messages.home') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to(Category::findBySlug('discount')->getSlug()) }}">
        {{ trans('messages.title-discount') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
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
                @if( $frontend_current_post->getMetaValue('organization', App::getLocale()) )
                <tr>
                    <td class="item">{{ trans('messages.discount_organization') }}</td>
                    <td class="desc">{{ $frontend_current_post->getMetaValue('organization', App::getLocale()) }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('discount', App::getLocale()) )
                <tr>
                    <td>{{ trans('messages.discount_info') }}</td>
                    <td>
                        {{ nl2br($frontend_current_post->getMetaValue('discount', App::getLocale())) }}

                        @if( $frontend_current_post->getMetaValue('discount_image', App::getLocale()) )
                        <p>
                            <a href="{{ asset($frontend_current_post->getMetaValue('discount_image', App::getLocale())) }}" target="_blank">
                                <img src="{{ asset($frontend_current_post->getMetaValue('discount_image', App::getLocale())) }}" alt="">
                            </a>
                        </p>
                        @endif
                    </td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('address', App::getLocale()) )
                <tr>
                    <td>{{ trans('messages.discount_address') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('address', App::getLocale()) }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('contact', App::getLocale()) )
                <tr>
                    <td>{{ trans('messages.discount_contact') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('contact', App::getLocale()) }}</td>
                </tr>
                @endif

                @if( $frontend_current_post->getMetaValue('date', App::getLocale()) )
                <tr>
                    <td>{{ trans('messages.discount_date') }}</td>
                    <td>{{ $frontend_current_post->getMetaValue('date', App::getLocale()) }}</td>
                </tr>
                @endif
            </table>
        </div>
        <a href="{{ URL::previous() }}" class="btn btn-theme">
            {{ trans('messages.back') }}
        </a>
    </div>

    <div class="clearfix"></div>
    <a class="to-top" href="#hometop">
        <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
    </a>

</div>

@stop



@section('js')
<script type="text/javascript">
$(function(){
    $('select#benefits_id').selectmenu();
});
</script>
@stop