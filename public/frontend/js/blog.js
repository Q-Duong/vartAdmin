$(".comment-submit").on("click", function () {
    var data = $("#comment-form").serializeArray();
    $(".error").addClass("hidden");
    // $(".schedule-submit").attr("disabled", true);
    $("#loading").show();
    $.ajax({
        url: url_comment_submit,
        method: "POST",
        data: data,
        success: function (data) {
            if (data.errors) {
                $.each(data.validator, (k, v) => {
                    $("." + k).removeClass("hidden");
                    $("." + k + "_message").text(v[0]);
                    $("#loading").hide();
                    $(".send_checkout_information").removeAttr("disabled");
                });
            } else {
                successMsg(data.message);
            }
        },
    });
});

$(document).on("click", ".btn-show-more", function (e) {
    var blog_id = $('input[name="blog_id"]').val();
    var paginate = $('.paginate').val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url_paginate_comment,
        method: "POST",
        data: {
            _token: _token,
            blog_id: blog_id,
            paginate: paginate
        },
        success: function (data) {
            $(".list-comment").html(data.html);
        },
    });
});

