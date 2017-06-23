// Export selectors engine
var $$ = Dom7;
// Initialize your app
var myApp = new Framework7({
     cache: false,  // ajax暂时不缓存
     pushState: true,
     animateNavBackIcon: true,
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



//  common tpl  nav
var common_data = '';
var common_tpl ='<section class="collapse   section--full" id="cat-nav">' +
                '<ul role="navigation" class="section-nav list-unstyled">' +
                    '<li><a class="menu-advisory" data-toggle="collapse" href="#collapse-advisory" aria-expanded="false" aria-controls="collapse-advisory">養老保障機制</a>' +
                        '<div class="collapse" id="collapse-advisory">' +
                            '<ul class="children menu-advisory list-unstyled">' +
                                '<li><a class="J_consult_link" href="/challenge">宗旨、對象及理念原則</a></li>' +
                                '<li><a class="J_consult_link" href="/construction">機制構成</a></li>' +
                                '<li><a class="J_consult_link" href="/principle">長者服務十年行動計劃</a></li>' +
                                '<li><a class="J_consult_link" href="/health">醫社服務</a></li>' +
                                '<li><a class="J_consult_link" href="/rights">權益保障</a></li>' +
                                '<li><a class="J_consult_link" href="/society">社會參與</a></li>' +
                                '<li><a class="J_consult_link" href="/living">生活環境</a></li>' +
                                '<li><a class="J_consult_link" href="/cooperation">協作、推行與評檢</a></li>' +
                                '<li><a class="J_consult_link" href="/documents">文本下載</a></li>' +
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
    });
     $$('.header__bar__bookmark a').click(function() {
        $$('.header__bar__bookmark a .fa').toggleClass('fa-star-o').toggleClass('fa-star')
    });

////   TODO  nav >< arrow
    //  $$('#cat-nav').click(function() {

    //     $$('.fa').toggleClass('fa-angle-down');

    // });



  // 文章过滤器
   $$('.filter__trigger').click(function() {
        $$('.filter__option').toggleClass('hide');
    });
    $$('.filter__option__item').click(function() {
        $$('.filter__option__item').removeClass('active');
        $$(this).toggleClass('active');
    });

    $$('.icon-back').addClass('color-white');




//  新闻列表   动态生成    动态路由,根据上面的链接，点击生成内容页
//

    var newsHtml ='';

    $$('.J_news_link').on('click', function () {
       //  $$(".tpl_common_nav").html(common_html);
         var href = $$(this).attr('href');  // 获取动态网址
        // console.log(href);
        $$.ajax({
            url: ajaxDomain + '/api/news' +href ,  // 动态路径
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
                //console.log(     data );
                var tpl = document.getElementById('tpl_J_news_list').innerHTML;
                newsHtml = juicer(tpl, data);
                var pageheader = '';
                var datapage = '';
                if (href === '/events') {
                    datapage = 'news_events';
                    pageheader = '活動訊息';
                    newsHtml = newsHtml.replace(/status_b/, 'active');
                    newsHtml = newsHtml.replace(/tpl_common_nav/, 'tpl_common_nav news_events_name');
                }
                if (href === '/welfare') {
                    datapage = 'news_welfare';
                    pageheader = '福利政策資訊';
                    newsHtml = newsHtml.replace(/status_c/, 'active');
                    newsHtml = newsHtml.replace(/tpl_common_nav/, 'tpl_common_nav news_welfare_name');
                }
                newsHtml = newsHtml.replace(/tpl_common_nav_bd/, common_html);

                newsHtml = newsHtml.replace(/cat-nav/g, 'cat-nav1');
                newsHtml = newsHtml.replace(/collapse-/g, 'collapse-1');
                newsHtml = newsHtml.replace(/datapage/g, datapage);
                newsHtml = newsHtml.replace(/pageheader/, pageheader);
            }
        });
        //  生成内容有 end  //
        // 注入数据和DOM
        mainView.router.loadContent(newsHtml);
    });

    // 注入数据 end
        //
    //动态路由,根据上面的链接，点击生成内容页

    var newsDetailhtml ='';
    $$('.J_news_detail_link').on('click', function () {
        var href = $$(this).attr('href');  // 获取动态网址
    //   console.log(href);
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

                newsDetailhtml = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(newsDetailhtml);
            mainView.router.loadContent(newsDetailhtml);
    });

//  新闻列表   动态生成  end  //




