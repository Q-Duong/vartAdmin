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
            name: "member_full_name",
            value: $(".member-full-name").val(),
        },
        {
            name: "member_email",
            value: $(".member-email").val(),
        },
        {
            name: "member_phone",
            value: $(".member-phone").val(),
        },
        {
            name: "payment_status",
            value: $(".payment-status").val(),
        },
    ];
}

$(document).on(
    "change",
    ".id, .register-code, .member-full-name, .member-email, .member-phone, .payment-status",
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