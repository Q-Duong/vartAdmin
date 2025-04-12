$(".button-submit").on("click", function () {
    var formData = new FormData($("#update-form")[0]);
    $(".form-element").removeClass("is-error");
    $(".error").addClass("hidden");
    $(".button-submit").attr("disabled", true);
    $(".loading-container").show();
    $.ajax({
        url: url_update,
        method: "post",
        data: formData,
        processData: false,
        contentType: false,
    })
    .done(function (data) {
        if (data.errors) {
            $.each(data.validator, (k, v) => {
                errorsMsgInput(k, v);
            });
            $(".loading-container").delay(200).fadeOut("slow");
            $(".button-submit").removeAttr("disabled");
        } else {
            $(".loading-container").delay(200).fadeOut("slow");
            if(data.success){
                successMsg(data.message);
            }else{
                errorMsg(data.message);
            }
            setTimeout(function () {
                location.replace(data.route);
            }, 1500);
        }
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        if(textStatus == "419"){
            popupNotificationSessionExpired();
        }
    })
    .complete(function () {
        $(".button-submit").removeAttr("disabled")
        $(".loading-container").fadeOut();
    });
});