/**********    服务页面    ***********/
//  服务页面   动态生成    动态路由,根据上面的链接，点击生成内容页
//

    var serviceHtml ='';

    $$('.J_service_link').on('click', function () {
       //  $$(".tpl_common_nav").html(common_html);
         var href = $$(this).attr('href');  // 获取动态网址
        // console.log(href);

        $$.ajax({
            url: ajaxDomain + '/api/service/healthcare' +href ,  // 动态路径
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


                var data = objData;
                //console.log(     data );
                var tpl = document.getElementById('tpl_J_service_list').innerHTML;
                serviceHtml = juicer(tpl, data);
                var pageheader = '';
                var datapage = '';
                var top_cat_nav = '';
                var service_collapse = '';
                if (href === '/care') {
                    datapage         = 'service_care';
                    pageheader       = '健康保健';
                    top_cat_nav      = 'service-cat-nav-1';
                    service_collapse = 'service-collapse-1';
                    serviceHtml = serviceHtml.replace(/status_b/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_care_name');
                }
                if (href === '/service') {
                    datapage         = 'service_service';
                    pageheader       = '醫療服務';
                    top_cat_nav      = 'service-cat-nav-2';
                    service_collapse = 'service-collapse-2';
                    serviceHtml = serviceHtml.replace(/status_c/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_service_name');
                }
                if (href === '/society') {
                    datapage         = 'service_society';
                    pageheader       = '社區照護';
                    top_cat_nav      = 'service-cat-nav-3';
                    service_collapse = 'service-collapse-3';
                    serviceHtml = serviceHtml.replace(/status_d/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_society_name');
                }
                if (href === '/elderlyhome') {
                    datapage         = 'service_elderlyhome';
                    pageheader       = '院護服務';
                    top_cat_nav      = 'service-cat-nav-4';
                    service_collapse = 'service-collapse-4';
                    serviceHtml = serviceHtml.replace(/status_e/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_elderlyhome_name');
                }
                serviceHtml = serviceHtml.replace(/tpl_common_nav_bd/, common_html);

                serviceHtml = serviceHtml.replace(/cat-nav/g, top_cat_nav);
                serviceHtml = serviceHtml.replace(/collapse-/g, service_collapse);
                serviceHtml = serviceHtml.replace(/datapage/g, datapage);
                serviceHtml = serviceHtml.replace(/pageheader/, pageheader);

            }
        });
        //  生成内容有 end  //

//
           // 注入数据和DOM
        mainView.router.loadContent(serviceHtml);

    });





//  服务页面  动态生成  end  //
//
//


/**********    优惠页面    ***********/
//  优惠页面  动态生成
//

    var discountHtml ='';

    $$('.J_discount_link').on('click', function () {
       //  $$(".tpl_common_nav").html(common_html);
         var href = $$(this).attr('href');  // 获取动态网址
        // console.log(href);
        $$.ajax({
            url: ajaxDomain + '/api/discount' +href ,  // 动态路径
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
                    objData.list[p]["link_url"] = ajaxDomain + '/api/discount/detail/' + id;  // 新增一个链接key
                };
            // 定义模板的数据和DOM

                var data = objData;
                //console.log(     data );
                var tpl = document.getElementById('tpl_J_discount_list').innerHTML;
                discountHtml = juicer(tpl, data);
                var pageheader        = '';
                var datapage          = '';
                var top_cat_nav       = '';
                var discount_collapse = '';
                if (href === '/benefit11') {
                    datapage          = 'discount_benefit11';
                    pageheader        = '中醫';
                    top_cat_nav       = 'discount-cat-nav-1';
                    discount_collapse = 'discount-collapse-1';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav news_ebenefit11_name');
                }
                if (href === '/benefit12') {
                    datapage          = 'discount_benefit12';
                    pageheader        = '西醫';
                    top_cat_nav       = 'discount-cat-nav-2';
                    discount_collapse = 'discount-collapse-2';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav news_benefit12_name');
                }
                if (href === '/benefit13') {
                    datapage          = 'discount_benefit13';
                    pageheader        = '牙醫';
                    top_cat_nav       = 'discount-cat-nav-3';
                    discount_collapse = 'discount-collapse-3';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit13_name');
                }
                if (href === '/benefit14') {
                    datapage          = 'discount_benefit14';
                    pageheader        = '跌打醫師';
                    top_cat_nav       = 'discount-cat-nav-4';
                    discount_collapse = 'discount-collapse-4';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit14_name');
                }
                if (href === '/benefit15') {
                    datapage          = 'discount_benefit15';
                    pageheader        = '化驗所';
                    top_cat_nav       = 'discount-cat-nav-5';
                    discount_collapse = 'discount-collapse-5';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit15_name');
                }
                if (href === '/benefit16') {
                    datapage          = 'discount_benefit16';
                    pageheader        = '診所';
                    top_cat_nav       = 'discount-cat-nav-6';
                    discount_collapse = 'discount-collapse-6';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit16_name');
                }
                if (href === '/benefit18') {
                    datapage          = 'discount_benefit18';
                    pageheader        = '參茸藥行';
                    top_cat_nav       = 'discount-cat-nav-7';
                    discount_collapse = 'discount-collapse-7';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit18_name');
                }
                if (href === '/benefit19') {
                    datapage          = 'discount_benefit19';
                    pageheader        = '醫療器材';
                    top_cat_nav       = 'discount-cat-nav-8';
                    discount_collapse = 'discount-collapse-8';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit19_name');
                }
                if (href === '/benefit21') {
                    datapage          = 'discount_benefit21';
                    pageheader        = '超級市場／百貨公司';
                    top_cat_nav       = 'discount-cat-nav-9';
                    discount_collapse = 'discount-collapse-9';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit21_name');
                }
                if (href === '/benefit22') {
                    datapage          = 'discount_benefit22';
                    pageheader        = '專營公司';
                    top_cat_nav       = 'discount-cat-nav-10';
                    discount_collapse = 'discount-collapse-10';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit22_name');
                }
                if (href === '/benefit23') {
                    datapage          = 'discount_benefit23';
                    pageheader        = '髮型屋';
                    top_cat_nav       = 'discount-cat-nav-11';
                    discount_collapse = 'discount-collapse-11';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit23_name');
                }
                if (href === '/benefit24') {
                    datapage          = 'discount_benefit24';
                    pageheader        = '眼鏡店';
                    top_cat_nav       = 'discount-cat-nav-12';
                    discount_collapse = 'discount-collapse-12';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit24_name');
                }
                if (href === '/benefit25') {
                    datapage          = 'discount_benefit25';
                    pageheader        = '花店';
                    top_cat_nav       = 'discount-cat-nav-13';
                    discount_collapse = 'discount-collapse-13';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit25_name');
                }
                if (href === '/benefit26') {
                    datapage          = 'discount_benefit26';
                    pageheader        = '照片沖印';
                    top_cat_nav       = 'discount-cat-nav-14';
                    discount_collapse = 'discount-collapse-14';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit26_name');
                }
                if (href === '/benefit27') {
                    datapage          = 'discount_benefit27';
                    pageheader        = '書店／文具店';
                    top_cat_nav       = 'discount-cat-nav-15';
                    discount_collapse = 'discount-collapse-15';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit27_name');
                }
                if (href === '/benefit28') {
                    datapage          = 'discount_benefit28';
                    pageheader        = '食肆／餅店';
                    top_cat_nav       = 'discount-cat-nav-16';
                    discount_collapse = 'discount-collapse-16';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit28_name');
                }
                if (href === '/benefit31') {
                    datapage          = 'discount_benefit31';
                    pageheader        = '門券／車資';
                    top_cat_nav       = 'discount-cat-nav-17';
                    discount_collapse = 'discount-collapse-17';
                    discountHtml = discountHtml.replace(/status_b/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav ndiscount_benefit31_name');
                }
                if (href === '/benefit33') {
                    datapage          = 'discount_benefit33';
                    pageheader        = '公共設施';
                    top_cat_nav       = 'discount-cat-nav-18';
                    discount_collapse = 'discount-collapse-18';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit33_name');
                }
                if (href === '/publicfacilities') {
                    datapage          = 'discount_publicfacilities';
                    pageheader        = '持續進修';
                    top_cat_nav       = 'discount-cat-nav-19';
                    discount_collapse = 'discount-collapse-19';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_publicfacilities_name');
                }
                if (href === '/benefit41') {
                    datapage          = 'discount_benefit41';
                    pageheader        = '保險公司';
                    top_cat_nav       = 'discount-cat-nav-20';
                    discount_collapse = 'discount-collapse-20';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit41_name');
                }
                if (href === '/benefit52') {
                    datapage          = 'discount_benefit52';
                    pageheader        = '公共機關';
                    top_cat_nav       = 'discount-cat-nav-21';
                    discount_collapse = 'discount-collapse-21';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav ndiscount_benefit52_name');
                }
                if (href === '/benefit61') {
                    datapage          = 'discount_benefit61';
                    pageheader        = '私營機構';
                    top_cat_nav       = 'discount-cat-nav-22';
                    discount_collapse = 'discount-collapse-22';
                    discountHtml = discountHtml.replace(/status_c/, 'active');
                    discountHtml = discountHtml.replace(/tpl_common_nav/, 'tpl_common_nav discount_benefit61_name');
                }

                discountHtml = discountHtml.replace(/tpl_common_nav_bd/, common_html);
                discountHtml = discountHtml.replace(/cat-nav/g, top_cat_nav);
                discountHtml = discountHtml.replace(/collapse-/g, discount_collapse);
                discountHtml = discountHtml.replace(/datapage/g, datapage);
                discountHtml = discountHtml.replace(/pageheader/, pageheader);
            }
        });
        //  生成内容有 end  //
        // 注入数据和DOM
        mainView.router.loadContent(discountHtml);
    });

    // 注入数据 end
        //
    //动态路由,根据上面的链接，点击生成内容页

    var discountDetailhtml ='';
    $$('.J_discount_detail_link').on('click', function () {
        var href = $$(this).attr('href');  // 获取动态网址
    //   console.log(href);
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
                var tpl = document.getElementById('tpl_J_discount_detail').innerHTML;

                discountDetailhtml = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(discountDetailhtml);
            mainView.router.loadContent(discountDetailhtml);
    });

//  服务页面   动态生成  end  //
//



/**********    活动页面    ***********/
//  活动页面  动态生成
//

    var eventHtml ='';

    $$('.J_event_link').on('click', function () {
       //  $$(".tpl_common_nav").html(common_html);
         var href = $$(this).attr('href');  // 获取动态网址
        // console.log(href);
        $$.ajax({
            url: ajaxDomain + '/api/event' +href ,  // 动态路径
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
                    objData.list[p]["link_url"] = ajaxDomain + '/api/event/detail/' + id;  // 新增一个链接key
                };
            // 定义模板的数据和DOM

                var data = objData;
                //console.log(     data );
                var tpl = document.getElementById('tpl_J_event_list').innerHTML;
                eventHtml = juicer(tpl, data);
                var pageheader       = '';
                var datapage         = '';
                var top_cat_nav      = '';
                var event_collapse = '';
                if (href === '/health') {
                    datapage         = 'event_health';
                    pageheader       = '運動養生';
                    top_cat_nav      = 'event-cat-nav-1';
                    event_collapse   = 'event-collapse-1';
                    eventHtml = eventHtml.replace(/status_b/, 'active');
                    eventHtml = eventHtml.replace(/tpl_common_nav/, 'tpl_common_nav event_health_name');
                }
                if (href === '/finance') {
                    datapage         = 'event_finance';
                    pageheader       = '退休理財';
                    top_cat_nav      = 'event-cat-nav-2';
                    event_collapse   = 'event-collapse-2';
                    eventHtml = eventHtml.replace(/status_c/, 'active');
                    eventHtml = eventHtml.replace(/tpl_common_nav/, 'tpl_common_nav event_finance_name');
                }
                if (href === '/relationships') {
                    datapage         = 'event_relationships';
                    pageheader       = '運動養生';
                    top_cat_nav      = 'event-cat-nav-3';
                    event_collapse   = 'event-collapse-3';
                    eventHtml = eventHtml.replace(/status_d/, 'active');
                    eventHtml = eventHtml.replace(/tpl_common_nav/, 'tpl_common_nav event_relationships_name');
                }
                if (href === '/other') {
                    datapage         = 'event_other';
                    pageheader       = '其他';
                    top_cat_nav      = 'event-cat-nav-4';
                    event_collapse   = 'event-collapse-4';
                    eventHtml = eventHtml.replace(/status_e/, 'active');
                    eventHtml = eventHtml.replace(/tpl_common_nav/, 'tpl_common_nav event_other_name');
                }

                eventHtml = eventHtml.replace(/tpl_common_nav_bd/, common_html);
                eventHtml = eventHtml.replace(/cat-nav/g, top_cat_nav);
                eventHtml = eventHtml.replace(/collapse-/g, event_collapse);
                eventHtml = eventHtml.replace(/datapage/g, datapage);
                eventHtml = eventHtml.replace(/pageheader/, pageheader);
            }
        });
        //  生成内容有 end  //
        // 注入数据和DOM
        mainView.router.loadContent(eventHtml);
    });

    // 注入数据 end
        //
    //动态路由,根据上面的链接，点击生成内容页

    var eventDetailhtml ='';
    $$('.J_event_detail_link').on('click', function () {
        var href = $$(this).attr('href');  // 获取动态网址
    //   console.log(href);
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
                var tpl = document.getElementById('tpl_J_event_detail').innerHTML;

                eventDetailhtml = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(eventDetailhtml);
            mainView.router.loadContent(eventDetailhtml);
    });

