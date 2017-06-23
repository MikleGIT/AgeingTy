
/*
*
* TO 优化
 */
// page /  discount : benefit11 优惠 / 中医 分页模式 discount.html

myApp.onPageInit('discount_benefit11', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit11' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});

// page /  discount : benefit12 优惠 / 西医 分页模式 discount.html

myApp.onPageInit('discount_benefit12', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit12' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit13 优惠 / 牙医 分页模式 discount.html

myApp.onPageInit('discount_benefit13', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit13' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});

// page /  discount : benefit14 优惠 / 跌打医生 分页模式 discount.html

myApp.onPageInit('discount_benefit14', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit14' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit15 优惠 / 化验所 分页模式 discount.html

myApp.onPageInit('discount_benefit15', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit15' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit16 优惠 / 诊所 分页模式 discount.html

myApp.onPageInit('discount_benefit16', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit16' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit18 优惠 / 参茸药行 分页模式 discount.html

myApp.onPageInit('discount_benefit18', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit18' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});

// page /  discount : benefit19 优惠 /医疗器材 分页模式 discount.html

myApp.onPageInit('discount_benefit19', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit19' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit21 优惠 /超级市场 分页模式 discount.html

myApp.onPageInit('discount_benefit21', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit21' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit22 优惠 /专营公司 分页模式 discount.html

myApp.onPageInit('discount_benefit22', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit22' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit23 优惠 /  发型屋 分页模式 discount.html

myApp.onPageInit('discount_benefit23', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit23' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit24 优惠 / 眼镜店 分页模式 discount.html

myApp.onPageInit('discount_benefit24', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit24' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit26 优惠 /花店 分页模式 discount.html

myApp.onPageInit('discount_benefit26', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit26' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});



// page /  discount : benefit27 优惠 /照片冲印 分页模式 discount.html

myApp.onPageInit('discount_benefit27', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit27' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit28 优惠 /书店/ 文具店 分页模式 discount.html

myApp.onPageInit('discount_benefit28', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit28' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});

// page /  discount : benefit31 优惠 / 食品  饼店  分页模式 discount.html

myApp.onPageInit('discount_benefit31', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit31' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});



// page /  discount : benefit33 优惠 / 门券 车资 分页模式 discount.html

myApp.onPageInit('discount_benefit33', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit33' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : publicfacilities 优惠 /公共设施 分页模式 discount.html

myApp.onPageInit('discount_publicfacilities', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/publicfacilities' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});

// page /  discount : benefit41 优惠 / 持续进修 分页模式 discount.html

myApp.onPageInit('discount_benefit41', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit41' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit52 优惠 / 保险公司 分页模式 discount.html

myApp.onPageInit('discount_benefit52', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit52' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit61 优惠 / 公共机关 分页模式 discount.html

myApp.onPageInit('discount_benefit61', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit61' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});


// page /  discount : benefit62 优惠 / 私营机构 分页模式 discount.html

myApp.onPageInit('discount_benefit62', function (page) {
    $$("div#tpl_common_nav").html(common_html);
//  console.log(page.name+'start');

         $$.ajax({
            url: ajaxDomain + '/api/discount/benefit62' ,  // 动态路径
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
      //            console.log(objData);
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
         //       console.log('init_click_page');
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
            //        console.log('go to detailpage');
                    mainView.router.loadContent(html);
            });
});
