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
        {{ trans('messages.section_consult') }}
    </a>
    <span> > </span>
    <a href="{{ URL::to($frontend_current_category->getSlug()) }}">
        {{ $frontend_current_category->translate()->name }}
    </a>
</div>

<div class="page-header">
    <h2>{{ trans('messages.section_consult') }}</h2>
    <ul class="list-inline">
        @foreach( Category::findBySlug('consult')->subCategories() as $posts_cat )
        <li>
            <a href="{{ URL::to($posts_cat->getSlug()) }}"{{ (isset($frontend_current_category_id) && $frontend_current_category_id == $posts_cat->id) ? ' class="active"' : '' }}>
                {{ $posts_cat->translate()->name }}
            </a>
        </li>
        @endforeach
    </ul>
</div>

@if( Session::get('success') )
<div class="alert alert-success text-center">
    {{ trans('messages.consult_comment_submitted') }}
</div>
@endif


<div class="hentry">
    <h3 class="entry-title text-center">{{ trans('messages.consult_document_download') }}</h3>
    <div class="entry-content">
        <table class="table table-hover">
            @foreach( ConsultDocument::orderBy('created_at', 'ASC')->get() as $consult )
            @if( !$consult->hasFile() )
            <?php continue; ?>
            @endif

            <tr>
                <td class="col-sm-9">{{ $consult->translate()->title }}</td>

                @if( $consult->hasFile() )
                <td class="text-right col-sm-3"><a href="{{ $consult->getFileUrl() }}" target="_blank"><div class="download_ico_{{ trans('messages.download_ico_lan') }}"></div><span class="download_ico_title_{{ trans('messages.download_ico_lan') }}" aria-hidden="true">{{ trans('messages.download') }}</span></a></td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
</div>

<?php /*
<div class="hentry">
    <h3 class="entry-title text-center">{{ trans('messages.consult_submit_your_comment') }}</h3>
    <div class="entry-content">
        {{ Form::open( array('url' => action('HomeController@submitConsultComment'), 'method' => 'post', 'onsubmit' => 'return checkForm()') ) }}
            <div class="form-group input-group">
                <label class="sr-only" for="name-input">{{ trans('messages.consult_name') }}</label>
                <span class="input-group-addon">{{ trans('messages.consult_name') }}</span>
                <input type="text" name="name" class="form-control" placeholder="{{ trans('messages.consult_name_placeholder') }}" id="name-input">
            </div>
            <div class="form-group input-group">
                <label class="sr-only" for="contact-input">{{ trans('messages.consult_contact') }}</label>
                <span class="input-group-addon">{{ trans('messages.consult_contact') }}</span>
                <input type="text" name="contact" class="form-control" placeholder="{{ trans('messages.consult_contact_placeholder') }}" id="contact-input">
            </div>
            <div class="form-group input-group">
                <label class="sr-only" for="consult_id">{{ trans('messages.consult_question') }}</label>
                <span class="input-group-addon">{{ trans('messages.consult_question') }}</span>

                <select name="consult_id" id="consult_id" class="form-control">
                @foreach( Consult::getConsultsForSelect() as $id => $consult )
                    <option value="{{ $id }}">
                        <span>{{ $consult }}</span>
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group textarea">
                    <label for="commentbox">{{ trans('messages.consult_comment_message') }}</label>
                    <textarea class="form-control" id="commentbox" name="message" rows="6" placeholder="{{ trans('messages.consult_comment_message_placeholder') }}"></textarea>
                </div>
            <button type="submit" class="btn btn-primary btn-full">{{ trans('messages.submit') }}</button>
        {{ Form::close() }}
    </div>
</div>
*/ ?>

<div class="clearfix"></div>
<a class="to-top" href="#hometop">
    <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }}
</a>

@stop


@section('js')
<link type="text/css" href="{{ asset('frontend/styles/ui/jquery.ui.theme.css') }}" rel="stylesheet" />
<link type="text/css" href="{{ asset('frontend/styles/ui/jquery.ui.selectmenu.css') }}" rel="stylesheet" />
<script src="{{ asset('frontend/scripts/ui/jquery.ui.core.js') }}"></script>
<script src="{{ asset('frontend/scripts/ui/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('frontend/scripts/ui/jquery.ui.position.js') }}"></script>
<script src="{{ asset('frontend/scripts/ui/jquery.ui.selectmenu.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('select#consult_id').selectmenu();
    });
</script>

<script>
function checkForm() {
    var consult_id = $('select[name="consult_id"] option:selected').val();
    var consult_message = $('textarea[name="message"]').val();

    if( consult_id == 0 ) {
        alert('{{ trans('messages.please_select_consult_document') }}');
        return false;
    }

    if( consult_message == '' ) {
        alert('{{ trans('messages.please_input_consult_message') }}');
        return false;
    }

    return true;
}
</script>
@stop