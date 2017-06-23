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
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
</div>

<div class="page-header">
    <h2>{{ trans('messages.title-discount') }}</h2>
</div>
<div class="sheet">
    <div class="form-group input-group">
        <label class="sr-only input-theme" for="benefits_id">{{ trans('messages.discount-type') }}</label>
        <span class="input-group-addon input-theme">{{ trans('messages.discount-type') }}</span>
        <select name="benefits_id" id="benefits_id" class="form-control">
            <option value="" disabled selected>{{ trans('messages.please-select-discount-type') }}</option>
            <option value="{{ URL::to( Category::findBySlug('discount')->getSlug() ) }}">
                {{ trans('messages.all') }}
            </option>

            @foreach( $frontend_current_category->subCategories() as $subcategory )
            <optgroup class="input-theme" label="{{ $subcategory->translate()->name }}">
                @foreach( $subcategory->subCategories() as $subsubcategory )
                <option value="{{ URL::to($subsubcategory->getSlug()) }}">-- {{ $subsubcategory->translate()->name }}</option>
                @endforeach
            </optgroup>
            @endforeach

        </select>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <td class="column_duration">{{ trans('messages.discount_organization') }}</td>
                <td class="column_class">{{ trans('messages.discount_info') }}</td>
            </tr>
        </thead>

        @foreach( Category::findBySlug('discount')->getPosts() as $post )
        <tr>
            <td>
                <a href="{{ $post->getSlug() }}">
                    {{ $post->getMetaValue('organization', App::getLocale()) }}
                </a>
            </td>
            <td>
                <a href="{{ $post->getSlug() }}">
                    {{ $post->translate()->title }}
                </a>
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
    <div class="clearfix"></div>
    <a class="to-top" href="#hometop">
        <span class="glyphicon glyphicon-chevron-up"></span>頁首
    </a>
    -->

</div>

<div class="clearfix"></div>
<a class="to-top" href="#hometop">
    <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
</a>

@stop



@section('js')
<script type="text/javascript">
$(function(){
    $('select#benefits_id').selectmenu();

    $('select#benefits_id').on('selectmenuchange', function(e) {
        var $el = $(e.currentTarget);

        window.location = $el.find('option:selected').val();
    });
});
</script>
@stop