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
		var footer_overlay_fix = $(_footer).offset().top - $(side_nav_selector).height() - 106;
		if(side_nav_selector.length){
			var side_nav = $(side_nav_selector).position().top;
			$(window).scroll(function(){
				var _wpos_check = _wpos + 106;
				console.log(_wpos_check);				
				if(_wpos_check > side_nav){
					$('.side-nav-contain').addClass('fix-pos');
				}
				else{
					$('.side-nav-contain').removeClass('fix-pos');	
				}				
				if(_wpos_check >= footer_overlay_fix){
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
		var owl = $('.owl-carousel.single_slider');
		if(owl.length){
			owl.owlCarousel({
			    loop:true,
			    nav:false,
			    dots:false,
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
				owl.trigger('next.owl.carousel');
			});
			$(".prev").click(function(){
				owl.trigger('prev.owl.carousel');
			});					
		}	
	},
	common_init : function(){
		Blank.win_prop();
		Blank.scrl_anim();
		Blank.header_anim();		
	},
	common_init_window_load : function(){
		Blank.single_slider();
		Blank.side_nav_fix();
	},
	side_nav : function(){
		setTimeout(function(){ $('.side-nav .current').addClass('active'); }, 500);
	},
	home_page_init : function(){

	},
	room_page_init : function(){
		if($('body.room').length){
			Blank.side_nav();
		}
	}
}
$(document).ready(function(){
	Blank.common_init();
	Blank.room_page_init();
});
$(window).resize(function(){
	Blank.win_prop();
	Blank.common_init();
	Blank.side_nav_fix();	
});	
$(window).scroll(function(){
	Blank.scrl_anim();
});
$(window).on('load', function(){
	Blank.common_init_window_load(); 
});

