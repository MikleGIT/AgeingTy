@extends('frontend.page.consult.master')

@section('body')

@stop

@section('rightcontent')

<style>
.table th {
    border: 1px solid #BEDA9D !important;
    border-bottom: 2px solid #BEDA9D !important;
    cursor: pointer;
}
</style>
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
</div>

<div class="page-header">
    <h2>{{ trans('messages.section_event') }}</h2>
    <ul class="list-inline">
        @foreach( Category::findBySlug('event')->subCategories() as $posts_cat )
        <li>
            <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                {{ $posts_cat->translate()->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>

<div class="sheet">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th data-sort="string" class="column_class">{{ trans('messages.event_name') }} <span class="glyphicon glyphicon-triangle-bottom"></span></th>
                <th data-sort="string" class="column_duration">{{ trans('messages.event_place') }} <span class="glyphicon glyphicon-triangle-bottom"></span></th>
                <th data-sort="string" class="column_fee">{{ trans('messages.event_date') }} <span class="glyphicon glyphicon-triangle-bottom"></span></th>
                <th data-sort="string" class="column_quota">{{ trans('messages.event_quota') }} <span class="glyphicon glyphicon-triangle-bottom"></span></th>
                <th data-sort="string" class="column_start">{{ trans('messages.event_contact') }} <span class="glyphicon glyphicon-triangle-bottom"></span></th>
            </tr>
        </thead>
        @foreach( $frontend_current_category->getPosts() as $post )
        <tr>
            <td>
                <a href="{{ $post->getSlug() }}">{{ $post->translate()->title }}</a>
            </td>
            <td>
                {{ $post->getMetaValue('place') }}
            </td>
            <td>
                {{ $post->getMetaValue('date') }}
            </td>
            <td>
                {{ $post->getMetaValue('quota') }}
            </td>
            <td>
                {{ $post->getMetaValue('contact') }}
            </td>
        </tr>
        @endforeach
    </table>

    <!--
    <div class="page-nav">
        <ul class="list-inline">
            <li><a href="#">上一頁</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>...</li>
            <li><a href="#">10</a></li>
            <li><a href="#">下一頁</a></li>
        </ul>
        <form role="pagination" class="page-selector">
            <div class="input-group">
                <span class="input-group-addon">到</span>
                <input type="text" class="form-control" aria-label="到哪頁">
                <span class="input-group-addon">頁</span>
            </div>
            <button type="submit" class="btn btn-theme">去</button>
        </form>
    </div>
    -->

    <div class="clearfix"></div>
    <a class="to-top" href="#hometop">
        <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
    </a>
</div>

@stop


@section('js')
<script src="{{ asset('frontend/scripts/stupidtable.min.js') }}"></script>
<script>
$(".table").stupidtable();
</script>
@stop