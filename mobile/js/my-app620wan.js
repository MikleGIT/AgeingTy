// Export selectors engine
var $$ = Dom7;
// Initialize your app
var myApp = new Framework7({
     pushState: true,
     swipeBackPage: true,
     hideToolbarOnPageScroll: true,
     hideTabbarOnPageScroll: true,
     scrollTopOnStatusbarClick: true,
     smartSelectOpenIn:'popup',
     dynamicPageUrl: '{{name}}'   // 开启动态页面的命名，依据data-page的名字
});


// Add view
var mainView = myApp.addView('.view-main', {
    // Because we use fixed-through navbar we can enable dynamic navbar
    dynamicNavbar: true
});

    $$('a[href="#view-1"]').click(function(e){
        e.preventDefault();
        mainView.router.load({url: '/',animatePages:false});
    });



//  common tpl  nav
var common_data = '';
var common_tpl ='<section class="collapse   section--full" id="cat-nav">' +
                '<ul role="navigation" class="section-nav list-unstyled">' +
                    '<li><a class="menu-advisory" data-toggle="collapse" href="#collapse-advisory" aria-expanded="false" aria-controls="collapse-advisory">tpl-養老保障機制</a>' +
                        '<div class="collapse" id="collapse-advisory">' +
                            '<ul class="children menu-advisory list-unstyled">' +
                                '<li><a href="#">背景</a></li>' +
                                '<li><a href="#">宗旨、對象及理念原則</a></li>' +
                                '<li><a class="active" href="#">機制構成</a></li>' +
                                '<li><a href="#">政策框架</a></li>' +
                                '<li><a href="#">醫社服務</a></li>' +
                                '<li><a href="#">權益保障</a></li>' +
                                '<li><a href="#">社會參與</a></li>' +
                                '<li><a href="#">生活環境</a></li>' +
                                '<li><a href="#">協作、推行與評檢</a></li>' +
                                '<li><a href="#">文本下載</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</li>' +
                    '<li><a class="menu-learning" data-toggle="collapse" href="#collapse-learning" aria-expanded="false" aria-controls="collapse-learning">學習</a>' +
                        '<div class="collapse" id="collapse-learning">' +
                            '<ul class="children menu-learning list-unstyled">' +
                                '<li><a href="education.html">課程資訊</a></li>' +
                                '<li><a href="#">學習小貼士</a></li>' +
                                '<li><a href="#">通訊錄</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</li>' +
                    '<li><a class="menu-health" data-toggle="collapse" href="#collapse-health" aria-expanded="false" aria-controls="collapse-health">健康</a>' +
                        '<div class="collapse" id="collapse-health">' +
                            '<ul class="children menu-health list-unstyled">' +
                                '<li><a href="health.html">長者健聞</a></li>' +
                                '<li><a href="health_disease.html">疾病知識</a></li>' +
                                '<li><a href="health_video.html">保健貼士</a></li>' +
                                '<li><a href="health_info.html">通訊錄</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</li>' +
                    '<li><a class="menu-event" data-toggle="collapse" href="#collapse-event" aria-expanded="false" aria-controls="collapse-event">活動</a>' +
                        '<div class="collapse" id="collapse-event">' +
                            '<ul class="children menu-event list-unstyled">' +
                                '<li><a href="event.html">全部</a></li>' +
                                '<li><a href="event.html">文化藝術</a></li>' +
                                '<li><a href="event_health.html">運動養生</a></li>' +
                                '<li><a href="event_finance.html">退休理財</a></li>' +
                                '<li><a href="event_relationships.html">人際關係</a></li>' +
                                '<li><a href="event_other.html">其他</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</li>' +
                    '<li><a class="menu-service" data-toggle="collapse" href="#collapse-service" aria-expanded="false" aria-controls="collapse-service">服務</a>' +
                        '<div class="collapse" id="collapse-service">' +
                            '<ul class="children menu-service list-unstyled">' +
                                '<li><a href="service.html">健康照顧</a></li>' +
                                '<li><a href="#">經濟保障</a></li>' +
                                '<li><a href="#">房屋政策</a></li>' +
                                '<li><a href="#">文娛康體</a></li>' +
                                '<li><a href="#">日常生活</a></li>' +
                                '<li><a href="#">其他</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</li>' +
                    '<li><a class="menu-benefits" href="benefits.html">優惠</a></li>' +
                    '<li><a class="menu-news" data-toggle="collapse" href="#collapse-news" aria-expanded="false" aria-controls="collapse-news">新聞</a>' +
                        '<div class="collapse" id="collapse-news">' +
                            '<ul class="children menu-news list-unstyled">' +
                                '<li><a href="#">總覽</a></li>' +
                                '<li><a href="#">福利政策資訊</a></li>' +
                                '<li><a href="#">特别消息</a></li>' +
                                '<li><a href="#">活動訊息</a></li>' +
                            '</ul>' +
                       '</div>' +
                    '</li>' +

                '</ul>' +
            '</section>';
