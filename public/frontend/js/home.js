(function ($) {
    /*-----------------------
            Hero Slider
        ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<span class='arrow_left'>", "<span class='arrow_right'>"],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    $(".service").owlCarousel({
        margin: 30,
        autoWidth: false,
        dots: false,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1200,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            1300: {
                items: 2,
                nav: true,
                navText: [
                    "<span class='arrow_carrot-left'>",
                    "<span class='arrow_carrot-right'>",
                ],
            },
        },
    });

    $(".post").owlCarousel({
        margin: 30,
        autoWidth: false,
        dots: false,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1200,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            1300: {
                items: 2,
                nav: true,
                navText: [
                    "<span class='arrow_carrot-left'>",
                    "<span class='arrow_carrot-right'>",
                ],
            },
        },
    });
    $('.schedule-submit').on('click',function() {
        var data = $('#schedule-form').serializeArray();
        $('.error').addClass('hidden');
        // $(".schedule-submit").attr("disabled", true);
        $("#loading").show();
        $.ajax({
            url: url_schedule_submit,
            method: 'POST',
            data: data,
            success: function(data) {
                if(data.errors){
                    $.each(data.validator, (k, v) => {
                        $("." + k).removeClass('hidden');
                        $("." + k +"_message").text(v[0]);
                        $('#loading').hide();
                        $(".send_checkout_information").removeAttr("disabled")
                    })
                }else{
                    window.location.reload();
                }
            },
            complete: () => $(".send_checkout_information").removeAttr("disabled")
        });
    });
})(jQuery);
