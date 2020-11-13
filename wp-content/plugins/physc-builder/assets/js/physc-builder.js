(function ($) {
	'use strict';
	var pb_starter = {
		element_responsive: function () {
			$(window).on('load resize', function () {
				var mode = 'desktop';
				if (matchMedia('only screen and (max-width: 1024px) and (min-width: 768px)').matches)
					mode = 'tablet';
				else if (matchMedia('only screen and (max-width: 767px)').matches)
					mode = 'mobile';

				$('.vc_row, .vc_row-inner').each(function () {
					if (mode == 'tablet') {
						if ($(this).data('class-tablet')) {
							$(this).addClass($(this).data('class-tablet'));
						}
					}
					if (mode == 'mobile') {
						if ($(this).data('class-mobile')) {
							$(this).addClass($(this).data('class-mobile'));
						}
					}
				});
			});
		},
	}
	jQuery(document).ready(function ($) {
		if (jQuery().slick) {
			jQuery(".featured-layout-2").each(function () {
				var $this = jQuery(this),
					slider = $this.find('.products'),
					item = slider.data('item'),
					speed = slider.data('speed'),
					arrow = slider.data('arrows'),
					dots  = slider.data('dots');
				slider.slick({
					infinite      : true,
					arrows        : arrow,
					dots          : dots,
					autoplay      : true,
					autoplaySpeed : speed,
					slidesToShow  : item,
					slidesToScroll: item,
					centerMode    : false,
					responsive    : [
						{
							breakpoint: 1024,
							settings  : {
								slidesToShow  : 2,
								slidesToScroll: 2
							}
						},
						{
							breakpoint: 480,
							settings  : {
								slidesToShow  : 1,
								slidesToScroll: 1
							}
						}
					]
				});
			});
			jQuery(".featured-layout-3").each(function () {
				var $this = jQuery(this),
					slider = $this.find('.products'),
					$btn_prev = slider.parent().prev().find('.es-nav-prev'),
					$btn_next = slider.parent().prev().find('.es-nav-next'),
					item = slider.data('item'),
					speed = slider.data('speed');
				slider.slick({
					infinite      : true,
					arrows        : true,
					dots          : false,
					autoplay      : true,
					autoplaySpeed : speed,
					slidesToShow  : 1,
					rows          : item,
					slidesToScroll: 1,
					centerMode    : false,
					prevArrow     : $btn_prev,
					nextArrow     : $btn_next,
				});
			});
		}
		if (jQuery().owlCarousel) {
			jQuery(".woocommerce-product-gallery").each(function () {
				var $this = jQuery(this),
					owl = $this.find('.owl-carousel');
				owl.owlCarousel({
					loop               : false,
					items              : 1,
					thumbs             : true,
					thumbImage         : true,
					thumbContainerClass: 'owl-thumbs',
					thumbItemClass     : 'owl-thumb-item'
				});
			});
			jQuery(".testimonials-hp-1").each(function () {
				var $this = jQuery(this),
					owl = $this.find('.sc-testimonials'),
					arrow = owl.data('arrows'),
					dots  = owl.data('dots');
				owl.owlCarousel({
					items          : 1,
					loop           : true,
					margin         : 0,
					thumbs         : false,
					thumbImage     : false,
					nav            : arrow,
					dots           : dots,
					navText        : [
						"<span class='zmdi zmdi-chevron-left'></span>",
						"<span class='zmdi zmdi-chevron-right'></span>"],
					slideSpeed     : 300,
					panigationSpeed: 400,
					responsiveClass: true,
					responsive     : {
						0  : {
							items: 1,
							nav  : false
						},
						576: {
							items: 1

						},
						992: {
							items: 1
						}
					}
				});
			});
			jQuery(".ourteam-1").each(function () {
				var $this = jQuery(this),
					owl = $this.find('.sc-ourteam');

				owl.owlCarousel({
					items          : 1,
					loop           : true,
					margin		   : 15,
					nav            : true,
					dots           : false,
					thumbs :      false,
					navText        : [
						"PREV",
						"NEXT"],
					slideSpeed     : 300,
					panigationSpeed: 400,
					responsiveClass: true,
					responsive     : {
						0  : {
							items: 1,
							nav  : false
						},
						768: {
							items: 2

						},
						992: {
							items: 3
						}
					}
				});

			});
			jQuery(".reviews-content").each(function () {
				var $this = jQuery(this),
					owl = $this.find('.sc-reviews');
				owl.owlCarousel({
					items          : 1,
					loop           : true,
					margin         : 0,
					thumbs         : false,
					thumbImage     : false,
					nav            : false,
					dots           : true,
					slideSpeed     : 300,
					panigationSpeed: 400,
					responsiveClass: true,
					responsive     : {
						0  : {
							items: 1,
							nav  : false
						},
						576: {
							items: 1

						},
						992: {
							items: 1
						}
					}
				});
			})
		}
		pb_starter.element_responsive();
	});
})(jQuery);