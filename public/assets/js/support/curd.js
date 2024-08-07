function clearForm() {
    $(".popup-model-review").fadeOut(300),
        $("#" + main_content)[0].reset(),
        $(".img-thumb").html(""),
        $(".img-thumb-en").html(""),
        editor3.setData(""),
        editor4.setData(""),
        FilePond.setOptions({ files: [] }),
        $(".alert-error").addClass("hidden");
}
function loadContent() {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url_load_content,
        method: "POST",
        data: { host_id: host_id },
        success: function (t) {
            $(".list-content").html(t.html);
        },
    });
}
function createContent(t) {
    clearForm(),
        $(".popup-model-review").fadeIn(300),
        $(".model-review-tile").html(t),
        $('input[name="type"]').val("create"),
        $(".btn-content").html(
            '<button type="button" class="primary-btn-submit button-submit">Create</button>'
        );
}
function updateContent(t, e) {
    $(".popup-model-review").fadeIn(300),
        $(".model-review-tile").html(e),
        $('input[name="type"]').val("update"),
        $(".btn-content").html(
            '<button type="button" class="primary-btn-submit button-submit">Update</button>'
        ),
        $('input[name="' + main_content + '_id"]').val(
            $("." + main_content + "_id_" + t).val()
        ),
        $('input[name="' + main_content + '_title"]').val(
            $("." + main_content + "_title_" + t).val()
        ),
        $('input[name="' + main_content + '_title_en"]').val(
            $("." + main_content + "_title_en_" + t).val()
        ),
        $('input[name="' + main_content + '_code"]').val(
            $("." + main_content + "_code_" + t).val()
        ),
        $('input[name="' + main_content + '_price"]').val(
            $("." + main_content + "_price_" + t).val()
        ),
        $('input[name="' + main_content + '_date"]').val(
            $("." + main_content + "_date_" + t).val()
        );
    var n = $("." + main_content + "_image_" + t).val();
    if ("" != n) {
        var a =
            '<img src="' +
            assetImg +
            "/" +
            n +
            '" class="main-item-detail-image">';
        $(".img-thumb").html(a);
    } else $(".img-thumb").html("");
    var o = $("." + main_content + "_image_en_" + t).val();
    if ("" != o) {
        var i =
            '<img src="' +
            assetImg +
            "/" +
            o +
            '" class="main-item-detail-image">';
        $(".img-thumb-en").html(i);
    } else $(".img-thumb-en").html("");
    "conference_fee" == main_content
        ? (editor3.setData($("." + main_content + "_content_" + t).html()),
          editor4.setData($("." + main_content + "_desc_" + t).html()),
          $(
              '.conference_fee_type option[value="' +
                  $("." + main_content + "_type_" + t).val() +
                  '"]'
          ).prop("selected", !0),
          $(
              '.mail_type option[value="' + $(".mail_type_" + t).val() + '"]'
          ).prop("selected", !0))
        : (editor3.setData($("." + main_content + "_text_" + t).html()),
          editor4.setData($("." + main_content + "_text_en_" + t).html()));
}
function deleteContent(t) {
    $(".loading-container").fadeIn(),
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url_del_content,
            type: "DELETE",
            data: { id: t },
            success: function (t) {
                successMsg(t.message),
                    loadContent(),
                    $(".loading-container").fadeOut();
            },
        });
}
$(document).on("click", ".button-submit", function () {
    var t = new FormData($("#" + main_content)[0]);
    "conference_fee" == main_content
        ? (t.append(main_content + "_content", editor3.getData()),
          t.append(main_content + "_desc", editor4.getData()))
        : (t.append(main_content + "_text", editor3.getData()),
          t.append(main_content + "_text_en", editor4.getData())),
        $(".error").addClass("hidden"),
        $(".button-submit").attr("disabled", !0),
        $(".loading-container").fadeIn(),
        $.ajax({
            url: url_create_or_update_content,
            type: "POST",
            data: t,
            processData: !1,
            contentType: !1,
            success: function (t) {
                t.errors
                    ? $.each(t.validator, (t, e) => {
                          errorsMsgInput(t, e);
                      })
                    : (successMsg(t.message), loadContent(), clearForm()),
                    $(".button-submit").removeAttr("disabled"),
                    $(".loading-container").fadeOut();
            },
        });
});