var common_html = juicer(common_tpl, common_data);



$$(document).on('pageInit', function (e) {
  // Do something here when page loaded and initialized
  // 所有页面都会用到的公共js 部分


     $$('.okay').click(function() {
        $$('.header__more').addClass('hide')
    }), $$('.header__bar__bookmark a').click(function() {
        $$('.header__bar__bookmark a .fa').toggleClass('fa-star-o').toggleClass('fa-star')
    }), $$('#cat-nav').on('show.bs.collapse', function() {
        $$('.header__bar__title .fa').toggleClass('fa-angle-up').toggleClass('fa-angle-down')
    }), $$('#cat-nav').on('hide.bs.collapse', function() {
        $$('.header__bar__title .fa').toggleClass('fa-angle-up').toggleClass('fa-angle-down')
    }),
    $('a[href="#cat-nav"]').trigger('click'),

  // 文章过滤器
   $$('.filter__trigger').click(function() {
        $$('.filter__option').toggleClass('hide');
    });
    $$('.filter__option__item').click(function() {
        $$('.filter__option__item').removeClass('active');
        $$(this).toggleClass('active');
    });

    $$('.icon-back').addClass('color-white');

 $$('.J_link').on('click', function () {

         alert('22');});


// discount data fresh
    $$('.left>.close-popup').on('click', function(){
      var formData = myApp.formToJSON('#my-form');

     console.log( ajaxDomain +'/api/'+ formData.slug);
            $$.getJSON( ajaxDomain +'/api/'+ formData.slug,function(data){
                   //删除表格
                $$('.J_table').remove();
                    //新建表头
                $$('<table align="center" cellpadding="5" rules="all" style="border:3px #c5dfa7 solid;padding:5px;" class="J_table">'+
                        '<colgroup>'+
                            '<col span="1" style="width: 10%;">'+
                            '<col span="1" style="width: 90%;">'+
                        '</colgroup>'+
                        '<tbody>'+
                            '<tr>'+
                                '<td style="text-align: center; vertical-align: middle; border-color: #e0d34d; background-color: rgb(248, 248, 254);">'+
                                    '<p style="text-align:center"><span style="color:#333;"><strong>商號/機構</strong></span></p>'+
                                '</td>'+
                                '<td style="text-align: center; vertical-align: middle; border-color: #e0d34d; background-color: rgb(248, 248, 254);">'+
                                    '<p style="text-align:center"><span style="color:#333;"><strong>優惠內容</strong></span></p>'+
                                '</td>'+
                           '</tr>'+
                        '</tbody>'+
                    '</table>').appendTo('.discount_section');

                for (var i = 0; i <= data.length; i++) {
                    var it = data[i];
                //     console.log(it);

                    $$('<tr><td><a class="J_link" href="'+ ajaxDomain + '/api/discount/detail/'  + it.id +'">'+it.organization+'</a></td><td><p>'+'<a class="J_link" href="'+ ajaxDomain + '/api/discount/detail/' + it.id +'">'+ it.title + '</a></p></td></tr>').appendTo('.J_table > tbody:last-child');
                }



            });


    });
//   pop end //
//
//


})



