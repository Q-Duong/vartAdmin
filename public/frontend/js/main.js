/*------------------
        Preloader
    --------------------*/
$(window).on("load", function () {
    $("#loading").fadeOut();

    /*------------------
            Gallery filter
        --------------------*/
    $(".filter__controls li").on("click", function () {
        $(".filter__controls li").removeClass("active");
        $(this).addClass("active");
    });
    if ($(".product__filter").length > 0) {
        var containerEl = document.querySelector(".product__filter");
        var mixer = mixitup(containerEl);
    }

    /*------------------
            Background Set
        --------------------*/
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });
});

/*------------------
        Scroll Up
    --------------------*/
var btn = $("#button");

$(window).scroll(function () {
    if ($(window).scrollTop() > 200) {
        btn.addClass("show");
    } else {
        btn.removeClass("show");
    }
});

btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "200");
});

//Search Switch
$(".search-switch").on("click", function () {
    $(".search-model").fadeIn(400);
});

$(".search-close-switch").on("click", function () {
    $(".search-model").fadeOut(400, function () {
        $("#search-input").val("");
    });
});

$(".overlay").on("click", function () {
    $(".search-model").fadeOut(400, function () {
        $("#search-input").val("");
    });
});

//Acount
$(".header__top__hover").on("click", function () {
    if (!$(".header__top__hover ul").is(":visible")) {
        $(".header__top__hover ul").fadeIn(0);
    } else {
        $(".header__top__hover ul").fadeOut(0);
    }
});

$(".bodyContainer").on("click", function () {
    $(".header__top__hover ul").fadeOut(0);
});

$(".offcanvas__top__hover ").on("click", function () {
    $(".offcanvas__top__hover ul").fadeIn(0);
});

$(".offcanvas__text").on("click", function () {
    $(".offcanvas__top__hover ul").fadeOut(0);
});
/*------------------
		Navigation
	--------------------*/
$(".mobile-menu-nav").slicknav({
    prependTo: "#mobile-menu-wrap",
    allowParentLinks: true,
});

/*------------------
        Accordin Active
    --------------------*/
$(".collapse").on("shown.bs.collapse", function () {
    $(this).prev().addClass("active");
});

$(".collapse").on("hidden.bs.collapse", function () {
    $(this).prev().removeClass("active");
});

//Canvas Menu
$(".canvas__open").on("click", function () {
    if ($(this).attr("menu") == "close") {
        $(this).attr("menu", "open");
        $(".menu-icon").addClass("active");
        $(".offcanvas-menu-wrapper").addClass("active");
    } else {
        $(this).attr("menu", "close");
        $(".menu-icon").removeClass("active");
        $(".offcanvas-menu-wrapper").removeClass("active");
    }
});

// $(".button-languages").on("click", function () {
//     if($(this).attr('dropdown') == 'false'){
//         $(this).attr('dropdown','true');
//         $('.language-dropdown-menu').fadeIn('fast');
//     }else{
//         $(this).attr('dropdown','false');
//         $('.language-dropdown-menu').fadeOut('fast');
//     }
// });

$(document).click(function () {
    $(".language-dropdown-menu").fadeOut("fast");
});

$(".button-languages").click(function (e) {
    e.stopPropagation();
    $(".language-dropdown-menu").fadeIn("fast");
});

/*--------------------------
        Select
    ----------------------------*/
// $("select").niceSelect();

/*-------------------
		Radio Btn
	--------------------- */
$(
    ".product__color__select label, .shop__sidebar__size label, .product__details__option__size label"
).on("click", function () {
    $(
        ".product__color__select label, .shop__sidebar__size label, .product__details__option__size label"
    ).removeClass("active");
    $(this).addClass("active");
});

/*------------------
        CountDown
    --------------------*/
// For demo preview start
var today = new Date();
var dd = String(today.getDate()).padStart(2, "0");
var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
var yyyy = today.getFullYear();

if (mm == 12) {
    mm = "01";
    yyyy = yyyy + 1;
} else {
    mm = parseInt(mm) + 1;
    mm = String(mm).padStart(2, "0");
}
var timerdate = mm + "/" + dd + "/" + yyyy;
// For demo preview end

/*------------------
        Achieve Counter
    --------------------*/
$(".cn_num").each(function () {
    $(this)
        .prop("Counter", 0)
        .animate(
            {
                Counter: $(this).text(),
            },
            {
                duration: 4000,
                easing: "swing",
                step: function (now) {
                    $(this).text(Math.ceil(now));
                },
            }
        );
});

/*------------------
        Search Handle
    --------------------*/
$(".search-switch").on("click", function () {
    $("input[name=keywords_submit]").focus();
});

$("#keywords").keyup(function () {
    var query = $(this).val();

    if (query != "") {
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: "{{ url('/autocomplete-ajax') }}",
            method: "POST",
            data: {
                query: query,
                _token: _token,
            },
            success: function (data) {
                $("#search_ajax").fadeIn();
                $("#search_ajax").html(data);
            },
        });
    } else {
        $("#search_ajax").fadeOut();
    }
});

$(document).on("click", ".li_search_ajax", function () {
    $("#keywords").val($(this).text());
    $("#search_ajax").fadeOut();
});

$(document).on("keyup click", "input", function () {
    $(this).val() == ""
        ? $(this).removeClass("form-textbox-entered")
        : $(this).addClass("form-textbox-entered");
});

function successMsg(msg) {
    $(".notifications-popup-success").addClass("active");
    $(".notifications-icon").html(
        '<i class="fas fa-solid fa-check notifications-success"></i>'
    );
    $(".message-text").text(msg);
    setTimeout(function () {
        $(".notifications-popup-success").removeClass("active");
    }, 3000);
    $(".notifications-close").click(function () {
        $(".notifications-popup-success").removeClass("active");
    });
}

function errorMsg(msg) {
    $(".notifications-popup-error").addClass("active");
    $(".notifications-icon").html(
        '<i class="fas fa-times notifications-error"></i>'
    );
    $(".message-text").text(msg);
    setTimeout(function () {
        $(".notifications-popup-error").removeClass("active");
    }, 3000);
    $(".notifications-close").click(function () {
        $(".notifications-popup-error").removeClass("active");
    });
}
$(document).ready(function () {
    setTimeout(function () {
        $(".notifications-popup-success").removeClass("notifications-active");
    }, 3000);
    setTimeout(function () {
        $(".notifications-popup-error").removeClass("notifications-active");
    }, 3000);
});
