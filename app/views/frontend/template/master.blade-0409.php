<!doctype html>
<html class="no-js" lang="{{ Config::get('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <!-- disable responsiveness -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <title>
        @yield('title') | 
        {{ trans('messages.consult_sitename') }}
        </title>

        <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#269b57">
        <meta name="msapplication-TileImage" content="/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="{{ asset('frontend/styles/main.css') }}">
        <script src="{{ asset('frontend/scripts/vendor/modernizr.js') }}"></script>


        <style>
        .footer {
            margin-top: 30px !important;
        }

        table p {
            margin: 0;
            padding: 0;
        }

        table th {
            vertical-align: middle !important;
        }
        </style>

        <link href="{{ asset('frontend/player/video-js.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('frontend/player/video.js') }}"></script>
    </head>
    <body class="{{ (isset($cssName) ? $cssName : '') }} l {{ (in_array(Config::get('app.locale'), array('cn', 'gb'))) ? 'east' : 'west' }}">
        <!--[if lt IE 8]>
            <p class="browserupgrade">你正使用<strong>過時的</strong>瀏覽器，請<a href="http://browsehappy.com/">更新你的瀏覽器</a>以獲取更優質的體驗。</p>
        <![endif]-->
        <!-- start of header -->
        <a name="hometop" class="notabindex"></a>
        <div class="header container-fluid" role="banner">
            <div class="row">
                <div class="container">
                    <div class="sub-nav">
                        <ul class="lang list-inline pull-left">
                            @foreach( Language::getAvailableLanguages() as $lang )
                            @if( $lang->code == 'en' )
                            <?php continue; ?>
                            @endif
                            <li>
                                <a href="{{ action('LanguageController@setLang', array($lang->code)) }}">{{ $lang->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <ul style="float:left;">
                        	<li style="font-size:16px; list-style:none; width:400px; padding-top:5px; text-align:right;"><a href="javascript:void(0);" style="text-decoration:none; cursor:default;">{{ trans('messages.top_alert_text') }}</a></li>
                        </ul>
                        <ul class="fontsize-selector pull-right list-inline serif">
                            <li>{{ trans('messages.font_size') }}</li><li class="xl"><a href="#" title="{{ trans('messages.font_size_a1') }}">{{ trans('messages.font_size_a1') }}</a></li><li class="xxl"><a href="#" title="{{ trans('messages.font_size_a2') }}">{{ trans('messages.font_size_a2') }}</a></li><li class="xxxl"><a href="#" title="{{ trans('messages.font_size_a3') }}">{{ trans('messages.font_size_a3') }}</a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div>
                    	<li style="float:left; list-style:none;">
                        	<h1 class="title">
                                {{ trans('messages.sitename_br') }}
                            </h1>
                        </li>
                        <li style="float:right; list-style:none; width:250px; padding-right:0px; padding-top:8px;">
                        	<a href="http://www.ageing.ias.gov.mo/consult/documents"><img src="{{ asset('frontend/images/banner_top.png') }}" height="75" alt="{{ trans('messages.banner_top_text') }}" title="{{ trans('messages.banner_top_text') }}" /></a>
                        </li>
                    </div>
                </div>
            </div>
        </div>


        <!-- end of header -->
        <!-- start of main-container -->
        <div class="container main">
            <div{{ (isset($cssName) && $cssName == 'home') ? ' class="row"' : '' }}>
                <!-- start of aside -->
                <div class="{{ (isset($cssName) && $cssName == 'home') ? 'col-sm-4 ' : '' }}aside-wrap">
                    <div class="{{ (isset($cssName) && $cssName != 'home') ? 'col-sm-4 ' : '' }}aside match" data-mh="match-group">
                        <a href="#content" class="sr-only sr-only-focusable">跳至內容</a><!-- for Accessibility -->
                        <ul role="navigation" class="section-nav list-unstyled">
                            <li>
                                <a class="menu-home" href="{{ action('HomeController@index') }}">
                                    {{ trans('messages.home') }}
                                </a>
                            </li>
                            
                            @foreach( Category::getRootCategories() as $root_category )

                            @if( in_array($root_category->section, array('feedback')) )
                            <?php continue; ?>
                            @endif

                            <li>
                                @if( in_array($root_category->section, array('about', 'discount', 'contact', 'news')) )
                                <a class="menu-{{ $root_category->cssName() }}" href="{{ URL::to($root_category->getSlug()) }}">
                                    {{ $root_category->translate()->name }}
                                </a>
                                @else
                                <a class="menu-{{ $root_category->cssName() }}" data-toggle="collapse" href="#collapse-{{ $root_category->cssName() }}" aria-expanded="false" aria-controls="collapse-{{ $root_category->cssName() }}">
                                    {{ $root_category->translate()->name }}
                                </a>
                                @endif

                                <div class="collapse" id="collapse-{{ $root_category->cssName() }}">
                                    <ul class="children menu-{{ $root_category->cssName() }} list-unstyled">
                                        @foreach( Category::findBySlug($root_category->slug)->subCategories() as $subcategory )
                                        <li>
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
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div>
                            <form id="searchbox_002741241179678120054:riedrobfeaw" action="{{ action('HomeController@searchGoogle') }}">
                                <div class="form-group">
                                        <label class="sr-only" for="searchbox">{{ trans('messages.search') }}</label>
                                        <input value="002741241179678120054:riedrobfeaw" name="cx" type="hidden"/>
                                        <input value="FORID:11" name="cof" type="hidden"/>
                                        <input name="q" type="text" class="form-control" id="searchbox" placeholder="{{ trans('messages.search-keyword') }}" tabindex="1" value="{{ Input::get('q', '') }}">
                                </div>
                                <button type="submit" name="sa" class="btn btn-search btn-full">{{ trans('messages.search') }}</button>
                            </form>
<!--                            <a href="#search" class="gotosearch sr-only sr-only-focusable">跳至搜尋</a>-->
                        </div>

                        <?php /*
                        <script src="{{ asset('frontend/scripts/jwplayer/jwplayer.js') }}"></script>
                        <script>jwplayer.key="4vY2+T4B3jNRLYCGMz7F89kuPzaspNdeaM+JIQ==";</script>
                        <div style="margin-top: 30px">
                            <div id="player">Loading the player...</div>
                        </div>
                        <script type="text/javascript">
                        var playerInstance = jwplayer("player");
                        playerInstance.setup({
                            file: "http://ageing.bpprojects.com/uploads/elderly_Video18_h264.mp4",
                            width: 310,
                            height: 200,
                        });
                        </script>
                        */ ?>

                        
  
                        <!-- Unless using the CDN hosted version, update the URL to the Flash SWF -->

                        <?php /*
                        <script>
                            _V_.options.flash.swf = "video-js.swf";
                        </script>

                        <div style="height: 12px"></div>
                        <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="310" height="200" poster="" data-setup="{}" alt="關愛長者" title="關愛長者">
                            <source src="http://www.ias.gov.mo/wp-content/themes/ias/ageing/movies/1/1.mp4" type='video/mp4' alt="關愛長者" title="關愛長者" />
                        </video>
                        */ ?>

                        <div style="height: 12px"></div>
                        <div id="jp_container_1" style="margin:0 auto; text-align:center;" class="jp-video jp-video-360p" role="application" aria-label="media player">
                            <div class="jp-type-single">
                                <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                                <div class="jp-gui">
                                    <div class="jp-video-play">
                                        <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
                                    </div>
                                    <div class="jp-interface">
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                        <div class="jp-controls-holder">
                                            <div class="jp-controls">
                                                <button class="jp-play" role="button" tabindex="0">play</button>
                                                <button class="jp-stop" role="button" tabindex="0">stop</button>
                                            </div>
                                            <div class="jp-volume-controls">
                                                <button class="jp-mute" role="button" tabindex="0">mute</button>
                                                <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                                <div class="jp-volume-bar">
                                                    <div class="jp-volume-bar-value"></div>
                                                </div>
                                            </div>
                                            <div class="jp-toggles">
                                                <button class="jp-repeat" role="button" tabindex="0">repeat</button>
                                                <button class="jp-full-screen" role="button" tabindex="0">full screen</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center" style="margin-top: 12px">
                            <a href="{{ asset('') }}{{ trans('messages.download-home-video-title') }}" target="_blank">
                                {{ trans('messages.download-home-video-subtitle') }}
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end of aside -->
                <!-- start of content -->
                <div class="{{ (isset($cssName) && $cssName == 'home') ? 'col-sm-8 ' : '' }} main-wrap">
                    <div role="main" id="content" class="{{ (isset($cssName) && $cssName != 'home') ? 'col-sm-8 ' : '' }}content match" data-mh="match-group" tabindex="0 "><!-- jump to content - for Accessibility -->
                        @yield('rightcontent')
                    </div>
                </div>
                <!-- end of content -->
            </div>
        </div>
        <!-- eng of main-container -->
        <!-- start of footer -->
        <div class="footer text-center">
            <div class="container">
                <div class="sitemap">
                    <h2><a href="/sitemap">{{ trans('messages.website-guide') }}</a></h2>
                    <ul class="list-inline">
                        <li><a class="foot_menu" href="{{ action('HomeController@index') }}">{{ trans('messages.home') }}</a></li>

                        @foreach( Category::getRootCategories() as $root_category )

                        @if( in_array($root_category->section, array('feedback')) )
                        <?php continue; ?>
                        @endif
                        <li><a class="menu-{{ $root_category->cssName() }}" href="{{ URL::to($root_category->getSlug()) }}">{{ $root_category->translate()->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <p style="display:block; margin:0 auto; text-align:center;"><a href="http://www.ias.gov.mo/" target="_blank"><img src="http://www.ias.gov.mo/wp-content/themes/ias/images/logo.png" height="70" alt="{{ trans('messages.ias_webname') }}" title="{{ trans('messages.ias_webname') }}" /></a></p>
                <div style="margin:0 auto; text-align:center; width:900px;">
                	<div style="float:left; width:90px;">
                    	<a href="http://www.w3.org/WAI/WCAG2AA-Conformance"
      title="Explanation of WCAG 2.0 Level Double-A Conformance" target="_blank">

  <img height="32" width="88" 
          src="http://www.w3.org/WAI/wcag2AA"
          alt="Level Double-A conformance, 
          W3C WAI Web Content Accessibility Guidelines 2.0"></a>
                    </div>
                    <div style="float:left; width:738px;">
                        <p>{{ trans('messages.footer_copyright') }}</p>
                        <p><a href="{{ trans('messages.privacy_url') }}" target="_blank">{{ trans('messages.privacy') }}</a> {{ trans('messages.best-view') }}</p>
                   </div>
                </div>
            </div>

            <!--
            <div class="container">
                <div class="sitemap">
                    <h5>{{ trans('messages.site_map') }}</h5>
                    <ul class="list-inline">
                        @foreach( Category::findBySlug('consult')->subCategories() as $subcategory )
                        <li>
                            <a href="{{ URL::to($subcategory->getSlug()) }}"{{ (isset($frontend_current_category) && $frontend_current_category->getFilteredSlug() == $subcategory->getFilteredSlug()) ? ' class="active"' : '' }}>
                                {{ $subcategory->translate()->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <p>{{ trans('messages.footer_phone_number') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ trans('messages.footer_email') }}<a href="mailto: ageing@ias.gov.mo">ageing@ias.gov.mo</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ trans('messages.footer_address') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ trans('messages.footer_copyright') }}</p>
            </div>
            -->
        </div>
        <!-- end of footer -->
        
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
          ga('create', 'UA-65729441-1', 'auto');
          ga('send', 'pageview');
         
        </script>
        <script src="{{ asset('frontend/scripts/vendor.js') }}"></script>
        <script src="{{ asset('frontend/scripts/plugins.js') }}"></script>
        <script src="{{ asset('frontend/scripts/main.js') }}"></script>

        <link type="text/css" href="{{ asset('frontend/styles/ui/jquery.ui.theme.css') }}" rel="stylesheet" />
        <link type="text/css" href="{{ asset('frontend/styles/ui/jquery.ui.selectmenu.css') }}" rel="stylesheet" />
        <script src="{{ asset('frontend/scripts/ui/jquery.ui.core.js') }}"></script>
        <script src="{{ asset('frontend/scripts/ui/jquery.ui.widget.js') }}"></script>
        <script src="{{ asset('frontend/scripts/ui/jquery.ui.position.js') }}"></script>
        <script src="{{ asset('frontend/scripts/ui/jquery.ui.selectmenu.js') }}"></script>

        <script src="{{ asset('frontend/scripts/fancybox/jquery.fancybox.pack.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('frontend/scripts/fancybox/jquery.fancybox.css') }}">

        @yield('js')

        <script>
        $(function(){
            var tabindex = 3;
			//$(".menu-home").attr("tabindex", 1);
			$('a,button,#content,input,select,video, .tab-content, .panel-body').each(function() {
            //$('a,button,#content,input,select,video,.tab-pane').each(function() {
                if (this.type != "hidden") {
                    var $input = $(this);
					if($input.attr("class") != "notabindex"){
						$input.attr("tabindex", tabindex);
						tabindex++;
						$(".sr-only-focusable").attr("tabindex", 1);
						//$(".gotosearch").attr("tabindex", 2);
					}
                }
            });
			$("#searchbox").attr("tabindex", 2);

            $('select#consult_id').selectmenu();

            @if( isset($cssName) && !in_array($cssName, array('benefits', 'intro', 'contact')) )
            $("#collapse-{{ $cssName }}").collapse('show');
            @endif
        });


        $(function() { //this is much better then $(document).ready(function(){});

            $('span.watch-video').each(function(i, el) {

                $(el).closest('a').click(function(event) { //select class attribute jwVideo assigned to a tag

                    event.preventDefault(); //prevent default click..if this isn't here then browser will download the mp4 file instead of embedding jwplayer in fancybox

                    var myVideo = $(this).attr('href'); // select the video link from a tag in jwVideo class

                    //in the fancybox jwplayer setup code assign myVideo to file
                    $.fancybox({
                        maxWidth    : 640,
                        maxHeight   : 480,
                        fitToView   : false,
                        width       : '70%',
                        height      : '70%',
                        autoSize    : false,
                        closeClick  : false,
                        openEffect  : 'none',
                        closeEffect : 'none',
                        //content: '<div id="video_container">Loading the player ... </div>',
                        content: '<video class="video-js vjs-default-skin" controls preload="none" width="640" height="480" poster="" data-setup="{}" autoplay><source src="' + myVideo + '" type="video/mp4" /></video>',
                        afterShow: function(){
                            // jwplayer("video_container").setup({ 
                            //     file: ""+ myVideo +"",
                            //     image: "",
                            //     width: '100%',
                            //     aspectratio: '16:9',
                            //     fallback: 'false',
                            //     autostart: 'true',
                            //     primary: 'flash',
                            //     controls: 'true'
                            // });
                        }
                    });
                });
            });

        });
        </script>

        <link href="{{ asset('frontend/skin/blue.monday/css/jplayer.blue.monday.css') }}" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.jplayer.min.js') }}"></script>
        <script type="text/javascript">
        //<![CDATA[
        $(document).ready(function(){
            $("#jquery_jplayer_1").jPlayer({
                ready: function () {
                    $(this).jPlayer("setMedia", {
                        //title: "test1",
                        m4v: "http://www.ias.gov.mo/wp-content/themes/ias/ageing/movies/41.mp4",
						webmv: "http://www.antidrugs.gov.mo/anti/web/cn/test_player/mp4/1.webm",
                        poster: "{{ asset('Video.jpg') }}"
                    });
                },
                swfPath: "js",
                //title:"test3",
                supplied: "m4v, webmv",
                size: {
                    width: "268",
                    height: "170",
                    cssClass: "jp-video-360p"
                },
                useStateClassSkin: true,
                autoBlur: false,
                smoothPlayBar: true,
                keyEnabled: false,
                remainingDuration: true,
                toggleDuration: true
            });
        });
        //]]>
		$(document).ready(function(){
			if($.cookie('TEXT_SIZE') == "l"){
				$(".xxl").addClass("select");
			}else if($.cookie('TEXT_SIZE') == "xl"){
				$(".xl").addClass("select");
			}else if($.cookie('TEXT_SIZE') == "xxl"){
				$(".xxl").addClass("select");
			}else if($.cookie('TEXT_SIZE') == "xxxl"){
				$(".xxxl").addClass("select");
			}else{
				$(".xxl").addClass("select");	
			}
			$(".fontsize-selector a").click(function(){
				$(".fontsize-selector li").removeClass("select");
				if($.cookie('TEXT_SIZE') == "xl"){
					$(".xl").addClass("select");	
				}else if($.cookie('TEXT_SIZE') == "xxl"){
					$(".xxl").addClass("select");
				}else if($.cookie('TEXT_SIZE') == "xxxl"){
					$(".xxxl").addClass("select");
				}else{
					$(".xxl").addClass("select");
				}
			});
		});
        </script>

    </body>
</html>