// ajax API URL Config
// ajaxDomain 是网址主体，
// example: ajaxUrl = 'http://localhost:8000/api/education';
//var ajaxDomain               = 'http://localhost:8000';Ag/AgeingAppDev/t2/AgeingAppDev-master/public
var ajaxDomain               = 'http://localhost/Ag/t2/AgeingAppDev-master/public';
//var ajaxDomain               = 'http://localhost:8000';
var ajaxIndexCarousel        = '/api/carousel';
var ajaxEdu                  = '/api/education';

//  新聞
var ajaxNews                 = '/api/news/announcement';
var ajaxNewsEvents           = '/api/news/events';
var ajaxNewsWelfare          = '/api/news/welfare';

//  优惠
var ajaxDiscount             = '/api/discount/';


//  服務
var ajaxService    = '/api/service/healthcare';

//  健康
var ajaxHealthNews           = '/api/health/news';
var ajaxHealthDisease        = '/api/health/disease';
var ajaxHealthVideo          = '/api/health/video';
var ajaxHealthPublication    = '/api/health/publication';
var ajaxHealthResources      = '/api/health/resources';
var ajaxHealthLinks          = '/api/health/links';
var ajaxHealthInfo           = '/api/health/info';

//  活動
var ajaxEvent                = '/api/event/art';
var ajaxEventHealth          = '/api/event/health';
var ajaxEventFinance         = '/api/event/finance';
var ajaxEventRelation        = '/api/event/relationships';
var ajaxEventOther           = '/api/event/other';

// page: 首页初始化数据
myApp.onPageInit('index-1', function (page) {

    $$.ajax({
        url: ajaxDomain + ajaxIndexCarousel,
        type: 'GET',
        beforeSend: function(){
            if(document.getElementById('tpl_J_slide') == null) return false;
        },
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            // console.log(objData.model);
            // 定义模板的数据和DOM
            var data = objData;
            if(document.getElementById('tpl_J_slide') == null) return false;
            var tpl = document.getElementById('tpl_J_slide').innerHTML;
            var html = juicer(tpl, data);
            //  注入数据和DOM
            $$("div#tpl_slide").html(html);

            //  index swiper config
            var mySwiper1 = myApp.swiper('.swiper-1', {
                pagination: '.swiper-1 .swiper-pagination',
                paginationClickable: true,
                paginationBulletRender: function (swiper, index, className) {
                    return '<span class="' + className + '">' + (index + 1) + '</span>';
                }
            });
        }
    });
}).trigger();


