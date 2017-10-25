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
		var dots_wrap; 
		if ($(window).width() > 1025){
			dots_condition = false;
			autoplay_wrap = false; 
		}else{
			dots_condition = true;
			autoplay_wrap = true; 
		} 		
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
			    dots:dots_condition,
			    smartSpeed:1000,
			    autoplay:autoplay_wrap,
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
		var dots_wrap; 
		if ($(window).width() > 1025){
			dots_condition = false;
			autoplay_wrap = false; 
		}else{
			dots_condition = true;
			autoplay_wrap = true; 
		} 
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
			    dots:dots_condition,
			    autoplay:autoplay_wrap,
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
		$(".ul-child-li-0 li.current-link.menu-item-has-no-children").siblings("li").addClass("current-link-sibling");
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
		var dots_wrap; 
			if ($(window).width() > 1025){
				dots_wrap = '#customDots';
				autoplay_wrap = true; 
			}else{
				dots_wrap = "";
				autoplay_wrap = true; 
			} 		
		if(owl.length){		
			owl.owlCarousel({
				animateOut: 'fadeOut',
			    loop:true,
			    nav:false,
			    dots:true,
			    dotsContainer: dots_wrap,
			    smartSpeed:1000,
			    autoplay:autoplay_wrap,
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
		var dots_wrap; 
			if ($(window).width() > 1025){
				dots_wrap = '.slider-nav .thumbs';
				autoplay_wrap = false; 
			}else{
				dots_wrap = "";
				autoplay_wrap = true; 
			} 	
		if(owl.length){		
			owl.owlCarousel({
				animateOut: 'fadeOut',
			    loop:false,
			    nav:false,
				dots: true,
				dotsContainer: dots_wrap,
				autoplay:autoplay_wrap,
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

	},
	common_init : function(){
		Blank.win_prop();	
		Blank.scrl_anim();
		Blank.header_anim();
		Blank.side_nav();			
		Blank.home_single_slider();
		Blank.home_slide_pg_anim();
		Blank.home_slide_wid_name();
		$(window).scroll(function(){
			Blank.home_logo_anim();
		});
	},
	common_init_window_load : function(){
		setTimeout(function(){ Blank.side_nav_fix(); }, 50);
		Blank.two_slider();
		Blank.single_slider();
	},
	common_init_resize :function(){
		Blank.win_prop();
		Blank.scrl_anim();
		Blank.header_anim();
		Blank.side_nav_fix();
		Blank.media_col_equal_height();
	},
	booktable: function(){
		$('.booktable').each(function(){
			var connection_id 	= $.trim($(this).attr('data-connection-id'));
			var id 				= $.trim($(this).attr('id'));

			if(connection_id != "" && connection_id != null)
			{
				/*$("#"+id).lbuiDirect({*/
				$(this).lbuiDirect({
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
	rangePicker: function(){
		/*$('.rangePicker').datepick({ 
			rangeSelect: true,
			pickerClass: 'noPrevNext mandatory',
			showTrigger: '#calImg',
			dateFormat: 'M d, yyyy',
			minDate: new Date(new Date().getTime() + (24 * 60 * 60 * 1000)),
			onClose: function(dates){
				console.debug(dates);
			},
			onSelect: function(dates){
			},
		});*/
		$('.rangePicker').daterangepicker({
			"autoApply": true,
			"buttonClasses": "btn btn-sm cal-btn",
			"applyClass": "btn-success cal-apply-btn",
			"cancelClass": "btn-default cal-cancel-btn",
			"locale": {
				  	/*"format": 'MMMM D, YYYY',*/
				  	"format": 'MMM D, YYYY',
				},
			}, function(start, end, label) {
				//console.log("New date range selected: " + start.format('DD/MM/YYYY') + " to " + end.format('DD/MM/YYYY') + " (predefined range: " + label + ")");
		});

		$('.rangePicker').on('show.daterangepicker', function(ev, picker) {
			/*console.log(picker.startDate.format('YYYY-MM-DD'));
			console.log(picker.endDate.format('YYYY-MM-DD'));*/
			Blank.fix_daterangepicker_pos();
		});
		$('.rangePicker').on('showCalendar.daterangepicker', function(ev, picker) {
			/*console.log(picker.startDate.format('YYYY-MM-DD'));
			console.log(picker.endDate.format('YYYY-MM-DD'));*/
			Blank.fix_daterangepicker_pos();
		});
		$('.rangePicker').on('hide.daterangepicker', function(ev, picker) {
			var arrive 	= picker.startDate.format('DD/MM/YYYY');
			var endDate = picker.endDate.format('DD/MM/YYYY');
			
			var arrive_time 	= new Date(picker.startDate.format('MM/DD/YYYY')).getTime();
			var endDate_time 	= new Date(picker.endDate.format('MM/DD/YYYY')).getTime();

			var difference 	= 0;
            var oneDay 		= 1000*60*60*24; 
            var difference 	= Math.ceil((endDate_time - arrive_time) / oneDay);

            if(difference > 0)
            {
				$(this).parents("form").find("[name='arrive']").val(arrive);
				$(this).parents("form").find("[name='nights']").val(difference);
			}
			else if(!$(this).hasClass("canBeSingleDay"))
			{
				alert("End date should be greater than start date.");
				$(this).val("");
				$(this).parents("form").find("[name='arrive']").val("");
				$(this).parents("form").find("[name='nights']").val("");
			}
		});
		/******* Event Lists ******/
		/******
			show.daterangepicker: Triggered when the picker is shown
			hide.daterangepicker: Triggered when the picker is hidden
			showCalendar.daterangepicker: Triggered when the calendar(s) are shown
			hideCalendar.daterangepicker: Triggered when the calendar(s) are hidden
			apply.daterangepicker: Triggered when the apply button is clicked, or when a predefined range is clicked
			cancel.daterangepicker: Triggered when the cancel button is clicked
		******/
	},
	bookingPopupTabs: function(){
		$('.hotel_dtls ul li').click(function(){
			var rel = $(this).data('rel');
			$('.hotel_dtls ul li').removeClass('add_hover special');
			$(this).addClass('add_hover special');
			$('.content-container .one').hide();
			$('#'+rel).fadeIn('slow');
			$(".current-tab-name").html($(this).text());
			if(rel == 'content3')
			{
				$('[data-rel="content2"]').addClass("mobile-no-border");
			}
			else
			{
				$('[data-rel="content2"]').removeClass("mobile-no-border");
			}
		})
	},
	openBookingPopup: function(){
		$(document).on("click",".popup-booking-button a, .popup-booking-button-anchor", function(e){
			e.preventDefault();
			var booking_at 	= $.trim($(this).attr("data-booking-at"));
			var booking_for = $.trim($(this).attr("data-booking-for"));
			
			if(booking_for != "" && booking_for != null && booking_at != "" && booking_at != null)
			{
				booking_at = booking_at.toLowerCase();
				
				if(booking_for == 'hotel')
				{
					$(".popup_wrapper #content1 [name='Hotel'] option").filter(function() {
						return $.trim($(this).text()).toLowerCase() == booking_at;
					}).attr('selected', true).trigger('change');

					$(".hotel_dtls ul li").removeClass("add_hover special");
					$(".hotel_dtls ul li[data-rel='content1']").addClass("add_hover special");
					$(".popup_wrapper .one").hide();
					$(".popup_wrapper #content1").show();
				}
			}
			$('.hotel_dtls ul li[data-rel="content1"]').trigger("click");

			$('.main_sec').fadeIn();
		})
	},
	closeBookingPopup: function(){
		$('.close_popup').click(function(){
			$('.main_sec').fadeOut();
		})
	},
	updatePopupBookTableButton: function(){
		$('.popup-book-table-radio').click(function(){
			var wrapper_id = $.trim($(this).attr('data-button-wrapper-id'));
			$(".book_table_button_wrapper").hide();
			$("#"+wrapper_id).show();
		})
	},
	roomGallerySlider: function(){
		if($('.gallery-slider').length){
			$('.gallery-slider').owlCarousel({
				items: 1,
				nav: true,
				dots: false,
				smartSpeed:1000	
			});
		}
	},
	contactPopup: function(){
		$('.chat-wrapper').click(function(e){
			e.preventDefault();	
			$('.contact-slide-form').toggleClass('slide-in');
	  	});
	},
	fix_daterangepicker_pos: function(){
		var site_header_height = 0;

		if ($("#site-header").css("position") === "fixed")
		{
			site_header_height = $("#site-header").height();
		}
		$(".daterangepicker").each(function(){
			var top = $(this).position().top;
			
			if(top > 0)
			{
				top = top - site_header_height;
				$(this).css({"top":top});
			}
		});
	},
	updateRequestEventHotelName: function(){
		$(document).on("change", "#request-event-hotel-dd", function(){
			var hotel = $("#request-event-hotel-dd option:selected").text();
			$("#request_event_hotel_name").val(hotel);
		});
	},
	validate_book_room_form: function(){
		$("#book_room_form").submit(function( event ){
			/*event.preventDefault();*/
			var error 		= "";
			var $form 		= $("#book_room_form");
			var hotel 		= $.trim($form.find("[name='Hotel']").val());
			var chain_id 	= $.trim($form.find("[name='Hotel'] option:selected").attr("data-chain-id"));
			var date 		= $.trim($form.find("[name='arrive']").val());

			if(hotel == "" || hotel == null)
			{
				error += "Please select Hotel.\n";
			}
			if(date == "" || date == null)
			{
				error += "Please select Dates.\n";
			}
			if(error != "")
			{
				alert(error);
				return false;
			}
			else
			{
				$form.find("[name='date']").val("");
				$form.find("[name='Chain']").val(chain_id);
				return true;
			}
		});
	},
	validate_book_room_form_popup: function(){
		$("#book_room_form_popup").submit(function( event ){
			/*event.preventDefault();*/
			var error 		= "";
			var $form 		= $("#book_room_form_popup");
			var hotel 		= $.trim($form.find("[name='Hotel']").val());
			var chain_id 	= $.trim($form.find("[name='Hotel'] option:selected").attr("data-chain-id"));
			var date 		= $.trim($form.find("[name='arrive']").val());

			if(hotel == "" || hotel == null)
			{
				error += "Please select Hotel.\n";
			}
			if(date == "" || date == null)
			{
				error += "Please select Dates.\n";
			}
			if(error != "")
			{
				alert(error);
				return false;
			}
			else
			{
				$form.find("[name='date']").val("");
				$form.find("[name='Chain']").val(chain_id);
				return true;
			}
		});
	},
	close_google_map_popup: function(){
		$(document).on("click",".google-map-close-popup",function(){
			$(".google-map-popup-wrapper").addClass("hide-map");
		});
	},
	show_google_map_popup: function(){
		$(document).on("click",".launch-google-map-popup",function(){
			var wind_height = $(window).height();
			var header_height = $(".google-map-popup-wrapper .rel_wrap").outerHeight();
			$(".google-map-popup-content iframe").height(wind_height - header_height);
			$(".google-map-popup-wrapper").removeClass("hide-map");
		});
	},
	hide_press_detail_slide: function(){
		$(document).on("click", "a.press-detail-close", function(){
			$(".press-detail-wrapper").slideUp();
			$(".press-cols.has-slider-images").removeClass("active");
			$(this).parents(".press-detail-row").removeClass("popup").hide();
		});
	},
	show_press_detail_slide: function(){
		$(document).on("click", ".press-cols.has-slider-images:not(.active)", function(){
			var id = $(this).attr("data-id");
			if($(window).width() > 1024)
			{
				$(".press-cols.has-slider-images").removeClass("active");
				$(".press-detail-wrapper").slideUp();
				$(".press-detail-"+id).slideDown(function(){
					Blank.scrollToDiv("#press-detail-"+id);
				});
				$(this).addClass("active");
			}
			else
			{
				$(".press-detail-"+id).parents(".press-detail-row").addClass("popup").show();
				var height = $(window).height() - parseInt($(".press-detail-wrapper").css("paddingTop")) - parseInt($(".press-detail-wrapper").css("paddingBottom"));

				$(".popup.press-detail-row .press-detail-content-wrapper").height(height);
				$(".press-detail-"+id).show();
				$(this).addClass("active");				 
			}
		});
		$(document).on("click", ".press-cols.has-slider-images.active", function(){
			$(".press-cols.has-slider-images").removeClass("active");
			var id = $(this).attr("data-id");
			$(".press-detail-wrapper").slideUp();
		});
	},
	scrollToDiv: function(selector)
	{
		var div_offset=$(selector).offset().top;
		var header_height = $("#site-header").height();

		var header_offset = div_offset - header_height;

		$('body,html').animate({
			scrollTop: header_offset
		}, 1500);
	},
	media_col_equal_height: function()
	{
		if(!$(".media-container .col-6").length)
		{
			return true;
		}
		var max_height = 0;
		$(".media-container .col-6").each(function(){
			var height = $(this).height();
			if(max_height < height)
			{
				max_height = height;
			}
		});
		if(max_height > 0)
		{
			$(".media-container .col-6").height(max_height);
		}
	},
	ready: function(){
		Blank.common_init();
		Blank.validate_book_room_form();
		Blank.validate_book_room_form_popup();
		Blank.home_page_init();
		Blank.hotel_listing_init();
		Blank.rangePicker();
		Blank.bookingPopupTabs();
		Blank.openBookingPopup();
		Blank.closeBookingPopup();
		Blank.updatePopupBookTableButton();
		Blank.roomGallerySlider();
		Blank.contactPopup();
		Blank.updateRequestEventHotelName();
		Blank.show_google_map_popup();
		Blank.close_google_map_popup();
		Blank.hide_press_detail_slide();
		Blank.show_press_detail_slide();
		Blank.media_col_equal_height();

		if(jQuery('#slide-menu').length){
			jQuery('#site-header #slide-menu').meanmenu({
				meanScreenWidth: "1140",
				meanMenuContainer : '#site-header',
				meanRevealPosition : "left",
				meanMenuClose: "",
				meanExpand: " ",
				meanContract: " ",
			});
		}
		$('.gallery-thumb').on('click', function(e){
			e.preventDefault();
			var rel = $(this).data('rel');
			var $rel = $('.' + rel);
			$rel.addClass('popup-active');
		});
		$('.close-contact').click(function(e){
			e.preventDefault();
			$('.contact-slide-form').removeClass('slide-in');
		})
		$('.close-gallery').click(function(){
			$('.slider-container').removeClass('popup-active');
		})
		jQuery('#mc-form').ajaxChimp({
				url: '//builtbyblank.us14.list-manage.com/subscribe/post?u=35b52d4d999898495de700b6d&amp;id=707c0e74e6',
				callback: callbackFunction
		});	
		
		// Media popup
		$(document).on('click', '.media-request', function(){
			var buttons = $(this).parents('.media-box').find('.radio-buttons').clone(true);
			$('.media-popup-content .wpcf7-form .radio-buttons').remove();
			$('.media-popup-content .wpcf7-form .email_button').before(buttons);
			$('.media-popup').fadeIn();	
		 });

		$('.close_popup').click(function(){
			$('.media-popup').fadeOut();
			
		});
		$("#uploadbrowsebutton").click(function() {
			$('#fileuploadfield').click()
		});
		function callbackFunction (resp)
		{
		    if (resp.result === 'success')
		    {
		      	$("#mc-email").val("");
		    }
		}
	},
	resize: function(){
		Blank.common_init_resize();
	},
	load: function(){		
		Blank.common_init_window_load();
		Blank.booktable();
		$('body').addClass('body-loaded');
	},
}
$(document).ready(function(){
	Blank.ready();
	win_h = $(window).height();
	$('ul#menu-mobile-menu').css({'height': win_h});
});
$(window).resize(function(){
	Blank.resize();
});	
$(window).scroll(function(){
	Blank.scrl_anim();
});
$(window).on('load', function(){
	Blank.load();
});