//  活动页面   动态生成  end  //
//



/**********    服务页面    ***********/
//  服务页面   动态生成    动态路由,根据上面的链接，点击生成内容页
//

    var serviceHtml ='';

    $$('.J_service_link').on('click', function () {
       //  $$(".tpl_common_nav").html(common_html);
         var href = $$(this).attr('href');  // 获取动态网址
        // console.log(href);

        $$.ajax({
            url: ajaxDomain + '/api/service/healthcare' +href ,  // 动态路径
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


                var data = objData;
                //console.log(     data );
                var tpl = document.getElementById('tpl_J_service_list').innerHTML;
                serviceHtml = juicer(tpl, data);
                var pageheader = '';
                var datapage = '';
                var top_cat_nav = '';
                var service_collapse = '';
                if (href === '/care') {
                    datapage         = 'service_care';
                    pageheader       = '健康保健';
                    top_cat_nav      = 'service-cat-nav-1';
                    service_collapse = 'service-collapse-1';
                    serviceHtml = serviceHtml.replace(/status_b/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_care_name');
                }
                if (href === '/service') {
                    datapage         = 'service_service';
                    pageheader       = '醫療服務';
                    top_cat_nav      = 'service-cat-nav-2';
                    service_collapse = 'service-collapse-2';
                    serviceHtml = serviceHtml.replace(/status_c/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_service_name');
                }
                if (href === '/society') {
                    datapage         = 'service_society';
                    pageheader       = '社區照護';
                    top_cat_nav      = 'service-cat-nav-3';
                    service_collapse = 'service-collapse-3';
                    serviceHtml = serviceHtml.replace(/status_d/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_society_name');
                }
                if (href === '/elderlyhome') {
                    datapage         = 'service_elderlyhome';
                    pageheader       = '院護服務';
                    top_cat_nav      = 'service-cat-nav-4';
                    service_collapse = 'service-collapse-4';
                    serviceHtml = serviceHtml.replace(/status_e/, 'active');
                    serviceHtml = serviceHtml.replace(/tpl_common_nav/, 'tpl_common_nav service_elderlyhome_name');
                }
                serviceHtml = serviceHtml.replace(/tpl_common_nav_bd/, common_html);

                serviceHtml = serviceHtml.replace(/cat-nav/g, top_cat_nav);
                serviceHtml = serviceHtml.replace(/collapse-/g, service_collapse);
                serviceHtml = serviceHtml.replace(/datapage/g, datapage);
                serviceHtml = serviceHtml.replace(/pageheader/, pageheader);

            }
        });
        //  生成内容有 end  //

//
           // 注入数据和DOM
        mainView.router.loadContent(serviceHtml);

    });





//  服务页面  动态生成  end  //
//




/**********   健康tip页面    ***********/
// 健康tip页面   动态生成    动态路由,根据上面的链接，点击生成内容页
//

    var healthtipHtml ='';

    $$('.J_healthtip_link').on('click', function () {
       //  $$(".tpl_common_nav").html(common_html);
         var href = $$(this).attr('href');  // 获取动态网址
        // console.log(href);

        $$.ajax({
            url: ajaxDomain + '/api/health' +href ,  // 动态路径
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


                var data = objData;
                //console.log(     data );
                var tpl = document.getElementById('tpl_J_service_list').innerHTML;
                healthtipHtml = juicer(tpl, data);
                var pageheader = '';
                var datapage = '';
                var top_cat_nav = '';
                var healthtip_collapse = '';
                if (href === '/publication') {
                    datapage         = 'healthtip_publication';
                    pageheader       = '健康保健';
                    top_cat_nav      = 'healthtip-cat-nav-1';
                    healthtip_collapse = 'healthtip-collapse-1';
                    healthtipHtml = healthtipHtml.replace(/status_b/, 'active');
                    healthtipHtml = healthtipHtml.replace(/tpl_common_nav/, 'tpl_common_nav healthtip_publication_name');
                }
                if (href === '/resources') {
                    datapage         = 'healthtip_healthtip';
                    pageheader       = '醫療服務';
                    top_cat_nav      = 'healthtip-cat-nav-2';
                    healthtip_collapse = 'healthtip-collapse-2';
                    healthtipHtml = healthtipHtml.replace(/status_c/, 'active');
                    healthtipHtml = healthtipHtml.replace(/tpl_common_nav/, 'tpl_common_nav healthtip_resources_name');
                }
                if (href === '/links') {
                    datapage         = 'healthtip_society';
                    pageheader       = '社區照護';
                    top_cat_nav      = 'healthtip-cat-nav-3';
                    healthtip_collapse = 'healthtip-collapse-3';
                    healthtipHtml = healthtipHtml.replace(/status_d/, 'active');
                    healthtipHtml = healthtipHtml.replace(/tpl_common_nav/, 'tpl_common_nav healthtip_links_name');
                }

                healthtipHtml = healthtipHtml.replace(/tpl_common_nav_bd/, common_html);

                healthtipHtml = healthtipHtml.replace(/cat-nav/g, top_cat_nav);
                healthtipHtml = healthtipHtml.replace(/collapse-/g, healthtip_collapse);
                healthtipHtml = healthtipHtml.replace(/datapage/g, datapage);
                healthtipHtml = healthtipHtml.replace(/pageheader/, pageheader);

            }
        });
        //  生成内容有 end  //

//
           // 注入数据和DOM
        mainView.router.loadContent(healthtipHtml);

    });

// 健康tip页面  动态生成  end  //







/**********  养老金页面    ***********/

//   养老金动态生成 生成内容有      动态路由,根据上面的链接，点击生成内容页  养老金动态生成
//

    var consultHtml ='';

    $$('.J_consult_link').on('click', function () {
         var href = $$(this).attr('href');  // 获取动态网址
   // console.log(href);
          $$.ajax({
            url: ajaxDomain + '/api/consult' +href ,  // 动态路径  942要换成动态变量
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
                var tpl = document.getElementById('tpl_J_consult_detail').innerHTML;

                consultHtml = juicer(tpl, data);
            }
        });
           // 注入数据和DOM
            mainView.router.loadContent(consultHtml);

    });