// page: 学习教育    category.html
myApp.onPageInit('category', function (page) {
    $$("div#tpl_common_nav").html(common_html);

    $$.ajax({
        url: ajaxDomain + ajaxEdu,
        type: 'GET',
        async:false,
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
      //    console.log(objData.list[0].id);
      //    objData.list[0].id 获取到第一条的id值
      //    objData.list[link_url]  新增的JSON key，
            var id = '';  //  建立id和url的变量简称
            for(var p in objData.list){
                //    console.log( objData.list[p].id);   // 遍历出所有id值
                id = objData.list[p].id;
                objData.list[p]["link_url"] = ajaxDomain + ajaxEdu +'/' + id;  // 新增一个链接key
            };
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_edu').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_edu").html(html);
        }
    });

//动态路由,根据上面的链接，点击生成内容页
//

    var html ='';

    $$('.J_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址
    console.log(href);
          $$.ajax({
            url: href ,  // 动态路径  942要换成动态变量
            type: 'GET',
            async:false,
            success: function (getData) {
                // 转换Json数据成对象
                var a = JSON.stringify(getData);
                var j = JSON.parse(a);
                var obj = '{"list":';
                obj += j ;
                obj += '}';
                var objData = JSON.parse(obj);
               // console.log(objData);
                // 定义模板的数据和DOM
                var data = objData;
                var tpl = document.getElementById('tpl_J_edu_detail').innerHTML;

                html = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(html);
            mainView.router.loadContent(html);

    });


//  生成内容有 end  //

//  无限滚动  //
    // Loading flag
    var loading = false;
    // Last loaded index
    var lastIndex = $$('.post-list li').length;
    // 最多可加载的条目
    var maxItems = 60;
    // 每次加载添加多少条目 Append items per load
    var itemsPerLoad = 10;
    // Attach 'infinite' event handler
    $$('.infinite-scroll').on('infinite', function () {
        // Exit, if loading in progress // 如果正在加载，则退出
        if (loading) return;
        // Set loading flag  // 设置flag
        loading = true;
        // Emulate 1s loading  // 模拟1s的加载过程
        setTimeout(function () {
            // Reset loading flag
            loading = false;
            if (lastIndex >= maxItems) {
                // 加载完毕，则注销无限加载事件，以防不必要的加载
                // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
                myApp.detachInfiniteScroll($$('.infinite-scroll'));
                // Remove preloader  // 删除加载提示符
                $$('.infinite-scroll-preloader').remove();
                return;
            }

            // Generate new items HTML 生成新的补充html
            //
            $$.getJSON( ajaxDomain + ajaxEdu,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.post-list li').length;
        }, 1000);
    });
//  无限滚动  end  //
});








/* 内容页index 里面放tpl, category 里面放data判断  这个单独html的js废弃
//废弃
// page / detail: 学习教育,文章页 single.html
myApp.onPageInit('single', function (page) {
    $$.ajax({
        url: ajaxDomain + ajaxEdu + '/' + '942',  // 动态路径  942要换成动态变量
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            console.log(objData + '文章页内容');
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_edu_detail').innerHTML;

            var html = juicer(tpl, data);
             console.log(html);
            // 注入数据和DOM
            $$("div#tpl_edu_detail").html(html);
        }
    });
});

*/



/*
* 新闻
 */
// page:  新闻总览  news.html (原category2.html)
myApp.onPageInit('news', function (page) {
    $$("div#tpl_common_nav").html(common_html);

    $$.ajax({
        url: ajaxDomain + ajaxNews,
        type: 'GET',
        async:false,
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
      //    console.log(objData.list[0].id);
      //    objData.list[0].id 获取到第一条的id值
      //    objData.list[link_url]  新增的JSON key，
            var id = '';  //  建立id和url的变量简称
            for(var p in objData.list){
                //    console.log( objData.list[p].id);   // 遍历出所有id值
                id = objData.list[p].id;
                objData.list[p]["link_url"] = ajaxDomain + '/api/news/detail/' + id;  // 新增一个链接key
            };
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_news').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_news").html(html);
        }
    });

//动态路由,根据上面的链接，点击生成内容页
//

    var html ='';

    $$('.J_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址
    console.log(href);
          $$.ajax({
            url: href ,  // 动态路径  942要换成动态变量
            type: 'GET',
            async:false,
            success: function (getData) {
                // 转换Json数据成对象
                var a = JSON.stringify(getData);
                var j = JSON.parse(a);
                var obj = '{"list":';
                obj += j ;
                obj += '}';
                var objData = JSON.parse(obj);
                 console.log(objData);
                // 定义模板的数据和DOM
                var data = objData;
                var tpl = document.getElementById('tpl_J_news_detail').innerHTML;

                html = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(html);
            mainView.router.loadContent(html);

    });


//  生成内容有 end  //

//  无限滚动  //
    // Loading flag
    var loading = false;
    // Last loaded index
    var lastIndex = $$('.post-list li').length;
    // 最多可加载的条目
    var maxItems = 60;
    // 每次加载添加多少条目 Append items per load
    var itemsPerLoad = 10;
    // Attach 'infinite' event handler
    $$('.infinite-scroll').on('infinite', function () {
        // Exit, if loading in progress // 如果正在加载，则退出
        if (loading) return;
        // Set loading flag  // 设置flag
        loading = true;
        // Emulate 1s loading  // 模拟1s的加载过程
        setTimeout(function () {
            // Reset loading flag
            loading = false;
            if (lastIndex >= maxItems) {
                // 加载完毕，则注销无限加载事件，以防不必要的加载
                // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
                myApp.detachInfiniteScroll($$('.infinite-scroll'));
                // Remove preloader  // 删除加载提示符
                $$('.infinite-scroll-preloader').remove();
                return;
            }

            // Generate new items HTML 生成新的补充html
            //
            $$.getJSON( ajaxDomain + ajaxEdu,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.post-list li').length;
        }, 1000);
    });
//  无限滚动  end  //
});



// page:  No.2  news_events.html 活動訊息
myApp.onPageInit('news_events', function (page) {
    $$("div#tpl_common_nav").html(common_html);

    $$.ajax({
        url: ajaxDomain + ajaxNewsEvents,
        type: 'GET',
        async:false,
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
      //    console.log(objData.list[0].id);
      //    objData.list[0].id 获取到第一条的id值
      //    objData.list[link_url]  新增的JSON key，
            var id = '';  //  建立id和url的变量简称
            for(var p in objData.list){
                //    console.log( objData.list[p].id);   // 遍历出所有id值
                id = objData.list[p].id;
                objData.list[p]["link_url"] = ajaxDomain + '/api/news/detail/' + id;  // 新增一个链接key
            };
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_news_events').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_news_events").html(html);
        }
    });

//动态路由,根据上面的链接，点击生成内容页
//

    var html ='';

    $$('.J_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址
    console.log(href);
          $$.ajax({
            url: href ,  // 动态路径  942要换成动态变量
            type: 'GET',
            async:false,
            success: function (getData) {
                // 转换Json数据成对象
                var a = JSON.stringify(getData);
                var j = JSON.parse(a);
                var obj = '{"list":';
                obj += j ;
                obj += '}';
                var objData = JSON.parse(obj);
                 console.log(objData);
                // 定义模板的数据和DOM
                var data = objData;
                var tpl = document.getElementById('tpl_J_news_detail').innerHTML;

                html = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(html);
            mainView.router.loadContent(html);

    });


//  生成内容有 end  //

//  无限滚动  //
    // Loading flag
    var loading = false;
    // Last loaded index
    var lastIndex = $$('.post-list li').length;
    // 最多可加载的条目
    var maxItems = 60;
    // 每次加载添加多少条目 Append items per load
    var itemsPerLoad = 10;
    // Attach 'infinite' event handler
    $$('.infinite-scroll').on('infinite', function () {
        // Exit, if loading in progress // 如果正在加载，则退出
        if (loading) return;
        // Set loading flag  // 设置flag
        loading = true;
        // Emulate 1s loading  // 模拟1s的加载过程
        setTimeout(function () {
            // Reset loading flag
            loading = false;
            if (lastIndex >= maxItems) {
                // 加载完毕，则注销无限加载事件，以防不必要的加载
                // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
                myApp.detachInfiniteScroll($$('.infinite-scroll'));
                // Remove preloader  // 删除加载提示符
                $$('.infinite-scroll-preloader').remove();
                return;
            }

            // Generate new items HTML 生成新的补充html
            //
            $$.getJSON( ajaxDomain + ajaxEdu,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.post-list li').length;
        }, 1000);
    });
//  无限滚动  end  //
});


// page:  No.3  news_welfare.html 福利政策資訊
myApp.onPageInit('news_welfare', function (page) {
    $$("div#tpl_common_nav").html(common_html);

    $$.ajax({
        url: ajaxDomain + ajaxNewsWelfare,
        type: 'GET',
        async:false,
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
      //    console.log(objData.list[0].id);
      //    objData.list[0].id 获取到第一条的id值
      //    objData.list[link_url]  新增的JSON key，
            var id = '';  //  建立id和url的变量简称
            for(var p in objData.list){
                //    console.log( objData.list[p].id);   // 遍历出所有id值
                id = objData.list[p].id;
                objData.list[p]["link_url"] = ajaxDomain + '/api/news/detail/' + id;  // 新增一个链接key
            };
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_news_welfare').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_news_welfare").html(html);
        }
    });

//动态路由,根据上面的链接，点击生成内容页
//

    var html ='';

    $$('.J_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址

          $$.ajax({
            url: href ,  // 动态路径  942要换成动态变量
            type: 'GET',
            async:false,
            success: function (getData) {
                // 转换Json数据成对象
                var a = JSON.stringify(getData);
                var j = JSON.parse(a);
                var obj = '{"list":';
                obj += j ;
                obj += '}';
                var objData = JSON.parse(obj);
                 console.log(objData);
                // 定义模板的数据和DOM
                var data = objData;
                var tpl = document.getElementById('tpl_J_news_detail').innerHTML;

                html = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(html);
            mainView.router.loadContent(html);

    });


//  生成内容有 end  //

//  无限滚动  //
    // Loading flag
    var loading = false;
    // Last loaded index
    var lastIndex = $$('.post-list li').length;
    // 最多可加载的条目
    var maxItems = 60;
    // 每次加载添加多少条目 Append items per load
    var itemsPerLoad = 10;
    // Attach 'infinite' event handler
    $$('.infinite-scroll').on('infinite', function () {
        // Exit, if loading in progress // 如果正在加载，则退出
        if (loading) return;
        // Set loading flag  // 设置flag
        loading = true;
        // Emulate 1s loading  // 模拟1s的加载过程
        setTimeout(function () {
            // Reset loading flag
            loading = false;
            if (lastIndex >= maxItems) {
                // 加载完毕，则注销无限加载事件，以防不必要的加载
                // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
                myApp.detachInfiniteScroll($$('.infinite-scroll'));
                // Remove preloader  // 删除加载提示符
                $$('.infinite-scroll-preloader').remove();
                return;
            }

            // Generate new items HTML 生成新的补充html
            //
            $$.getJSON( ajaxDomain + ajaxEdu,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.post-list li').length;
        }, 1000);
    });
//  无限滚动  end  //
});







/*
* 服务
*/


// page:  健康服務/api/service/healthcare service.html (原category3.html)
myApp.onPageInit('service', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxService + '?page=1&pn=3', //ajaxHealthTips   localhost:8000/api/service/healthcare
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);

// console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_service').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_service").html(html);

//  无限滚动  //
    // Loading flag
    var loading = false;
    // Last loaded index
    var lastIndex = $$('.panel-group').children('.panel').length ;
    //
    // 最多可加载的条目
    var maxItems = 60;
    // 每次加载添加多少条目 Append items per load
    var itemsPerLoad = 3;
    // Attach 'infinite' event handler
    $$('.infinite-scroll').on('infinite', function () {
        // Exit, if loading in progress // 如果正在加载，则退出

        if (loading) return;
        // Set loading flag  // 设置flag
        loading = true;
        // Emulate 1s loading  // 模拟1s的加载过程
        setTimeout(function () {
            // Reset loading flag
            loading = false;
            if (lastIndex >= maxItems) {
                // 加载完毕，则注销无限加载事件，以防不必要的加载
                // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
                myApp.detachInfiniteScroll($$('.infinite-scroll'));
                // Remove preloader  // 删除加载提示符
                $$('.infinite-scroll-preloader').remove();
                return;
            }

            // Generate new items HTML 生成新的补充html
            var page = Math.ceil(lastIndex/itemsPerLoad) + 1;

            $$.getJSON( ajaxDomain + ajaxService + '?page='+page+'&pn='+itemsPerLoad,function(data){
                if(data.length == 0) {
                    myApp.detachInfiniteScroll($$('.infinite-scroll'));
                    // Remove preloader  // 删除加载提示符
                    $$('.infinite-scroll-preloader').remove();
                    return;
                }

                for (var i = 0; i < itemsPerLoad; i++) {
                    var it = data[i];
                    var idx = lastIndex + i + 1;
                    $$('.panel-group').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-'+idx+'" aria-expanded="false" aria-controls="collapse-'+idx+'"   class="">'+it.title+'</a></h4></div><div id="collapse-'+idx+'" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" aria-labelledby="heading-'+idx+'"><div class="panel-body">'+it.content+'</div></div></div>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.panel-group').children('.panel').length + itemsPerLoad;

        }, 1000);
    });
//  无限滚动  end  //

        }
    });
    });


/**
 * 健康
 */

// page: 长者新闻    health_news.html
myApp.onPageInit('health_news', function (page) {
    $$("div#tpl_common_nav").html(common_html);

    $$.ajax({
        url: ajaxDomain + ajaxHealthNews,
        type: 'GET',
        async:false,
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
      //    console.log(objData.list[0].id);
      //    objData.list[0].id 获取到第一条的id值
      //    objData.list[link_url]  新增的JSON key，
            var id = '';  //  建立id和url的变量简称
            for(var p in objData.list){
                //    console.log( objData.list[p].id);   // 遍历出所有id值
                ////***   这和个用的是slug ***////
                id = objData.list[p].slug;
                ////***   TODO   没有具体API路径 ，去掉中间的'/api/'  只能用实际web网址 ***////
                objData.list[p]["link_url"] = ajaxDomain + id;  // 新增一个链接key
            };
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_news').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_news").html(html);
        }
    });

//动态路由,根据上面的链接，点击生成内容页
//

    var html ='';

    $$('.J_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址
    console.log(href);
          $$.ajax({
            url: href ,  // 动态路径  942要换成动态变量
            type: 'GET',
            async:false,
            success: function (getData) {
                // 转换Json数据成对象
                var a = JSON.stringify(getData);
                var j = JSON.parse(a);
                var obj = '{"list":';
                obj += j ;
                obj += '}';
                var objData = JSON.parse(obj);
                 console.log(objData);
                // 定义模板的数据和DOM
                var data = objData;
                var tpl = document.getElementById('tpl_J_edu_detail').innerHTML;

                html = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(html);
            mainView.router.loadContent(html);

    });


//  生成内容有 end  //

//  无限滚动  //
    // Loading flag
    var loading = false;
    // Last loaded index
    var lastIndex = $$('.post-list li').length;
    // 最多可加载的条目
    var maxItems = 60;
    // 每次加载添加多少条目 Append items per load
    var itemsPerLoad = 10;
    // Attach 'infinite' event handler
    $$('.infinite-scroll').on('infinite', function () {
        // Exit, if loading in progress // 如果正在加载，则退出
        if (loading) return;
        // Set loading flag  // 设置flag
        loading = true;
        // Emulate 1s loading  // 模拟1s的加载过程
        setTimeout(function () {
            // Reset loading flag
            loading = false;
            if (lastIndex >= maxItems) {
                // 加载完毕，则注销无限加载事件，以防不必要的加载
                // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
                myApp.detachInfiniteScroll($$('.infinite-scroll'));
                // Remove preloader  // 删除加载提示符
                $$('.infinite-scroll-preloader').remove();
                return;
            }

            // Generate new items HTML 生成新的补充html
            //
            $$.getJSON( ajaxDomain + ajaxEdu,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.post-list li').length;
        }, 1000);
    });
//  无限滚动  end  //
});



// page:  疾病知识  health_disease.html
myApp.onPageInit('health_disease', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxHealthDisease,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);

            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_disease').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_disease").html(html);
        }
    });
});



/*
*   保健贴士- 保健短片、 保健宣传刊物 、 卫生教育资源  、  相关链接
*/
// page / health_video : 保健短片 health_video.html
myApp.onPageInit('health_video', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxHealthVideo,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_video').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_video").html(html);
        }
    });
});

