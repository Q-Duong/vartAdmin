$('.close-model').on('click', function() {
    $('.popup-model-review').fadeOut(300);
});

$('.overlay-model-review').on('click', function() {
    $('.popup-model-review').fadeOut(300);
});

//Handle Money and Quantity
function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
}

function formatNumber1(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, "")
}

function formatCurrency(input, blur) {
    var input_val = input.val();
    if (input_val === "") {
        return;
    }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionEnd");
    if (input_val.indexOf(",") >= 0) {
        var decimal_pos = input_val.indexOf(",");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);

        input_val = left_side;

    } else {
        input_val = formatNumber(input_val);
    }

    input.val(input_val);


    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formatQuantity(input) {
    var input_val = input.val();
    if (input_val === "") {
        return;
    }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionEnd");
    input_val = formatNumber1(input_val);
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

(function ($) {
    
    $(window).on("load", function () {
        $(".loader-over").fadeOut();
    });

    // Tool select2
    $(document).ready(function() {
        $('.select-2').select2();
    });

    // Handle Notifications
    $(document).ready(function() {
        setTimeout(function() {
            $('.notifications-popup-success').removeClass('active');
        }, 3000);
        setTimeout(function() {
            $('.notifications-popup-error').removeClass('active');
        }, 3000);
    });


})(jQuery);
