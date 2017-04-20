var $ = jQuery.noConflict(),win_h,win_w,_wl,_wpos,_dh;
var Blank ={	
	win_prop : function(){
		win_h = $(window).height();
		win_w = $(window).width();
		_wl =  window.location.href;
		_wpos = $(window).scrollTop()	
		$('.mht').css({"min-height":win_h});
		$('.mht_homebanner').css({"min-height":win_h - 101});
		$('body').addClass('body-ready');
	},
	side_nav_fix :function(){
		Blank.win_prop();
		var side_nav_selector = $('.side-nav-contain');
		var _footer = $('#footer');	
		var _header = $("#site-header");
		if(side_nav_selector.length){
			var side_nav = $(side_nav_selector).offset().top;
			$(window).scroll(function(){
				var footer_overlay_fix = $(_footer).offset().top - $(side_nav_selector).height() - $(_header).height() - 30;

				var _wpos_check = _wpos + $(_header).height();	
				console.log(_wpos_check +">="+ footer_overlay_fix);		
				if(_wpos_check > side_nav){
					$('.side-nav-contain').addClass('fix-pos');
				}
				else{
					$('.side-nav-contain').removeClass('fix-pos');	
				}	
				console.log(_wpos +">="+ footer_overlay_fix)			
				if(_wpos >= footer_overlay_fix){
					$('.side-nav-contain').css({"position":"absolute" , "top": footer_overlay_fix})	
				}
				else{
					$('.side-nav-contain').css({"position":"" , "top": ""})
				}

			});
		}
	},
	scrl_anim : function(){
		Blank.win_prop();
		var _scrlen = _wpos + win_h;
		$('.scroll-anim').each(function(){
			var _myPos = $(this).offset().top;
			if(_scrlen > _myPos)
			{		
				$(this).addClass('animate-custom');
			}
			else
			{
				$(this).removeClass('animate-custom');
			}
		});							
	},
	header_anim : function(){
		$('#site-header').addClass('header-load');
	},	
	single_slider : function(){				
		var owl = $(".owl-carousel.single_slider");
		if(owl.length){	
			owl.on('initialized.owl.carousel', function(event) {
				var main_parent = owl.parents('.single_slider_wrapper');
				var main_parent_height = owl.parents('.single_slider_wrapper').find('.slide-item img').height();
				$(main_parent).find('.next-wrapper').css({"height":main_parent_height});
				$(main_parent).find('.prev-wrapper').css({"height":main_parent_height});			    
			});				
			owl.owlCarousel({
			    loop:true,
			    nav:false,
			    dots:false,
			    dotsContainer: '#customDots',
			    smartSpeed:1000,
			    margin:1,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:1
			        },
			        1000:{
			            items:1
			        }
			    }
			});

			// Custom Navigation Events
			$(".next").click(function(){
				$(this).parents('.single_slider_wrapper').find(owl).trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				$(this).parents('.single_slider_wrapper').find(owl).trigger('prev.owl.carousel');
			});					
		}	
	},
	two_slider : function(){
		var owl = $('.owl-carousel.two_slider');
		if(owl.length){
			owl.on('initialized.owl.carousel', function(event) {
				var main_parent = owl.parents('.two-slide-carousel');
				var main_parent_height = owl.parents('.two-slide-carousel').find('.slide-item img').height();
				$(main_parent).find('.next-wrapper').css({"height":main_parent_height});
				$(main_parent).find('.prev-wrapper').css({"height":main_parent_height});			    
			});				
			owl.owlCarousel({
			    loop:true,
			    nav:false,
			    dots:false,
			    smartSpeed:1000,
			    margin:1,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:2
			        },
			        1000:{
			            items:2
			        }
			    }
			});

			// Custom Navigation Events
			$(".next").click(function(){
				$(this).parents('.two-slide-carousel').find(owl).trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				$(this).parents('.two-slide-carousel').find(owl).trigger('prev.owl.carousel');
			});

		}	
	},
	side_nav : function(){
		$(".side-nav li.current").parents("li").addClass("current");
		setTimeout(function(){ $('.side-nav .current').addClass('active'); }, 500);
	},
	home_logo_anim : function(){
		Blank.win_prop();
		if(_wpos > 1){
			$('#site-header').addClass('animate-fixed-header');
		}
		else{
			$('#site-header').removeClass('animate-fixed-header');				
		} 	
    },
    home_single_slider :function(){
		var owl = $(".owl-carousel.single_slider_home");
		if(owl.length){		
			owl.owlCarousel({
				animateOut: 'fadeOut',
			    loop:true,
			    nav:false,
			    dots:true,
			    dotsContainer: '#customDots',
			    smartSpeed:1000,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:1
			        },
			        1000:{
			            items:1
			        }
			    }
			});
			// Custom Navigation Events
			$(".next").click(function(){
				$(this).parents('.single_slider_wrapper').find(owl).trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				$(this).parents('.single_slider_wrapper').find(owl).trigger('prev.owl.carousel');
			});
			owl.on('changed.owl.carousel', function(event) {
				$('.customdothover').stop().animate({
		        	top: $('.owl-dot.active').position().top 
		    	});				    
			})								
		}   
	},
	home_slide_pg_anim : function(){
		$('.owl-dot').hover(function(){
			$('.customdothover').stop().animate({
	        	top: $(this).position().top 
	    	});
		})
		$('.customdotwrapper').mouseleave(function(){
			$('.customdothover').stop().animate({
	        	top: $('.owl-dot.active').position().top 
	    	});	
		});
	},
	home_slide_wid_name : function(){
		var owl = $('.owl-carousel.single_slider_home_2');

		if(owl.length){		
			owl.owlCarousel({
				animateOut: 'fadeOut',
			    loop:false,
			    nav:false,
				dots: true,
				dotsContainer: '.slider-nav .thumbs',
			    smartSpeed:1000,
			    margin:1,
			    responsive:{
			        0:{
			            items:1
			        },
			        600:{
			            items:1
			        },
			        1000:{
			            items:1
			        }
			    }
			});
			
			var item_index = 0;			
			// Custom Navigation Events
			$(".next").click(function(){
				var parent_select = $(this).parents('.pagination-slider').attr('data-unique-class');
				var item_count = $('.'+parent_select).find('.owl-carousel.single_slider_home_2 .owl-item').length - 1;				
				if(item_index == item_count){
					$(owl).trigger('to.owl.carousel', 0);
				}
				else{	
					$(this).parents('.single_slider_wrapper').find(owl).trigger('next.owl.carousel');
				}				
			});
			$(".prev").click(function(){
				var parent_select = $(this).parents('.pagination-slider').attr('data-unique-class');
				var item_count = $('.'+parent_select).find('.owl-carousel.single_slider_home_2 .owl-item').length - 1;
				if(item_index == 0){
					$(owl).trigger('to.owl.carousel', item_count);	
				}
				else{
					$(this).parents('.single_slider_wrapper').find(owl).trigger('prev.owl.carousel');
				}
			});
			owl.on('translated.owl.carousel', function (e) {
				item_index = e.item.index;
			});
			owl.on('changed.owl.carousel', function(property){
				var current = property.item.index;
				var parent_select = $(this).parents('.pagination-slider').attr('data-unique-class');
				var chk_attr = $(property.target).find(".owl-item .slider-item").eq(current).attr('data-object');
				$('.'+parent_select).find('.sliding-detail').removeClass('active-detail-slide');				
				$('.'+parent_select).find('.sliding-detail-wrapper').find("[data-object='" + chk_attr + "']").addClass('active-detail-slide');	
				$('.'+parent_select).find('.gotoslide').removeClass('active-main-pagination');				
				$('.'+parent_select).find('.main-nav-slider').find("[data-object='" + chk_attr + "']").addClass('active-main-pagination');				
			})			
			$('.gotoslide').click(function(){
				var $this = $(this);
				var parent_select = $this.parents('.pagination-slider').attr('data-unique-class');
				var myattr = $this.attr('data-object');
				var owlNumber = $('.single_slider_home_2').find("[data-object='" + myattr + "']").parent().index();	
				$('.'+parent_select).find(owl).trigger('to.owl.carousel', owlNumber);
			});
		}
	},	
	home_page_init : function(){
		if($('body.home').length){
			Blank.home_logo_anim();
			$(window).scroll(function(){
				Blank.home_logo_anim();
			});
		}

	},
	hotel_listing_init : function(){
		if($('body.page-template-template-hotel-listing').length){
			Blank.home_logo_anim();
			$(window).scroll(function(){
				Blank.home_logo_anim();
			});
		}
	},
	common_init : function(){
		Blank.win_prop();	
		Blank.scrl_anim();
		Blank.header_anim();
		Blank.single_slider();
		Blank.side_nav();	
		Blank.two_slider();
		Blank.home_single_slider();
		Blank.home_slide_pg_anim();
		Blank.home_slide_wid_name();
	},
	common_init_window_load : function(){
		setTimeout(function(){ Blank.side_nav_fix(); }, 50);
	},
	common_init_resize :function(){
		Blank.win_prop();
		Blank.scrl_anim();
		Blank.header_anim();
		Blank.side_nav_fix();
	},
	booktable: function(){
		$('.booktable').each(function(){
			var connection_id 	= $.trim($(this).attr('data-connection-id'));
			var id 				= $.trim($(this).attr('id'));

			if(connection_id != "" && connection_id != null)
			{
				$("#"+id).lbuiDirect({
					connectionid : connection_id,
					style :{
						baseColor : "D1A757"
					},
					popupWindow : {
						enabled : true
					}
				});
			}
		});
	},
}
$(document).ready(function(){
	Blank.common_init();
	Blank.home_page_init();
	Blank.hotel_listing_init();
	jQuery('#site-header #slide-menu').meanmenu({
		meanScreenWidth: "1140",
		meanMenuContainer : '#site-header',
		meanRevealPosition : "left",
		meanMenuOpen: "MENU",
		meanMenuClose: "CLOSE",
		meanExpand: " ",
		meanContract: " ",
	});
	jQuery('#mc-form').ajaxChimp({
			url: '//builtbyblank.us14.list-manage.com/subscribe/post?u=35b52d4d999898495de700b6d&amp;id=707c0e74e6',
			callback: callbackFunction
		});	
		function callbackFunction (resp) {
		    if (resp.result === 'success') {
		      	$("#mc-email").val("");
		    }
		}		
});
$(window).resize(function(){
	Blank.common_init_resize();
});	
$(window).scroll(function(){
	Blank.scrl_anim();
});
$(window).on('load', function(){
	Blank.common_init_window_load();
	Blank.booktable();
	$('body').addClass('body-loaded');
});