// page / health_publication : 保健宣传刊物 health_publication.html
myApp.onPageInit('health_publication', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxHealthPublication,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_publication').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_publication").html(html);
        }
    });
});
// page / health_resources : 卫生教育资源 health_resources.html
myApp.onPageInit('health_resources', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxHealthResources,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_resources').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_resources").html(html);
        }
    });
});
// page / health_links : 相关链接 health_links.html
myApp.onPageInit('health_links', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxHealthLinks,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_links').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_links").html(html);
        }
    });
});




// page / health_info : 健康通讯录 health_info.html
myApp.onPageInit('health_info', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxHealthInfo,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_health_info').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_health_info").html(html);
        }
    });
});


/*
* 活動
 */

// page / event : 活動 event.html
myApp.onPageInit('event', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxEvent,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_event').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_event").html(html);
        }
    });
});

// page / No.2 event_health : 運動養生 event_healht.html
myApp.onPageInit('event_health', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxEventHealth,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_event_health').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_event_health").html(html);
        }
    });
});

// page / No.3 event_finance : 退休理財 event__finance.html
myApp.onPageInit('event_finance', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxEventFinance,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_event_finance').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_event_finance").html(html);
        }
    });
});


// page / No.4 event_relation : 人機關係 event_relation.html
myApp.onPageInit('event_relationships', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxEventRelation,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_event_relationships').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_event_relationships").html(html);
        }
    });
});


