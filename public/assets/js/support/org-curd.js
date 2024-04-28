function clearForm() {
    $(".popup-model-review").fadeOut(300);
    $("#" + form_name)[0].reset();
    $(".img-thumb").html("");
    $(".img-thumb-en").html("");
    editor1.setData("");
    editor2.setData("");
}

function loadContent() {
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url_load_content,
        method: "POST",
        data: {
            host_id: host_id,
            _token: _token,
        },
        success: function (data) {
            $(".list-content").html(data.html);
        },
    });
}

function createContent(title) {
    clearForm();
    $(".popup-model-review").fadeIn(300);
    $(".model-review-tile").html(title);
    $('input[name="type"]').val("create");
    $(".btn-content").html(
        '<button type="button" class="primary-btn-submit button-submit">' +
            title +
            "</button>"
    );
}

function updateContent(e, title) {
    $(".popup-model-review").fadeIn(300);
    $(".model-review-tile").html(title);
    $('input[name="type"]').val("update");
    $(".btn-content").html(
        '<button type="button" class="primary-btn-submit button-submit">' +
            title +
            "</button>"
    );
    $('input[name="' + main_content + '_content_id"]').val(
        $("." + main_content + "_content_id_" + e).val()
    );
    $('input[name="' + main_content + '_content_title"]').val(
        $("." + main_content + "_content_title_" + e).val()
    );
    $('input[name="' + main_content + '_content_title_en"]').val(
        $("." + main_content + "_content_title_en_" + e).val()
    );
    var content_image = $("." + main_content + "_content_image_" + e).val();
    if (content_image != "") {
        var html =
            '<img src="' +
            assetImg +
            "/" +
            content_image +
            '" class="main-item-detail-image">';
        $(".img-thumb").html(html);
    } else {
        $(".img-thumb").html("");
    }
    var content_image_en = $(
        "." + main_content + "_content_image_en_" + e
    ).val();
    if (content_image_en != "") {
        var html_en =
            '<img src="' +
            assetImg +
            "/" +
            content_image_en +
            '" class="main-item-detail-image">';
        $(".img-thumb-en").html(html_en);
    } else {
        $(".img-thumb-en").html("");
    }
    editor1.setData($("." + main_content + "_content_text_" + e).html());
    editor2.setData($("." + main_content + "_content_text_en_" + e).html());
}

function deleteContent(e) {
    var _token = $('input[name="_token"]').val();
    url_del_content = url_del_content.replace(":id", e);
    $.ajax({
        url: url_del_content,
        type: "DELETE",
        data: {
            _token: _token,
        },
        success: function (data) {
            url_del_content = url_del_content.replace(e, ":id");
            successMsg(data.message);
            loadContent();
        },
    });
}
$(document).on("click", ".button-submit", function () {
    var formData = new FormData($("#" + form_name)[0]);
    formData.append(main_content + "_content_text", editor1.getData());
    formData.append(main_content + "_content_text_en", editor2.getData());
    $(".error").addClass("hidden");
    $(".button-submit").attr("disabled", true);
    $(".loader").fadeIn();
    $("#preloder").fadeIn("slow");
    $.ajax({
        url: url_create_or_update_content,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.errors) {
                $.each(data.validator, (k, v) => {
                    errorsMsgInput(k, v);
                });
            } else {
                successMsg(data.message);
                loadContent();
                clearForm();
            }
            $(".button-submit").removeAttr("disabled");
            $(".loader").fadeOut();
            $("#preloder").fadeOut("slow");
        },
    });
});
