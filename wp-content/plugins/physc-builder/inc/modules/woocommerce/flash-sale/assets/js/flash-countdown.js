(function ($) {
	"use strict";
	$(document).ready(function () {
		let countdown = $('.flash-sale-countdown .wrap-countdown');
		for (var i = 0; i < countdown.length; i++) {
			var count = $(countdown[i]).find('.countdown'),
				time = count.data('time'),
				labels = [
					count.data('text-year') ? count.data('text-year') : 'Years',
					count.data('text-month') ? count.data('text-month') : 'Months',
					count.data('text-week') ? count.data('text-week') : 'Weeks',
					count.data('text-day') ? count.data('text-day') : 'Days',
					count.data('text-hour') ? count.data('text-hour') : 'Hours',
					count.data('text-minute') ? count.data('text-minute') : 'Mins',
					count.data('text-second') ? count.data('text-second') : 'Secs',
				];

			time = new Date(time);

			var current_time = new Date(time);

			$(countdown[i]).countdown({
				labels: labels,
				until : current_time
			});
		}
	});

})(jQuery);