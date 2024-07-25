function clearForm() {
    $(".popup-model-review").fadeOut(300);
    $("#" + main_content)[0].reset();
    $(".img-thumb").html("");
    $(".img-thumb-en").html("");
    editor3.setData("");
    editor4.setData("");
    FilePond.setOptions({
        files: [],
    });
    $(".alert-error").addClass("hidden");
}

function loadContent() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url_load_content,
        method: "POST",
        data: {
            host_id: host_id,
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
        '<button type="button" class="primary-btn-submit button-submit">Create</button>'
    );
}

function updateContent(e, title) {
    $(".popup-model-review").fadeIn(300);
    $(".model-review-tile").html(title);
    $('input[name="type"]').val("update");
    $(".btn-content").html(
        '<button type="button" class="primary-btn-submit button-submit">Update</button>'
    );
    $('input[name="' + main_content + '_id"]').val(
        $("." + main_content + "_id_" + e).val()
    );
    $('input[name="' + main_content + '_title"]').val(
        $("." + main_content + "_title_" + e).val()
    );
    $('input[name="' + main_content + '_title_en"]').val(
        $("." + main_content + "_title_en_" + e).val()
    );
    $('input[name="' + main_content + '_code"]').val(
        $("." + main_content + "_code_" + e).val()
    );
    $('input[name="' + main_content + '_price"]').val(
        $("." + main_content + "_price_" + e).val()
    );
    $('input[name="' + main_content + '_date"]').val(
        $("." + main_content + "_date_" + e).val()
    );
    var content_image = $("." + main_content + "_image_" + e).val();
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
    var content_image_en = $("." + main_content + "_image_en_" + e).val();
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
    if (main_content == "conference_fee") {
        editor3.setData($("." + main_content + "_content_" + e).html());
        editor4.setData($("." + main_content + "_desc_" + e).html());
        $(
            '.conference_fee_type option[value="' +
                $("." + main_content + "_type_" + e).val() +
                '"]'
        ).prop("selected", true);
        $('.mail_type option[value="' + $(".mail_type_" + e).val() + '"]').prop(
            "selected",
            true
        );
    } else {
        editor3.setData($("." + main_content + "_text_" + e).html());
        editor4.setData($("." + main_content + "_text_en_" + e).html());
    }
}

function deleteContent(e) {
    $(".loader-over").fadeIn();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url_del_content,
        type: "DELETE",
        data: {
            id: e,
        },
        success: function (data) {
            successMsg(data.message);
            loadContent();
            $(".loader-over").fadeOut();
        },
    });
}
$(document).on("click", ".button-submit", function () {
    var formData = new FormData($("#" + main_content)[0]);
    if (main_content == "conference_fee") {
        formData.append(main_content + "_content", editor3.getData());
        formData.append(main_content + "_desc", editor4.getData());
    } else {
        formData.append(main_content + "_text", editor3.getData());
        formData.append(main_content + "_text_en", editor4.getData());
    }
    $(".error").addClass("hidden");
    $(".button-submit").attr("disabled", true);
    $(".loader-over").fadeIn();
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
            $(".loader-over").fadeOut();
        },
    });
});