//  养老金动态生成 生成内容有 end  //




 // discount data fresh

//   pop end //
/*   弹出层方式的discount TODO 优化 --- discount-in-one.html
*    现在用的是分的页面
*
        $$('.smart-select-popup').on('popup:closed', function () {
             var formData = myApp.formToJSON('#my-form');
            // console.log( ajaxDomain +'/api/'+ formData.slug);
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
                // 渲染数据
                for (var i = 0; i <= data.length; i++) {
                    var it = data[i];
                //     console.log(it);
                    $$('<tr><td><a class="J_link" href="'+ ajaxDomain + '/api/discount/detail/'  + it.id +'">'+it.organization+'</a></td><td><p>'+
                        '<a class="J_link" href="'+ ajaxDomain + '/api/discount/detail/' + it.id +'">'+ it.title + '</a></p></td></tr>').appendTo('.J_table > tbody:last-child');
                }
            });
            // ajax end
            //
          console.log('About Popup is clo11sing')
         //    mainView.router.refreshPage('discounttt')
         //
         //
         //
         var newPageContent = '<div class="page" data-page="my-page">' +
                        '<div class="page-content">' +
                          '<p>Here comes new page</p>' +
                        '</div>' +
                      '</div>';

//Load new content as new page
// mainView.router.loadContent(newPageContent);

        });
// popup-end




//动态路由,根据上面的链接，点击生成内容页
        //  根据juicer tpl生成的

            var html ='';

            $$('.J_link').on('click', function () {

                 var href = $$(this).attr('href');  // 获取动态网址
                  console.log('pop _click_page' + href);
                //   $$.ajax({
                //     url: href ,  // 动态路径
                //     type: 'GET',
                //     async:false,
                //     success: function (getData) {
                //         // 转换Json数据成对象
                //         var a = JSON.stringify(getData);
                //         var j = JSON.parse(a);
                //         var obj = '{"list":';
                //         obj += j ;
                //         obj += '}';
                //         var objData = JSON.parse(obj);
                //        // console.log(objData);
                //         // 定义模板的数据和DOM
                //         var data = objData;
                //         var tpl = document.getElementById('tpl_J_discount_detail').innerHTML;

                //         html = juicer(tpl, data);
                //     }
                // });
                    // 注入数据和DOM
                    // console.log(html);
                    console.log('go to detailpage');
                    mainView.router.loadContent(html);

            });
//  生成内容页end
*
*
*/

})



