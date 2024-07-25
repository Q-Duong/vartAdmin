$(".button-submit").on("click", function () {
    var formData = new FormData($("#submit-form")[0]);
    formData.append(main + "_content", editor1.getData());
    formData.append(main + "_content_en", editor2.getData());
    $(".form-element").removeClass("is-error");
    $(".error").addClass("hidden");
    $(".button-submit").attr("disabled", true);
    $(".loading-container").show();
    $.ajax({
        url: url_create_or_update,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.errors) {
                $.each(data.validator, (k, v) => {
                    console.log(v);
                    errorsMsgInput(k, v);
                });
                $(".loading-container").delay(200).fadeOut("slow");
                $(".button-submit").removeAttr("disabled");
            } else if (data.errorsExists) {
                errorMsg(data.message);
                $.each(data.validator, (k, v) => {
                    errorMsgInput(k, v);
                });
                $(".loading-container").delay(200).fadeOut("slow");
                $(".button-submit").removeAttr("disabled");
            } else {
                location.replace(data.route);
            }
        },
    });
});
