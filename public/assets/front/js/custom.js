/*
* Theme Name: Invention
* Theme URI: http://www.jozoor.com
* Description: Invention Theme for corporate and creative sites, responsive and clean layout, more than color skins
* Author: Jozoor team
* Author URI: http://www.jozoor.com
* Version: 1.0
*/

/*
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =  
=     00   00 00 00   00 00 00   00 00 00   00 00 00   00 00    =
=     00   00    00        00    00    00   00    00   00       =
=     00   00    00      00      00    00   00    00   00       =
=     00   00    00    00        00    00   00    00   00       =
=  00 00   00 00 00   00 00 00   00 00 00   00 00 00   00       =
= = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
*/
jQuery(document).ready(function(e){ddsmoothmenu.init({mainmenuid:"menu",orientation:"h",classname:"navigation",contentsource:"markup"});e(".slidewrap").carousel({slider:".slider",slide:".slide",slideHed:".slidehed",nextSlide:".next-slide",prevSlide:".prev-slide",addPagination:false,addNav:false,speed:700});e(".slidewrap1").carousel({namespace:"carousel1",speed:600});e(".slidewrap2").carousel({namespace:"carousel2",speed:600});e(".slidewrap3").carousel({namespace:"carousel3",speed:600});e(".slidewrap4").carousel({namespace:"carousel4",speed:600});e(".recent-work .item").hover(function(){e(".img-caption",this).stop().animate({top:"0"},{queue:false,duration:400})},function(){e(".img-caption",this).stop().animate({top:"100%"},{queue:false,duration:400})});e(".portfolio .item").hover(function(){e(".img-caption",this).stop().animate({top:"0"},{queue:false,duration:400})},function(){e(".img-caption",this).stop().animate({top:"100%"},{queue:false,duration:400})});e(".gallery .item").hover(function(){e(".img-caption",this).stop().animate({top:"0"},{queue:false,duration:400})},function(){e(".img-caption",this).stop().animate({top:"100%"},{queue:false,duration:400})});e("[data]").colorTip({color:"yellow"});e().UItoTop({easingType:"easeOutQuart"});e("#menu > a").click(function(){e("#menu > ul").slideToggle("fast")});(function(e){e("#menu > a").bind("click",function(){if(e(this).hasClass("current")){e(this).removeClass("current");e(this).parent().parent().find("#menu > ul").slideUp("fast");return false}else{e(this).addClass("current");e("#menu").removeClass("navigation");e("#menu").addClass("responsive");e(this).parent().parent().find("#menu > ul").slideDown("fast");return false}});e(window).bind("resize",function(){if(e(this).width()>959){e("#menu > a").removeClass("current");e("#menu").removeClass("responsive");e("#menu").addClass("navigation");e("#menu > ul").removeAttr("style")}else{e("#menu").removeClass("navigation");e("#menu").addClass("responsive")}})})(jQuery);e("#menu li:has(ul)").doubleTapToGo();e(function(){e("#menu a").each(function(){if(e(this).parent("li").children("ul").size()>0){e(this).append('<i class="icon-angle-down responsive"></i>')}})});e("a.down-button").click(function(){e(".slidedown").slideToggle("slow")});(function(e){e("a.down-button").bind("click",function(){if(e(this).hasClass("current")){e(this).removeClass("current");e("a.down-button > i").removeClass("icon-angle-up");e("a.down-button > i").addClass("icon-angle-down");e(this).parent().parent().find(".slidedown").slideUp("slow");return false}else{e(this).addClass("current");e("a.down-button > i").removeClass("icon-angle-down");e("a.down-button > i").addClass("icon-angle-up");e(this).parent().parent().find(".slidedown").slideDown("slow");return false}});e(window).bind("resize",function(){if(e(this).width()>768){e("a.down-button").removeClass("current");e("a.down-button > i").removeClass("icon-angle-up");e("a.down-button > i").addClass("icon-angle-down");e(".slidedown").removeAttr("style")}})})(jQuery);e("#accordion").accordion({autoHeight:false,icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion2").accordion({autoHeight:false,icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion3").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion4").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion5").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion6").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion7").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion8").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion9").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});e("#accordion10").accordion({autoHeight:false,active:".selected",selectedClass:"active",icons:{header:"icon-plus",activeHeader:"icon-minus"}});setTimeout(function(){e(".meter .meter-content").each(function(){var t=e(this);var n=t.attr("data-percentage");var r=0;var i=setInterval(function(){if(r>=n){clearInterval(i)}else{r+=1;t.css("width",r+"%")}t.text(r+"%")},10)})},10);e("#horizontal-tabs").tytabs({tabinit:"1",fadespeed:"fast"});e("#horizontal-tabs.two").tytabs({tabinit:"1",prefixtabs:"tab_two",prefixcontent:"content_two",fadespeed:"fast"});e("#horizontal-tabs.three").tytabs({tabinit:"1",prefixtabs:"tab_three",prefixcontent:"content_three",fadespeed:"fast"});e("#horizontal-tabs.four").tytabs({tabinit:"1",prefixtabs:"tab_four",prefixcontent:"content_four",fadespeed:"fast"});e("#horizontal-tabs.five").tytabs({tabinit:"1",prefixtabs:"tab_five",prefixcontent:"content_five",fadespeed:"fast"});e("#vertical-tabs").tytabs({tabinit:"1",prefixtabs:"tab_v",prefixcontent:"content_v",fadespeed:"fast"});e("#vertical-tabs.two").tytabs({tabinit:"1",prefixtabs:"tab_v_two",prefixcontent:"content_v_two",fadespeed:"fast"});e("#vertical-tabs.three").tytabs({tabinit:"1",prefixtabs:"tab_v_three",prefixcontent:"content_v_three",fadespeed:"fast"});e("#vertical-tabs.four").tytabs({tabinit:"1",prefixtabs:"tab_v_four",prefixcontent:"content_v_four",fadespeed:"fast"});e("#vertical-tabs.five").tytabs({tabinit:"1",prefixtabs:"tab_v_five",prefixcontent:"content_v_five",fadespeed:"fast"});e(".hideit").click(function(){e(this).fadeOut(600)});e("#toggle-view li h4").click(function(){var t=e(this).siblings("div.panel");if(t.is(":hidden")){t.slideDown("200");e(this).siblings("span").html("-")}else{t.slideUp("200");e(this).siblings("span").html("+")}});e(window).load(function(){var t=e("#contain");t.isotope({resizable:false,masonry:{columnWidth:t.width()/12}});e(window).smartresize(function(){t.isotope({masonry:{columnWidth:t.width()/12}})});t.isotope({itemSelector:".item",animationOptions:{duration:750,easing:"linear",queue:true}});var n=e("#options .option-set"),r=n.find("a");r.click(function(){var n=e(this);if(n.hasClass("selected")){return false}var r=n.parents(".option-set");r.find(".selected").removeClass("selected");n.addClass("selected");var i={},s=r.attr("data-option-key"),o=n.attr("data-option-value");o=o==="false"?false:o;i[s]=o;if(s==="layoutMode"&&typeof changeLayoutMode==="function"){changeLayoutMode(n,i)}else{t.isotope(i)}return false})});e(window).ready(function(){e(".flexslider").flexslider({animation:"fade",animationLoop:true,slideshow:true,slideshowSpeed:6e3,animationSpeed:800,pauseOnHover:true,pauseOnAction:true,controlNav:false,directionNav:true,controlsContainer:".flex-container",start:function(t){var n=e(".slider-1 .flex-active-slide h2").data("toptitle");var r=e(".slider-1 .flex-active-slide .item").data("topimage");var i=e(".slider-1 .flex-active-slide p").data("bottomtext");var s=e(".slider-1 .flex-active-slide .links").data("bottomlinks");e(".slider-1 .flex-active-slide").find(".item").css({top:r});e(".slider-1 .flex-active-slide").find(".item").animate({right:"0",opacity:"1"},1e3);e(".slider-1 .flex-active-slide").find("h2").animate({left:"0",top:n,opacity:"1"},1500);e(".slider-1 .flex-active-slide").find("p").animate({left:"0",bottom:i,opacity:"1"},1500);e(".slider-1 .flex-active-slide").find(".links").animate({left:"0",bottom:s,opacity:"1"},1800);t.removeClass("loading")},before:function(t){e(".slider-1 .flex-active-slide").find(".item").animate({right:"-100%",opacity:"0"},1e3);e(".slider-1 .flex-active-slide").find("h2").animate({left:"0",top:"-100%",opacity:"0"},1500);e(".slider-1 .flex-active-slide").find("p").animate({left:"0",bottom:"-50%",opacity:"0"},1500);e(".slider-1 .flex-active-slide").find(".links").animate({left:"0",bottom:"-100%",opacity:"0"},1800)},after:function(t){var n=e(".slider-1 .flex-active-slide h2").data("toptitle");var r=e(".slider-1 .flex-active-slide .item").data("topimage");var i=e(".slider-1 .flex-active-slide p").data("bottomtext");var s=e(".slider-1 .flex-active-slide .links").data("bottomlinks");e(".slider-1 .flex-active-slide").find(".item").css({top:r});e(".slider-1 .flex-active-slide").find(".item").animate({right:"0",opacity:"1"},1e3);e(".slider-1 .flex-active-slide").find("h2").animate({left:"0",top:n,opacity:"1"},1500);e(".slider-1 .flex-active-slide").find("p").animate({left:"0",bottom:i,opacity:"1"},1500);e(".slider-1 .flex-active-slide").find(".links").animate({left:"0",bottom:s,opacity:"1"},1800)}});e(".flexslider4").flexslider({animation:"fade",animationLoop:true,slideshow:true,slideshowSpeed:6e3,animationSpeed:800,pauseOnHover:true,pauseOnAction:true,controlNav:false,directionNav:true,controlsContainer:".flex-container",start:function(t){var n=e(".slider-2 .flex-active-slide h2").data("bottomtitle");var r=e(".slider-2 .flex-active-slide p").data("bottomtext");var i=e(".slider-2 .flex-active-slide .links").data("bottomlinks");e(".slider-2 .flex-active-slide").find("h2").animate({bottom:n,opacity:"1"},1500);e(".slider-2 .flex-active-slide").find("p").animate({bottom:r,opacity:"1"},2e3);e(".slider-2 .flex-active-slide").find(".links").animate({bottom:i,opacity:"1"},2200);t.removeClass("loading")},before:function(t){e(".slider-2 .flex-active-slide").find("h2").animate({bottom:"-20%",opacity:"0"},1500);e(".slider-2 .flex-active-slide").find("p").animate({bottom:"-50%",opacity:"0"},2e3);e(".slider-2 .flex-active-slide").find(".links").animate({bottom:"-60%",opacity:"0"},2200)},after:function(t){var n=e(".slider-2 .flex-active-slide h2").data("bottomtitle");var r=e(".slider-2 .flex-active-slide p").data("bottomtext");var i=e(".slider-2 .flex-active-slide .links").data("bottomlinks");e(".slider-2 .flex-active-slide").find("h2").animate({bottom:n,opacity:"1"},1500);e(".slider-2 .flex-active-slide").find("p").animate({bottom:r,opacity:"1"},2e3);e(".slider-2 .flex-active-slide").find(".links").animate({bottom:i,opacity:"1"},2200)}});e(".flexslider2").flexslider({animation:"slide",animationLoop:true,slideshow:true,slideshowSpeed:4500,animationSpeed:700,pauseOnHover:true,pauseOnAction:false,controlNav:false,directionNav:true,controlsContainer:".flex-container"});e(".flexslider3").flexslider({animation:"slide",animationLoop:true,slideshow:false,slideshowSpeed:4500,animationSpeed:700,pauseOnHover:true,pauseOnAction:false,controlNav:false,directionNav:true,controlsContainer:".flex-container"})});e(".fancybox").fancybox({prevEffect:"none",nextEffect:"none",loop:false,beforeLoad:function(){this.title=e(this.element).attr("caption")}});e(".fancybox-media").attr("rel","media-gallery").fancybox({openEffect:"none",closeEffect:"none",prevEffect:"none",nextEffect:"none",arrows:false,helpers:{media:{},buttons:{}}});e("header.fixed .main-header").sticky({topSpacing:0});e(".sticky-wrapper").removeAttr("style")})