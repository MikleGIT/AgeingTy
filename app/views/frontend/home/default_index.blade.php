<!doctype html>
<html class="no-js" lang="{{ Config::get('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <!-- disable responsiveness -->
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <title>
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
		.link_a a{text-decoration:none; color:#000;}
        </style>
    </head>
    <body style="margin:0 auto; text-align:center; background:#fdffd7;">
        <!--[if lt IE 8]>
            <p class="browserupgrade">你正使用<strong>過時的</strong>瀏覽器，請<a href="http://browsehappy.com/">更新你的瀏覽器</a>以獲取更優質的體驗。</p>
        <![endif]-->
        <!-- start of header -->
        <div style="background:url({{ asset('frontend/images/wecome.jpg') }}) no-repeat #fdffd7; width:998px; margin:0 auto; text-align:center;">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="66" style="font-family:'微軟正黑體', 'Adobe 黑体 Std R','微軟雅黑'; font-weight:bold; font-size:44px; text-align:center;" tabindex="1">澳門特區長者服務資訊網</td>
  </tr>
  <tr>
    <td height="30" style="font-family:'微軟正黑體', 'Adobe 黑体 Std R','微軟雅黑',Arial, Helvetica, sans-serif; font-weight:800; font-size:24px; text-align:center;" tabindex="2">Página Electrónica sobre as Informações dos Serviços a Idosos da RAEM</td>
  </tr>
  <tr>
    <td height="470">&nbsp;</td>
  </tr>
  <tr>
    <td style="font-family:'微軟正黑體', 'Adobe 黑体 Std R','微軟雅黑'; font-weight:bold; font-size:28px; text-align:center; color:#206648;" tabindex="3">家庭照顧，原居安老；積極參與，躍動耆年。</td>
  </tr>
  <tr>
    <td style="font-family:'微軟正黑體', 'Adobe 黑体 Std R','微軟雅黑'; font-weight:bold; font-size:18px; text-align:center; color:#647c04;" tabindex="4">Prestação de cuidados pela família e manutenção dos idosos no domicílio;<br /> 
promoção da participação social e do envelhecimento activo.</td>
  </tr>
  <tr>
    <td height="58" style="font-family:'微軟正黑體', 'Adobe 黑体 Std R','微軟雅黑'; font-weight:bold; font-size:30px; text-align:center;" class="link_a">
   @foreach( Language::getAvailableLanguages() as $lang )
   	@if( $lang->code == 'cn' ) 
    <a href="{{ action('LanguageController@setIndexLang', array($lang->code)) }}"  tabindex="5">繁體</a>
    @endif
   @endforeach
     &nbsp;|&nbsp; 
   @foreach( Language::getAvailableLanguages() as $lang )
    @if( $lang->code == 'gb' ) 
    <a href="{{ action('LanguageController@setIndexLang', array($lang->code)) }}" tabindex="6">简体</a>
    @endif
   @endforeach
     &nbsp;|&nbsp; 
   @foreach( Language::getAvailableLanguages() as $lang )
    @if( $lang->code == 'pt' ) 
    <a href="{{ action('LanguageController@setIndexLang', array($lang->code)) }}" tabindex="7">Português</a>
    @endif
   @endforeach
    </td>
  </tr>
  <tr>
    <td height="65">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" style="font-family:'微軟正黑體', 'Adobe 黑体 Std R','微軟雅黑';font-size:12px; text-align:center; color:#FFF;" tabindex="8">使用1280x1024或更高解像度可得更佳瀏覽效果 澳門特別行政區政府社會工作局 版權所有 © 2016</td>
  </tr>
</table>
</div>
<script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
          ga('create', 'UA-65729441-1', 'auto');
          ga('send', 'pageview');
         
        </script>
</body>
</html>