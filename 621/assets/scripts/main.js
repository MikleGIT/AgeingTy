"use strict";$(document).ready(function(){$(".flexslider").flexslider({animation:"slide",directionNav:!1,start:function(){$(".flex-control-paging").removeClass("flex-control-paging")}}),$(".okay").click(function(){$(".header__more").addClass("hide")}),$(".header__bar__bookmark a").click(function(){$(".header__bar__bookmark a .fa").toggleClass("fa-star-o").toggleClass("fa-star")}),$("#cat-nav").on("show.bs.collapse",function(){$(".header__bar__title .fa").toggleClass("fa-angle-up").toggleClass("fa-angle-down")}),$("#cat-nav").on("hide.bs.collapse",function(){$(".header__bar__title .fa").toggleClass("fa-angle-up").toggleClass("fa-angle-down")}),$(".filter__trigger").click(function(){$(".filter__option").toggleClass("hide")}),$(".filter__option__item").click(function(){$(".filter__option__item").removeClass("active"),$(this).toggleClass("active")})});