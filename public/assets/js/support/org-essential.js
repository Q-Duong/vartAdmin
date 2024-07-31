function errorsMsgInput($class, $message) {
    $("." + $class)
        .parent()
        .addClass("is-error");
    $("." + $class).removeClass("hidden");
    $("." + $class + "_message").text($message[0]);
}
function errorMsgInput($class, $message) {
    $("." + $class)
        .parent()
        .addClass("is-error");
    $("." + $class).removeClass("hidden");
    $("." + $class + "_message").text($message);
}
function successMsg(msg) {
    $(".notifications-popup-success").addClass("active");
    $(".notifications-icon").html(
        '<i class="fas fa-solid fa-check notifications-success"></i>'
    );
    $(".message-text").text(msg);
    setTimeout(function () {
        $(".notifications-popup-success").removeClass("active");
    }, 3000);
    $(".notifications-close").click(function () {
        $(".notifications-popup-success").removeClass("active");
    });
}
function errorMsg(msg) {
    $(".notifications-popup-error").addClass("active");
    $(".notifications-icon").html(
        '<i class="fas fa-times notifications-error"></i>'
    );
    $(".message-text").text(msg);
    setTimeout(function () {
        $(".notifications-popup-error").removeClass("active");
    }, 3000);
    $(".notifications-close").click(function () {
        $(".notifications-popup-error").removeClass("active");
    });
}
$(".form-textbox").on("keyup", function () {
    $(this).next().addClass("hidden");
    $(this).parent().removeClass("is-error");
});
$(".file").on("change", function () {
    $(this).next().next().addClass("hidden");
    $(this).parent().removeClass("is-error");
});
$(".select-textbox").on("change", function () {
    $(this).next().addClass("hidden");
    $(this).parent().removeClass("is-error");
});
$(".button-submit").click(function () {
    $(".loading-container").fadeIn();
});
$(".button-delete").click(function (e) {
    if (confirm("Do you want to delete this item?")) {
        $(".loading-container").show();
        $('#delete-form').submit();
    }else{
        e.preventDefault();
        $("#loading").delay(200).fadeOut("slow");
    }
});