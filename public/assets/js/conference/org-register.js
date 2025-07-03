function getValuesFilter() {
    return [
        {
            name: "current_page",
            value: $('input[name="current_page"]').val(),
        },
        {
            name: "conference_id",
            value: $('input[name="conference_id"]').val(),
        },
        {
            name: "id",
            value: $(".id").val(),
        },
        {
            name: "register_code",
            value: $(".register-code").val(),
        },
        {
            name: "register_name",
            value: $(".register-name").val(),
        },
        {
            name: "register_email",
            value: $(".register-email").val(),
        },
        {
            name: "register_phone",
            value: $(".register-phone").val(),
        },
        {
            name: "conference_fee_title",
            value: $(".conference-fee-title").val(),
        },
        {
            name: "payment_status",
            value: $(".payment-status").val(),
        },
    ];
}

$(document).on(
    "change",
    ".id, .register-code, .register-name, .register-email, .register-phone, .conference-fee-title, .payment-status",
    function () {
        var data = getValuesFilter();
        $(".loader-over").fadeIn();
        $.ajax({
            url: url_filter_register,
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: data,
        })
            .done(function (data) {
                if (data.flagEmpty) {
                    $(".table-pagination").removeClass("hidden");
                } else {
                    $(".table-pagination").addClass("hidden");
                }
                $(".tbody-content").html(data.html);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                popupNotificationSessionExpired();
            })
            .complete(function () {
                $(".loader-over").fadeOut();
            });
    }
);