function getScripts(scripts) {
    var progress = 0;
    scripts.forEach(function (script) {
        $.getScript(script, function () {
            if (++progress == scripts.length);
        });
    });
}
getScripts(script_arr);
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
    })
        .done(function (data) {
            $(".list-content").html(data.html);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if(textStatus === 419){
                popupNotificationSessionExpired();
            }
        })
        .complete(function () {
            $(".loading-container").fadeOut();
        });
}
function createContent(type) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url_get_form,
        method: "POST",
        data: { type: type },
    })
        .done(function (data) {
            $("#portal").html(data.html);
            getScripts(script_arr);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if(textStatus === 419){
                popupNotificationSessionExpired();
            }
        })
        .complete(function () {
            $(".loading-container").fadeOut();
        });
}
function updateContent(type, id) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url_get_form,
        method: "POST",
        data: { type: type, id: id },
    })
        .done(function (data) {
            getScripts(script_arr);
            $("#portal").html(data.html);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if(textStatus === 419){
                popupNotificationSessionExpired();
            }
        })
        .complete(function () {
            $(".loading-container").fadeOut();
        });
}
function deleteContent(id) {
    if (confirm("Do you want to delete this item?")) {
        $(".loading-container").fadeIn();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: url_delete,
            type: "DELETE",
            data: {
                id: id,
            },
        })
            .done(function (data) {
                successMsg(data.message);
                loadContent();
                $(".loading-container").fadeOut();
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                if(textStatus === 419){
                    popupNotificationSessionExpired();
                }
            })
            .complete(function () {
                $(".loading-container").fadeOut();
            });
    }
}
function deleteImage(target, locale, id) {
    $(".loading-container").fadeIn();
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url_file_destroy_content,
        type: "DELETE",
        data: {
            target: target,
            locale: locale,
            id: id,
        },
    })
        .done(function (data) {
            loadContent();
            if(locale == "en"){
                $(".img-thumb-en").html("");
                $("." + main_content + "-image-en-filepond").removeClass("hidden");
            }else{
                $(".img-thumb").html("");
                $("." + main_content + "-image-filepond").removeClass("hidden");
            }
            $(".loading-container").delay(200).fadeOut("slow");
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if(textStatus === 419){
                popupNotificationSessionExpired();
            }
        })
        .complete(function () {
            $(".loading-container").fadeOut();
        });
}
$(document).on("click", ".button-submit", function () {
    var formData = new FormData($("#" + main_content)[0]);
    if (main_content == "conference_fee") {
        formData.append(main_content + "_content", editor3.getData());
        formData.append(main_content + "_desc", editor4.getData());
    }
    if (main_content == "conference") {
        formData.append(main_content + "_content", editor3.getData());
        formData.append(main_content + "_content_en", editor4.getData());
    }
    if (main_content != "blog_category") {
        formData.append(main_content + "_text", editor3.getData());
        formData.append(main_content + "_text_en", editor4.getData());
    }

    $(".form-textbox").removeClass("is-error");
    $(".button-submit").attr("disabled", true);
    $(".loading-container").fadeIn();
    $.ajax({
        url: url_create_or_update,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
    })
        .done(function (data) {
            if (data.errors) {
                $.each(data.validator, (k, v) => {
                    errorsMsgInput(k, v);
                });
            } else if (data.errorsExists) {
                errorMsg(data.message);
                $.each(data.validator, (k, v) => {
                    errorMsgInput(k, v);
                });
            }else {
                $("#portal").html("");
                successMsg(data.message);
                loadContent();
            }
            $(".loading-container").delay(200).fadeOut("slow");
            $(".button-submit").removeAttr("disabled");
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            if(textStatus === 419){
                popupNotificationSessionExpired();
            }
        })
        .complete(function () {
            $(".loading-container").fadeOut();
        });
});
