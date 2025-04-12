function errorsMsgInput($class, $message) {
    $("." + $class)
        .parent()
        .addClass("is-error");
    $("." + $class + "-form-message").text($message[0]);
}
function errorMsgInput($class, $message) {
    $("." + $class)
        .parent()
        .addClass("is-error");
    $("." + $class + "-form-message").text($message);
}
function successMsg(msg) {
    $(".notifications-popup-success").addClass("active");
    $(".notifications-icon").html(
        '<i class="fa-solid fa-exclamation notifications-success"></i>'
    );
    $(".message-text").text(msg);
    setTimeout(function () {
        $(".notifications-popup-success").removeClass("active");
    }, 3000);
    $(document).on("click", ".notifications-close", function () {
        $(".notifications-popup-success").removeClass("active");
    });
}
function errorMsg(msg) {
    $(".notifications-popup-error").addClass("active");
    $(".notifications-icon").html(
        '<i class="fa-solid fa-exclamation notifications-error"></i>'
    );
    $(".message-text").text(msg);
    $(document).on("click", ".notifications-close", function () {
        $(".notifications-popup-error").removeClass("active");
    });
}
function popupNotificationSessionExpired() {
    $("[data-core-overlay-session]").fadeIn(300);
    $('body').css('overflow', 'hidden');
}
$(document).on("keyup", ".form-textbox", function () {
    $(this).removeClass("is-error");
});
$(document).on("change", ".file", function () {
    $(this).parent().removeClass("is-error");
});
$(document).on("change", ".form-dropdown", function () {
    $(this).removeClass("is-error");
});
$(document).on("change", ".choose-address", function () {
    $(this).find("option:selected").val() !== ""
        ? $(this).removeClass("form-dropdown-selectnone")
        : $(this).addClass("form-dropdown-selectnone");
});
$(document).on("keyup click", "input", function () {
    $(this).val() == ""
        ? $(this).removeClass("form-textbox-entered")
        : $(this).addClass("form-textbox-entered");
});

$(".button-delete").click(function (e) {
    if (confirm("Do you want to delete this item?")) {
        $(".loading-container").show();
        $("#delete-form").submit();
    } else {
        e.preventDefault();
        $("#loading").delay(200).fadeOut("slow");
    }
});
