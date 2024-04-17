$(".select-object-group").on("change", function () {
    var value = $(this).val();
    if (value == "Sinh Viên") {
        $(".register-degree-block").addClass("hidden");
        $(".register-image-block").addClass("hidden");
        $(".register-graduation-year").addClass("hidden");
        $(".register-work-unit-label").addClass("hidden");
        $(".register-work-unit-block").addClass("hidden");
        $(".object-group-guest").addClass("hidden");
        $(".object-group-guest select").attr("disabled", true);
        $(".object-group-student select").attr("disabled", false);
        $(".register-object-group-input").addClass("hidden");
        $(".object-group-student").removeClass("hidden");
        $(".register-image-card-block").removeClass("hidden");
    } else {
        $(".object-group-guest").removeClass("hidden");
        $(".register-degree-block").removeClass("hidden");
        $(".register-image-block").removeClass("hidden");
        $(".register-graduation-year").removeClass("hidden");
        $(".register-work-unit-label").removeClass("hidden");
        $(".register-work-unit-block").removeClass("hidden");
        $(".register-object-group-input").addClass("hidden");
        $(".object-group-student").addClass("hidden");
        $(".object-group-student select").attr("disabled", true);
        $(".object-group-guest select").attr("disabled", false);
        $(".register-image-card-block").addClass("hidden");
    }
});

$(".register-object-group").on("change", function () {
    var value = $(this).val();
    if (value == "") {
        $(".register-object-group-input").removeClass("hidden");
        $(".object-group-input").attr("disabled", false);
    } else {
        $(".register-object-group-input").addClass("hidden");
        $(".object-group-input").attr("disabled", true);
    }
});

$(".choose_address").on("change", function () {
    var action = $(this).attr("id");
    var select_id = $(this).val();
    var _token = $('input[name="_token"]').val();
    var result = "";
    if (action == "province") {
        result = "district";
    } else {
        result = "wards";
    }
    $.ajax({
        url: url_select_address,
        method: "POST",
        data: {
            action: action,
            select_id: select_id,
            _token: _token,
        },
        success: function (data) {
            $("#" + result).html(data.result);
        },
    });
});

$("#file-image, #file-card, #file-payment-image").change(function () {
    $(this)
        .next()
        .html(
            '<i class="far fa-check-circle check-success"></i><p>' +
                $(this).val().split("\\").pop() +
                "</p>"
        );
});

$(".button-submit").on("click", function () {
    var formData = new FormData($("#register-form")[0]);
    $(".form-element").removeClass("is-error");
    $(".error").addClass("hidden");
    $(".button-submit").attr("disabled", true);
    $("#loading").show();
    $.ajax({
        url: url_register_submit,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.errors) {
                $.each(data.validator, (k, v) => {
                    errorsMsgInput(k, v);
                });
                $("#loading").delay(200).fadeOut("slow");
                $(".button-submit").removeAttr("disabled");
            } else if (data.errorsExists) {
                errorMsg(data.message);
                $.each(data.validator, (k, v) => {
                    errorMsgInput(k, v);
                });
                $("#loading").delay(200).fadeOut("slow");
                $(".button-submit").removeAttr("disabled");
            } else if (data.errorsExistsEmail) {
                errorMsgInput("en_register_email", data.en_register_email);
                $("#loading").delay(200).fadeOut("slow");
                $(".button-submit").removeAttr("disabled");
            } else {
                window.location.assign("../../../" + data.route);
            }
        },
    });
});
