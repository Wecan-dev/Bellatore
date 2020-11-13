jQuery(".list-sale-1").each(function () {
    var $this = jQuery(this),
        owl = $this.find('.sc-list-sale');
    owl.owlCarousel({
        items          : 1,
        loop           : true,
        margin		   : 30,
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
            576: {
                items: 2

            },
            992: {
                items:4
            }
        }
    });

    var countdown = jQuery('.sc-list-sale .item .wrap-countdown');
    for (var i = 0; i < countdown.length; i++) {
        var count = jQuery(countdown[i]).find('.countdown'),
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

        jQuery(countdown[i]).countdown({
            labels: labels,
            until : current_time
        });
    }

});