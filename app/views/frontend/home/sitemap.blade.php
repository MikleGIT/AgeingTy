@extends('frontend.template.master')

@section('title', trans('messages.website-guide'))

@section('rightcontent')
<style type="text/css">
.main-wrap{background:#FFF;}
.page-header{margin-bottom:10px;}
#sitemap a{text-decoration:none; color:#000;}
.menu_one{list-style:none; font-weight:700;}
.menu_two{list-style:inside;}
</style>
<h2 class="access">你現在網站里的位置</h2>
<div class="breadcrumb"> <a href="/home"> {{ trans('messages.home') }} </a> <span> > </span> {{ trans('messages.website-guide') }} </div>
<div class="page-header">
  <h2>{{ trans('messages.website-guide') }}</h2>
</div>
<div class="sheet">
  <div class="article">
    <div class="post"> 
      <!--<h3 class="post-title text-center">{{ trans('messages.website-guide') }}</h3>-->
      <div class="post-content">
        <ul class="list" id="sitemap">
          <li class="menu_one"><a class="menu-home" href="{{ action('HomeController@index') }}">{{ trans('messages.home') }}</a></li>
          @foreach( Category::getRootCategories() as $root_category )
            @if( in_array($root_category->section, array('feedback')) )
            <?php continue; ?>
            @endif
          <li class="menu_one">
          	@if( in_array($root_category->section, array('about', 'discount', 'contact', 'news')) )
            <a class="menu-{{ $root_category->cssName() }}" href="{{ URL::to($root_category->getSlug()) }}">
                {{ $root_category->translate()->name }}
            </a>
            @else
                <a class="menu-{{ $root_category->cssName() }}" href="{{ URL::to($root_category->getSlug()) }}">
                    {{ $root_category->translate()->name }}
                </a>
				<ul class="sub-menu">
                @foreach( Category::findBySlug($root_category->slug)->subCategories() as $subcategory )
                  <li class="menu_two">
                  	@if (URL::to($subcategory->getSlug()) == 'http://www.ageing.ias.gov.mo/health/tips')
                    <a href="http://www.ageing.ias.gov.mo/health/video"{{ (isset($frontend_current_category) && $frontend_current_category->getFilteredSlug() == $subcategory->getFilteredSlug()) ? ' class="active"' : '' }}>
                        {{ $subcategory->translate()->name }}
                    </a>
                @else
                    <a href="{{ URL::to($subcategory->getSlug()) }}"{{ (isset($frontend_current_category) && $frontend_current_category->getFilteredSlug() == $subcategory->getFilteredSlug()) ? ' class="active"' : '' }}>
                        {{ $subcategory->translate()->name }}
                    </a>
                @endif
                  </li>
                  @endforeach
                </ul>
            @endif
          </li>
		@endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>
<a class="to-top" href="#hometop"> <span class="glyphicon glyphicon-chevron-up"></span>{{ trans('messages.back-to-top') }} </a> @stop