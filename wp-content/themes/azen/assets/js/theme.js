(function ($) {
	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.avia_utilities.supported = {};
	$.avia_utilities.supports = (function () {
		var div = document.createElement('div'),
			vendors = ['Khtml', 'Ms', 'Moz', 'Webkit', 'O'];
		return function (prop, vendor_overwrite) {
			if (div.style.prop !== undefined) {
				return "";
			}
			if (vendor_overwrite !== undefined) {
				vendors = vendor_overwrite;
			}
			prop = prop.replace(/^[a-z]/, function (val) {
				return val.toUpperCase();
			});

			var len = vendors.length;
			while (len--) {
				if (div.style[vendors[len] + prop] !== undefined) {
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}
			return false;
		};
	}());
	/* Smartresize */
	(function ($, sr) {
		var debounce = function (func, threshold, execAsap) {
			var timeout;
			return function debounced() {
				var obj = this, args = arguments;

				function delayed() {
					if (!execAsap)
						func.apply(obj, args);
					timeout = null;
				}

				if (timeout)
					clearTimeout(timeout);
				else if (execAsap)
					func.apply(obj, args);
				timeout = setTimeout(delayed, threshold || 100);
			}
		}
		// smartresize
		jQuery.fn[sr] = function (fn) {
			return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
		};
	})(jQuery, 'smartresize');
})(jQuery);

var custom_js = {

	init: function () {
		jQuery('#preload').delay(100).fadeOut(500, function () {
			jQuery(this).remove();
		});
		if (jQuery().masonry) {
			setTimeout(function () {
				var blog = jQuery('.content-blog-masonry'),
					$grid = blog.masonry({
						itemSelector: '.grid-item'
					});

				$grid.masonry('on', 'layoutComplete', function () {
					if (jQuery().flexslider) {
						jQuery('.flexslider').flexslider({
							slideshow     : true,
							animation     : 'fade',
							pauseOnHover  : true,
							animationSpeed: 400,
							smoothHeight  : true,
							directionNav  : true,
							controlNav    : false,
							prevText      : '',
							nextText      : ''
						});
					}
				});
				var msnry = $grid.data('masonry');
				blog.infiniteScroll({
					path           : ".pagination-next a",
					append         : '.grid-item',
					outlayer       : msnry,
					button         : '.view-more-button',
					// using button, disable loading on scroll
					scrollThreshold: false,
					status         : '.page-load-status',
					history        : false
				});
			}, 300);
		}
		jQuery('.date-social .product-share span').on("click", function () {
			jQuery(this).parent().toggleClass('active')
		})
	},

	mobile_menu: function () {
		/*Hamburger Button*/
		jQuery('.menu-mobile-effect').on("click", function () {
			jQuery(this).toggleClass("is-active");
			jQuery('#js-navbar-fixed .main-menu').slideToggle(200, 'linear');
		});

		jQuery('.navmenu .menu-item-has-children').append('<span class="zmdi zmdi-chevron-down show-submenu-mobile"></span>');
		jQuery('.navmenu .menu-item-has-children .show-submenu-mobile').on('click touch', function (e) {
			e.preventDefault();
			if (jQuery(this).prev().is(':hidden')) {
				jQuery(this).prev().slideDown(200, 'linear');
				jQuery(this).addClass('toggle-open');
			} else {
				jQuery(this).prev().slideUp(200, 'linear');
				jQuery(this).removeClass('toggle-open');
			}
		});
		/*End Mobile Menu*/


	},

	search      : function () {
		jQuery('.search-toggler').on('click', function (e) {
			jQuery('.search-overlay').css('visibility','visible');
		});
		jQuery('.closeicon,.background-overlay').on('click', function (e) {
			jQuery('.search-overlay').css('visibility','hidden');
		});
		jQuery(document).keyup(function (e) {
			if (e.keyCode == 27) {
				jQuery('.search-overlay').css('visibility','hidden');
			}
		});
		jQuery('.search-toggler').on('click', function (e) {
			jQuery('.menu-desktop-inner').css('position','inherit');
		});
		jQuery('.homepage-v6 .search-toggler').on('click', function (e) {
			jQuery('.search-overlay').css('position','fixed');
		});
		jQuery(".featured-layout-2 .slick-prev").html('PREV');
		jQuery(".woocommerce-pagination .page-numbers .next").html('NEXT');
	},

	Headerminicart     : function () {
		jQuery('.widget_shopping_cart').on('click', function (e) {
			jQuery('.minicart-content').css('visibility','visible');
			jQuery('.widget_shopping_cart_contents').css('right','0');
			jQuery('body').css('overflow','hidden');
		});
		jQuery('.close-cart,.background-overlay-cart').on('click', function (e) {
			jQuery('.minicart-content').css('visibility','hidden');
			jQuery('.widget_shopping_cart_contents').css('right','-450px');
			jQuery('body').css('overflow','initial');
		});
		jQuery(document).keyup(function (e) {
			if (e.keyCode == 27) {
				jQuery('.minicart-content').css('visibility','hidden');
				jQuery('.widget_shopping_cart_contents').css('right','-450px');
				jQuery('body').css('overflow','initial');
			}
		});

	},

	scrollToTop: function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.footer__arrow-top').css({bottom: "30px"});
			} else {
				jQuery('.footer__arrow-top').css({bottom: "-100px"});
			}
		});
		jQuery('.footer__arrow-top').on('click', function () {
			jQuery('html, body').animate({scrollTop: '0px'}, 800);
			return false;
		});
	},

	stickyHeaderInit: function () {
		//Add class for masthead
		var height_header_wrap = jQuery('.sticky_header').outerHeight();
		if (height_header_wrap > 0) {
			jQuery('.sticky_header').css({"min-height": height_header_wrap + 'px'});
		}
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 1) {
				jQuery('.header-hp-1').removeClass('affix-top').addClass('affix');
			} else {
				jQuery('.header-hp-1').removeClass('affix').addClass('affix-top');
			}
		});
	},

	post_gallery: function () {
		if (jQuery().flexslider) {
			jQuery('.gallery-slider').flexslider({
				slideshow     : true,
				animation     : 'fade',
				pauseOnHover  : true,
				animationSpeed: 400,
				smoothHeight  : true,
				directionNav  : true,
				controlNav    : false,
				prevText      : '',
				nextText      : ''
			});
		}
		if (jQuery().owlCarousel) {
			jQuery(".testimonials-hp-azen").each(function () {
				var $this = jQuery(this),
					owl = $this.find('.sc-testimonials'),
					arrow = owl.data('arrows'),
					dots = owl.data('dots');
				owl.owlCarousel({
					items: 1,
					loop: true,
					margin: 40,
					thumbs: false,
					thumbImage: false,
					nav: arrow,
					dots: dots,
					navText: [
						"<span class='zmdi zmdi-chevron-left'></span>",
						"<span class='zmdi zmdi-chevron-right'></span>"],
					slideSpeed: 300,
					panigationSpeed: 400,
					responsiveClass: true,
					responsive: {
						0: {
							items: 1,
							nav: false
						},
						576: {
							items:1

						},
						992: {
							items: 1
						}
					}
				});
			});
		}
	},

	our_teams_slider: function () {
		if (jQuery().slick) {
			jQuery(".our-teams").each(function () {
				var $this = jQuery(this),
					slider = $this.find('.our-teams-sliders'),
					$btn_prev = slider.next().find('.es-nav-prev'),
					$btn_next = slider.next().find('.es-nav-next'),
					speed = slider.data('speed');
				slider.slick({
					infinite     : true,
					arrows       : true,
					speed        : 800,
					dots         : true,
					autoplay     : true,
					autoplaySpeed: speed,
					slidesToShow : 1,
					centerMode   : false,
					prevArrow    : $btn_prev,
					nextArrow    : $btn_next,
					responsive   : [
						{
							breakpoint: 992,
							settings  : {}
						},
						{
							breakpoint: 768,
							settings  : {}
						}
					]
				});
			});
			jQuery(".sc-posts-layout_2").each(function () {
				var $this = jQuery(this),
					slider = $this.find('.inner-list-posts'),
					item = slider.data('item'),
					speed = slider.data('speed');
				slider.slick({
					infinite      : true,
					arrows        : false,
					speed         : speed,
					dots          : true,
					autoplay      : true,
					autoplaySpeed : speed,
					slidesToShow  : item,
					slidesToScroll: item,
					centerMode    : false,
					responsive    : [
						{
							breakpoint: 992,
							settings  : {
								slidesToShow  : 3,
								slidesToScroll: 3,
							}
						},
						{
							breakpoint: 768,
							settings  : {
								slidesToShow  : 2,
								slidesToScroll: 2,
							}
						},
						{
							breakpoint: 480,
							settings  : {
								slidesToShow  : 1,
								slidesToScroll: 1,
							}
						}
					]
				});
			});
		}
	},

	quantity_buttons: function () {
		jQuery('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" class="plus modify-qty" />').prepend('<input type="button" value="-" class="minus modify-qty"/>');
		jQuery(document).on("click", ".plus, .minus", function () {
			var a = jQuery(this).closest(".quantity").find(".qty"), t = parseFloat(a.val()),
				l = parseFloat(a.attr("max")), s = parseFloat(a.attr("min")), r = a.attr("step");
			jQuery(this).is(".plus") ? l && (l == t || t > l) ? a.val(l) : a.val(t + parseFloat(r)) : s && (s == t || s > t) ? a.val(s) : t > 0 && a.val(t - parseFloat(r)), a.trigger("change")
		});
	},

	quick_view      : function () {
		jQuery('.quick-view').on('click', function (e) {
			jQuery(this).addClass('loading');
			e.preventDefault();
			var product_id = jQuery(this).attr('data-prod');
			var data = {action: 'jck_quickview', product: product_id};
			jQuery.post(quick_view.ajaxurl, data, function (response) {
				jQuery.magnificPopup.open({
					mainClass: 'my-mfp-zoom-in',
					items    : {
						src : '<div class="product-lightbox">' + response + '</div>',
						type: 'inline'
					}
				});
				jQuery('.quick-view').removeClass('loading');
				setTimeout(function () {
					jQuery('.product-lightbox div.quantity:not(.buttons_added)').addClass('buttons_added').append('<input type="button" value="+" class="plus_qv modify-qty" />').prepend('<input type="button" value="-" class="minus_qv modify-qty" />');
					jQuery('.product-lightbox .plus_qv,.product-lightbox .minus_qv').on('click', function (e) {
						e.preventDefault();
						var a = jQuery(this).closest(".quantity").find(".qty"), t = parseFloat(a.val()),
							l = parseFloat(a.attr("max")), s = parseFloat(a.attr("min")), r = a.attr("step");
						jQuery(this).is(".plus_qv") ? l && (l == t || t > l) ? a.val(l) : a.val(t + parseFloat(r)) : s && (s == t || s > t) ? a.val(s) : t > 0 && a.val(t - parseFloat(r)), a.trigger("change")
					});
					jQuery('.product-lightbox form').wc_variation_form();
				}, 300);
			});
			e.preventDefault();
		});
	},

	singleSlider    : function () {
		if (jQuery().flexslider) {
			if (jQuery('#slider li').length > 1) {
				jQuery('#carousel').flexslider({
					animation    : "slide",
					controlNav   : false,
					animationLoop: true,
					slideshow    : true,
					itemWidth    : 180,
					itemMargin   : 20,
					asNavFor     : '#slider',
					smoothHeight : false,
					directionNav : true,
					prevText     : "",
					nextText     : ""
				});

				jQuery('#slider').flexslider({
					animation    : "slide",
					controlNav   : false,
					animationLoop: true,
					slideshow    : true,
					sync         : "#carousel",
					directionNav : false,             //Boolean: Create navigation for previous/next navigation? (true/false)
					start        : function (slider) {
						jQuery('body').removeClass('loading');
					}
				});
			}
		}

		if (jQuery().swipebox) {
			jQuery('.swipebox').swipebox({
				hideBarsDelay: false, // delay before hiding bars on desktop
				loopAtEnd    : true // true will return to the first image after the last image is reached
			});
		}
	},
}

jQuery(document).ready(function ($) {
	custom_js.init();
	custom_js.mobile_menu();
	custom_js.Headerminicart();
	custom_js.search();
	custom_js.scrollToTop();
	custom_js.stickyHeaderInit();
	custom_js.post_gallery();
	custom_js.our_teams_slider();
	custom_js.quantity_buttons();
	custom_js.quick_view();
	custom_js.singleSlider();
	jQuery('#azenmap iframe').removeAttr('frameborder').removeAttr('scrolling').removeAttr('marginheight').removeAttr('marginwidth');
});