// ajax API URL Config
// ajaxDomain 是网址主体，
// example: ajaxUrl = 'http://localhost:8000/api/education';
var ajaxDomain               = 'http://localhost/Ag/AgeingAppDev/public/';
var ajaxIndexCarousel        = '/api/carousel';
var ajaxEdu                  = '/api/education';

//  新聞
var ajaxNews                 = '/api/news/announcement';
var ajaxNewsEvents           = '/api/news/events';
var ajaxNewsWelfare          = '/api/news/welfare';

//  优惠
var ajaxDiscount             = '/api/discount/';


//  服務
var ajaxService              = '/api/service/healthcare';
var ajaxServiceCare          = '/api/service/healthcare/care';
var ajaxServiceService       = '/api/service/healthcare/service';
var ajaxServiceSociety       = '/api/service/healthcare/society';
var ajaxServiceElderlyhome   = '/api/service/healthcare/elderlyhome';

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
myApp.onPageInit('index', function (page) {

    $$.ajax({
        url: ajaxDomain + ajaxIndexCarousel,
        type: 'GET',
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
  //  console.log(href);
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
 //   console.log(href);
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
            $$.getJSON( ajaxDomain + ajaxNews,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain + ajaxNews+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
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
//  无限滚动  //
//


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
            $$.getJSON( ajaxDomain + ajaxNewsEvents ,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+'</span></a></li>');
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
            $$.getJSON( ajaxDomain + ajaxNewsWelfare,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain + ajaxNewsWelfare+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+it.start_at+'</span></a></li>');
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

/***************
****************/
// page:  健康服務/api/service/healthcare service.html (原category3.html)
myApp.onPageInit('service', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    $$.ajax({
        url: ajaxDomain + ajaxService, //ajaxHealthTips   localhost:8000/api/service/healthcare
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
        }
    });
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
            //
            $$.getJSON( ajaxDomain + ajaxService,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.panel-group').append('<div class="panel panel-default"><div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-'+i+'" aria-expanded="false" aria-controls="collapse-'+i+'"   class="">'+it.title+'</a></h4></div><div id="collapse-'+i+'" class="panel-collapse collapse" role="tabpanel" aria-expanded="false" aria-labelledby="heading-'+i+'"><div class="panel-body">'+it.content+'</div></div></div>');
                }
            });
            // Update last loaded index
            lastIndex = $$('.panel-group').children('.panel').length + itemsPerLoad;

        }, 1000);
    });
