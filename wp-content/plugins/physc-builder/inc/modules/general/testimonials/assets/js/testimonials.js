(function ($) {
	"use strict";

	$(document).ready(function () {
		if (jQuery().owlCarousel) {
			jQuery(".testimonials-hp-1").each(function () {
				var $this = jQuery(this),
					owl = $this.find('.sc-testimonials');
				owl.owlCarousel({
					items          : 1,
					loop           : true,
					margin         : 0,
					nav            : true,
					dots           : false,
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

			})
		}
	});

})(jQuery);