@extends('frontend.page.consult.master')

@section('body')

@stop

@section('rightcontent')
<div class="post">
    <h3 class="post-title text-center headline">{{ $frontend_current_category->translate()->name }}</h3>
    <div class="sheet-article">
        {{ $frontend_current_category->getPage()->translate()->content }}
    </div>

    <h3 class="post-title text-center headline">{{ trans('messages.submit_your_comment') }}</h3>

    @if( Session::get('success') )
    <div class="alert alert-success text-center">
        {{ trans('messages.consult_comment_submitted') }}
    </div>
    @endif

    <div class="post-content">
        {{ Form::open( array('url' => action('HomeController@submitContact'), 'method' => 'post', 'role' => 'form', 'id' => 'message_form') ) }}
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
            <div class="form-group textarea">
                    <label for="commentbox">{{ trans('messages.consult_comment_message') }}</label>
                    <textarea name="message" class="form-control" rows="6" placeholder="{{ trans('messages.consult_comment_message_placeholder') }}" id="commentbox"></textarea>
                </div>
            <button type="submit" class="btn btn-primary btn-full btn-theme">{{ trans('messages.submit') }}</button>
        {{ Form::close() }}
    </div>
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

    //$('form').on('submit', function(e) {
	$('#message_form').on('submit', function(e) {
        e.preventDefault();

        var message = $('textarea[name="message"]').val();

        if( message == '' ) {
            alert('{{ trans('messages.consult_comment_message_placeholder') }}');
            return;
        }

        this.submit();
    });
});
</script>
@stop