//  无限滚动  end  //
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
        //        console.log(id);
                ////***   TODO   没有具体API路径 ，去掉中间的'/api/'  只能用实际web网址 ***////
                objData.list[p]["link_url"] = ajaxDomain + '/api' + id;  // 新增一个链接key
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
 //   console.log(href);
 //   alert(href);
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
            $$.getJSON( ajaxDomain + ajaxHealthNews,function(data){

                for (var i = lastIndex + 1; i <= lastIndex + itemsPerLoad; i++) {
                    var it = data[i];
                    $$('.post-list').append('<li class="post-list__item"><a class="J_link" href="'+ajaxDomain+ajaxEdu+'/'+it.id+'"><span class="post-list__item__title">'+it.title+'</span><span class="post-list__item__date">'+'</span></a></li>');
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


//  对象
//bal
// var sJson={
// "rec":[
//     {"recs":[
//                 {
//                 "slug":"link_urlpost_72",
//                 "excerpt":"内容内容",
//                 "title":"简介"
//                 },
//                 {
//                 "slug":"link_urlpost_72",
//                 "excerpt":"内容内容02",
//                 "title":"简介"
//                 },
//                 {
//                 "slug":"link_urlpost_72",
//                 "excerpt":"内容内容03",
//                 "title":"简介"
//                 }
//             ]
//     },
//     {"recs":[
//                 {"temLink":"w --10","imageLink":"","itemPrice":"","itemLink":"","itemName":""},
//                 {"temLink":"11","imageLink":"","itemPrice":"","itemLink":"","itemName":""}
//             ]
//     }
//     ]
// };

var sJson=
    {"recs":[
                {
                "slug":"link_urlpost_72",
                "excerpt":"内容内容",
                "title":"简介"
                },
                {
                "slug":"link_urlpost_72",
                "excerpt":"内容内容02",
                "title":"简介"
                },
                {
                "slug":"link_urlpost_72",
                "excerpt":"内容内容03",
                "title":"简介"
                }
            ]
    };




 // console.log(sJson.recs[1].excerpt);
//console.log(sJson.rec[1].recs[0].temLink);
//console.log( typeof(sJson)  );

// console.log( sJson   );
// var sd = function showkey(){
//             for(var key in sJson.recs){
//                 console.log(key);
//             }
//         };
// sd();






    $$.ajax({
        url: '../b.json',  //  ajaxDomain + ajaxHealthDisease,    disease
        type: 'GET',
        success: function (getData) {
            // 转换Json数据成对象
           var a = JSON.stringify(getData);
             var j = JSON.parse(a);      // 转换为string
            var g = JSON.parse(j);      // 转换为object
            // var obj = '{"list":';
            // obj += j ;
            // obj += '}';
            // var objData = JSON.parse(obj);
 console.log( '获取到第一条的title' +  g.list[0].title);
// console.log(g.rec[0].recs[2].excerpt);

            // 定义模板的数据和DOM
                                                        // var data = objData;
           // var data = g;
          //  var tpl = document.getElementById('tpl_J_health_disease').innerHTML;
          //  var html = juicer(tpl, data);
            // 注入数据和DOM
        var html = g;
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
                objData.list[p]["link_url"] = ajaxDomain + '/api/event/detail/' + id;  // 新增一个链接key
            };
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_event').innerHTML;
            var html = juicer(tpl, data);
            // 注入数据和DOM
            $$("div#tpl_event").html(html);
        }
    });


    //动态路由,根据上面的链接，点击生成内容页

    var eventDetailhtml ='';
    $$('.J_event_detail_link').on('click', function () {
        var href = $$(this).attr('href');  // 获取动态网址
    //   console.log(href);
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
                var tpl = document.getElementById('tpl_J_event_detail').innerHTML;

                eventDetailhtml = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(eventDetailhtml);
            mainView.router.loadContent(eventDetailhtml);
    });

});
/*
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

*/
/*
*  优惠
 */