// page / No.5 event_other : 活動其他 event_other.html
myApp.onPageInit('event_other', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxEventOther,
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            //console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_event_other').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_event_other").html(html);
        }
    });
});


/*
*  优惠
 */
var ajaxDiscount             = '/api/discount/';


// page /  discount : 优惠 discount.html
myApp.onPageInit('discount', function (page) {
    $$("div#tpl_common_nav").html(common_html);

      $$.getJSON( ajaxDomain + '/api/discount',function(data){

                for (var i = 0; i <= data.length; i++) {
                    var it = data[i];
                  //  console.log(it);
                  $$('<tr><td><a href="'+ ajaxDomain + '/api/discount'+ '/' + it.id +'">'+it.organization+'</a></td><td><p>'+ it.title + '</p></td></tr>').appendTo('.J_table > tbody:last-child');
                }
            });


//动态路由,根据上面的链接，点击生成内容页
//

    var html ='';

    $$('.J_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址
         alert('22');
    console.log('2');
        //   $$.ajax({
        //     url: href ,  // 动态路径
        //     type: 'GET',
        //     async:false,
        //     success: function (getData) {
        //         // 转换Json数据成对象
        //         //
        //         //
        //         console.log(getData);

        //         var a = JSON.stringify(getData);
        //         var j = JSON.parse(a);
        //         var obj = '{"list":';
        //         obj += j ;
        //         obj += '}';
        //         var objData = JSON.parse(obj);
        //        // console.log(objData);
        //         // 定义模板的数据和DOM
        //         var data = objData;
        //         var tpl = document.getElementById('tpl_J_edu_detail').innerHTML;

        //         html = juicer(tpl, data);
        //     }
        // });
            // 注入数据和DOM
            // console.log(html);
            mainView.router.loadContent(html);

    });


//  生成内容有 end  //
//


});

//

