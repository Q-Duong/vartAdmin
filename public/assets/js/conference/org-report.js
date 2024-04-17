//Register Report
$(document).ready(function () {
    $(".report_degree").on("change", function () {
        var value = $(this).val();
        if (value == "Sinh viên") {
            $(".report-graduation-year").addClass("hidden");
            $(".report-image-block").addClass("hidden");
            $(".report-image-card-block").removeClass("hidden");
        } else {
            $(".report-image-card-block").addClass("hidden");
            $(".report-image-block").removeClass("hidden");
            $(".report-graduation-year").removeClass("hidden");
        }
    });
});

$("#file-abstract, #file-card, #file-image").change(function () {
    $(this)
        .next()
        .html(
            '<i class="far fa-check-circle check-success"></i><p>' +
                $(this).val().split("\\").pop() +
                "</p>"
        );
});

$(".button-submit").on("click", function () {
    var formData = new FormData($("#report-form")[0]);
    $(".error").addClass("hidden");
    $(".button-submit").attr("disabled", true);
    $("#loading").show();
    $.ajax({
        url: url_register_report_submit,
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
            } else {
                window.location.assign("../../" + data.route);
            }
        },
        complete: () => $(".button-submit").removeAttr("disabled"),
    });
});