/*
*
* TO 优化
 */
// page /  discount : 优惠 discount.html
/*
myApp.onPageInit('discount', function (page) {
    $$("div#tpl_common_nav").html(common_html);
console.log(page.name+'start');
/*  TODO 待研究，没用，这种写法无法跳转到内容页
 $$.getJSON( ajaxDomain + '/api/discount',function(data){

                for (var i = 0; i <= data.length; i++) {
                    var it = data[i];
                     $$('<tr><td><a class="J_link" href="'+ ajaxDomain + '/api/discount/detail/'  + it.id +'">'+it.organization+'</a></td><td><p>'+'<a class="J_link" href="'+ ajaxDomain + '/api/discount/detail/' + it.id +'">'+ it.title + '</a></p></td></tr>').appendTo('.J_table > tbody:last-child');
                }
            });
*/
/*
         $$.ajax({
            url: ajaxDomain + '/api/discount' ,  // 动态路径
            type: 'GET',
            async:false,
            success: function (getData) {
                // 转换Json数据成对象
             //   console.log(getData);
                var a = JSON.stringify(getData);
                var j = JSON.parse(a);
                var obj = '{"list":';
                obj += j ;
                obj += '}';
                var objData = JSON.parse(obj);
                var id = '';  //  建立id和url的变量简称
                for(var p in objData.list){
                    //    console.log( objData.list[p].id);   // 遍历出所有id值
                    id = objData.list[p].id;
                    objData.list[p]["link_url"] = ajaxDomain + '/api/discount/detail/' + id;  // 新增一个链接key
                };
                // console.log(objData);
                // 定义模板的数据和DOM
                var data = objData;
                var tpl = document.getElementById('tpl_J_discount').innerHTML;

                var html = juicer(tpl, data);
                 // 注入数据和DOM
            $$("div#tpl_discount").html(html);
            }
        });


 //动态路由,根据上面的链接，点击生成内容页
        //  根据juicer tpl生成的

            var html ='';

            $$('.J_link').on('click', function () {
                console.log('init_click_page');
                 var href = $$(this).attr('href');  // 获取动态网址
                  $$.ajax({
                    url: href ,  // 动态路径
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
                        var tpl = document.getElementById('tpl_J_discount_detail').innerHTML;

                        html = juicer(tpl, data);
                    }
                });
                    // 注入数据和DOM
                    // console.log(html);
                    console.log('go to detailpage');
                    mainView.router.loadContent(html);

            });



});

*/




