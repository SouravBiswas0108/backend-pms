$.fn.andSelf = function () {
    return this.addBack.apply(this, arguments);
}
/*jQuery(document).ready(function ($) {
    "use strict";
    var carousel = $('#customers-testimonials');
    //  TESTIMONIALS CAROUSEL HOOK
    carousel.owlCarousel({
        loop: true,
        items: 2,
        margin: 0,
        autoplay: true,
        dots: true,
        autoplayTimeout: 8500,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1170: {
                items: 2
            }
        }
    });

    checkClasses();
    carousel.on('translated.owl.carousel', function (event) {
        checkClasses();
    });

    function checkClasses() {
        var FindActive = jQuery('.owl-stage').find('.owl-item.active');
        for (var i = 0; i < 2; i++) {

            if (i == 0) {
                $(FindActive[0]).find('.item').css('opacity', '1');
            } else {
                $(FindActive[i]).find('.item').css('opacity', '0.5');
            }
        }
    }
});*/