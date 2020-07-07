(function ($) {
    $(document).ready(function () {
        let counter = $('.count__list');

        if (counter.length > 0) {
            counter.map(function (i, item) {
                let startCounter = 0;
                $(window).scroll(function () { // Когда страница прокручивается
                    var scrTop = $(window).scrollTop();
                    if (scrTop > $(item).offset().top - $(window).height()) {
                        numAnimate();
                        startCounter = 1;
                    }
                });
                let scrTop = $(window).scrollTop();
                let counterTop = $(item).offset().top;
                if (scrTop > $(item).offset().top - $(window).height()) {
                    numAnimate();
                    startCounter = 1;
                }

                function numAnimate() {
                    if (!startCounter) {
                        let count = $(item).find('.count');
                        count.css('opacity', 1);
                        $({blurRadius: 5}).animate({blurRadius: 0}, {
                            duration: 1000,
                            easing: 'swing',
                            step: function () {
                                count.css({
                                    "-webkit-filter": "blur(" + this.blurRadius + "px)",
                                    "filter": "blur(" + this.blurRadius + "px)"
                                });
                            }
                        });
                    }
                    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(' ');
                    let countNumber = $(item).find('.count__number');
                    countNumber.each(function () {
                        var tcount = $(this).data("count");
                        $(this).animateNumber({
                                number: tcount,
                                easing: 'easeInQuad',
                                numberStep: comma_separator_number_step
                            },
                            $(item).data('time'));
                    });
                }
            });
        }
    });
})(jQuery);