/*
*
* TO 优化
 */
// page /  discount : 优惠  分页模式 discount.html

myApp.onPageInit('discount', function (page) {
    $$("div#tpl_common_nav").html(common_html);
    //  console.log(page.name+'start');

    $$.ajax({
        url: ajaxDomain + '/api/discount' ,  // 动态路径
        type: 'GET',
        async:false,
        success: function (getData) {
            // 转换Json数据成对象
         //   console.log(getData);
            var a = JSON.stringify(getData);
            var j = JSON.parse(a);
            var obj = '{"list":';
            obj += j ;
            obj += '}';
            var objData = JSON.parse(obj);
            var id = '';  //  建立id和url的变量简称
            for(var p in objData.list){
                //    console.log( objData.list[p].id);   // 遍历出所有id值
                id = objData.list[p].id;
                objData.list[p]["link_url"] = ajaxDomain + '/api/discount/detail/' + id;  // 新增一个链接key
            };
            // console.log(objData);
            // 定义模板的数据和DOM
            var data = objData;
            var tpl = document.getElementById('tpl_J_discount').innerHTML;

            var html = juicer(tpl, data);
             // 注入数据和DOM
        $$("div#tpl_discount").html(html);
        }
    });


    //动态路由,根据上面的链接，点击生成内容页
    var html ='';

    $$('.J_link').on('click', function () {
        console.log('init_click_page');
         var href = $$(this).attr('href');  // 获取动态网址
          $$.ajax({
            url: href ,  // 动态路径
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
                var tpl = document.getElementById('tpl_J_discount_detail').innerHTML;

                html = juicer(tpl, data);
            }
        });
            // 注入数据和DOM
            // console.log(html);
         //   console.log('go to detailpage');
            mainView.router.loadContent(html);
    });



});




/*
* 养老金 consult.html
*
 */

// page:    养老金 consult.html
myApp.onPageInit('consult', function (page) {
    $$("div#tpl_common_nav").html(common_html);

          $$.ajax({
            url: ajaxDomain + '/api/consult/challenge',
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
                var tpl = document.getElementById('tpl_J_consult').innerHTML;

                var html = juicer(tpl, data);
                 $$("div#tpl_consult").html(html);
            }
        });



});


