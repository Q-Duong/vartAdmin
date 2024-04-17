"use strict";
function quantityFunction(event) {
    var name = event.target["name"];
    $("input[name=" + name + "]").on({
        keyup: function () {
            formatQuantity($(this));
        },
        input: function () {
            var split = name.split("_");
            var id = split[2];
            var order_quantity = $("input[name=" + name + "]").val();
            var order_cost = $(".order_cost_" + id).val();
            if (order_quantity != "" && order_cost != "") {
                var order_cost_format = order_cost
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
                var total =
                    parseInt(order_quantity) * parseInt(order_cost_format);
                var order_price = new Intl.NumberFormat("vi-VN").format(total);
                $(".order_price_" + id).val(order_price);
            } else {
                // $('.order_cost_' + id).val(0);
                $(".order_price_" + id).val(0);
            }
        },
    });
}
function costFunction(event) {
    var name = event.target["name"];

    $("input[name=" + name + "]").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
        input: function () {
            var split = name.split("_");
            var id = split[2];
            var order_quantity = $(".order_quantity_" + id).val();
            var order_cost = $("input[name=" + name + "]").val();
            if (order_quantity != "" && order_cost != "") {
                var order_cost_format = order_cost
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
                var total =
                    parseInt(order_quantity) * parseInt(order_cost_format);
                var order_price = new Intl.NumberFormat("vi-VN").format(total);
                $(".order_price_" + id).val(order_price);
            } else {
                $(".order_price_" + id).val(0);
            }
            var order_cost_replace = order_cost
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
            var order_cost_format = new Intl.NumberFormat("vi-VN").format(
                order_cost_replace
            );
            $(".order_cost_" + id).val(order_cost_format);
        },
    });
}
function priceFunction(event) {
    var name = event.target["name"];

    $("input[name=" + name + "]").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
        input: function () {
            var split = name.split("_");
            var id = split[2];
            var order_price = $(this).val();
            var order_price_replace = order_price
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
            var order_price_format = new Intl.NumberFormat("vi-VN").format(
                order_price_replace
            );
            $(".order_price_" + id).val(order_price_format);
        },
    });
}
function amountPaidFunction(event) {
    var name = event.target["name"];

    $("input[name=" + name + "]").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
        input: function () {
            var split = name.split("_");
            var id = split[3];
            var order_price = $(".order_price_" + id).val();
            var amount_paid = $(this).val();
            if (amount_paid != "" && order_price != "") {
                var order_price_format = order_price
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
                var amount_paid_format = amount_paid
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
                var owe =
                    parseInt(order_price_format) - parseInt(amount_paid_format);
                var owe_format = new Intl.NumberFormat("vi-VN").format(owe);
                $(".accountant_owe_" + id).val(owe_format);
            } else {
                $(".accountant_owe_" + id).val(order_price);
            }
            var amount_paid_replace = amount_paid
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
            var amount_paid_format = new Intl.NumberFormat("vi-VN").format(
                amount_paid_replace
            );
            $(".accountant_amount_paid_" + id).val(amount_paid_format);
        },
    });
}
function discountFunction(event) {
    var name = event.target["name"];
    var split = name.split("_");
    var id = split[2];
    $("input[name=" + name + "]").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
        input: function () {
            var order_price = $(".order_price_" + id).val();
            var discount = $(this).val();
            var order_price_format = order_price
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");

            if (discount != "" && order_price != "") {
                var discount_format = discount
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
                var order_profit =
                    parseInt(order_price_format) - parseInt(discount_format);
                var order_profit_format = new Intl.NumberFormat("vi-VN").format(
                    order_profit
                );
                $(".order_profit_" + id).val(order_profit_format);
            } else {
                $(".order_profit_" + id).val(order_price);
            }
            var discount_replace = discount
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
            var discount_format = new Intl.NumberFormat("vi-VN").format(
                discount_replace
            );
            $(".order_discount_" + id).val(discount_format);
        },
        click: function () {
            var order_price = $(".order_price_" + id).val();
            var discount = $(this).val();
            var order_price_format = order_price
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");

            if (discount != "" && order_price != "") {
                var discount_format = discount
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
                var order_profit =
                    parseInt(order_price_format) - parseInt(discount_format);
                var order_profit_format = new Intl.NumberFormat("vi-VN").format(
                    order_profit
                );
                $(".order_profit_" + id).val(order_profit_format);
            } else {
                $(".order_profit_" + id).val(order_price);
            }
            var discount_replace = discount
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
            var discount_format = new Intl.NumberFormat("vi-VN").format(
                discount_replace
            );
            $(".order_discount_" + id).val(discount_format);
        },
    });
}
function ordFormFunction(event) {
    var name = event.target["name"];
    var split = name.split("_");
    var id = split[2];
    $("input[name=" + name + "]").on("keyup change", function () {
        var ordForm = $(this).val();
        var accountant_35X43 = $(".accountant_35X43_" + id).val();
        var order_quantity = $(".order_quantity_" + id).val();

        if (ordForm == "ko in") {
            if (accountant_35X43 == "") {
                var accountant_35X43_format = 0;
            } else {
                var accountant_35X43_format = accountant_35X43;
            }
            var accountant_film_bag = parseInt(accountant_35X43_format) * 4;
            $(".accountant_film_bag_" + id).val(accountant_film_bag);
        } else {
            $(".accountant_film_bag_" + id).val(order_quantity);
        }
    });
}
function accountant35X43Function(event) {
    var name = event.target["name"];
    var split = name.split("_");
    var id = split[2];

    $("input[name=" + name + "]").on("keyup change", function () {
        var accountant_35X43 = $(this).val();
        var ordForm = $(".ord_form_" + id).val();
        var order_quantity = $(".order_quantity_" + id).val();
        if (ordForm == "ko in") {
            if (accountant_35X43 != "") {
                var accountant_film_bag = parseInt(accountant_35X43) * 4;
                $(".accountant_film_bag_" + id).val(accountant_film_bag);
            } else {
                $(".accountant_film_bag_" + id).val(0);
            }
        } else {
            $(".accountant_film_bag_" + id).val(order_quantity);
        }
    });
}
function deadlineFunction(event) {
    var name = event.target["name"];
    var split = name.split("_");
    var id = split[2];

    $("input[name=" + name + "]").on("keyup change click", function () {
        var deadline = parseInt($(this).val());
        var date = $(".accountant_date_" + id).val();
        if (date != "") {
            var date1 = date.split("/");
            var date_format = date1[2] + "-" + date1[1] + "-" + date1[0];
            const day = new Date(date_format);
            const day_format = day.getDate() + deadline;
            day.setDate(day_format);
            var today = day
                .toLocaleDateString("en-GB", {
                    day: "numeric",
                    month: "numeric",
                    year: "numeric",
                })
                .split(" ")
                .join("-");
            $(".accountant_payment_" + id).val(today);
        } else {
            $(".accountant_payment_" + id).val("");
        }
    });
}
function dateFunction(event) {
    var name = event.target["name"];
    var split = name.split("_");
    var id = split[2];

    $("input[name=" + name + "]").on("keyup change", function () {
        var date = $(this).val();
        var deadline = $(".accountant_deadline_" + id).val();
        if (deadline != "" && date.length >= 10) {
            var date1 = date.split("/");
            var date_format = date1[2] + "-" + date1[1] + "-" + date1[0];
            const day = new Date(date_format);
            const day_format = day.getDate() + parseInt(deadline);
            day.setDate(day_format);
            var today = day
                .toLocaleDateString("en-GB", {
                    day: "numeric",
                    month: "numeric",
                    year: "numeric",
                })
                .split(" ")
                .join("-");
            $(".accountant_payment_" + id).val(today);
        } else {
            $(".accountant_payment_" + id).val("");
        }
    });
}
(function ($) {
    var typingTimer;
    var doneTypingInterval = 600;

    $(".order_profit").on({
        keyup: function () {
            formatCurrency($(this));
        },
        blur: function () {
            formatCurrency($(this), "blur");
        },
        input: function () {
            var order_profit = $(this).val();
            if (order_profit == "") {
                var order_profit_format = 0;
                $(".order_profit").val(order_profit_format);
            } else {
                var order_profit_format = order_profit
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, "");
            }
        },
    });

    function getValues(id) {
        $(data_cart).each(function(i, field) {
            dataObj[field.name] = field.value;
        });
        var order_id = $(".").val();

        var newItem = {
            'id': dataObj.ware_house_id,
            'url': slug,
            'image': image,
            'name': dataObj.product_name,
            'price': dataObj.product_price,
            'size': dataObj.product_size,
            'color': dataObj.product_color,
            'quantity': 1
        }
        var data = new Array();

        $("#category_order tr").each(function () {
            page_id_array.push($(this).attr("id"));
        });
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    });

    $(document).on("click", ".updateAccount", function () {
        var order_id = $(this).data("id");
        var _token = $('input[name="_token"]').val();
        var data = (".updateAccountant_" + order_id).serializeArray();
        getValues(order_id)
        // var form = new FormData(data);
        // form.push(
        //     {name: '_token', value: _token},
        // );
        console.log(data);
        urlUpdateAccountant = urlUpdateAccountant.replace(":id", order_id);
        // $(".loader").fadeIn();
        // $("#preloder").fadeIn("slow");
        $.ajax({
            url: urlUpdateAccountant,
            method: "POST",
            contentType: false,
            data: {
                order_id: order_id,
                _token: _token,
            },
            success: function (data) {
                urlUpdateAccountant = urlUpdateAccountant.replace(
                    order_id,
                    ":id"
                );
                $(".order_status_" + order_id).html(
                    '<span style="color: #00d0e3;">Đã cập nhật doanh thu</span>'
                );
                $(".loader").fadeOut();
                $("#preloder").fadeOut("slow");
                successMsg(data.success);
            },
        });
    });

    $(document).on("click", ".completeAccount", function () {
        var order_id = $(this).data("id");
        var _token = $('input[name="_token"]').val();
        var data = $(".updateAccountant_" + order_id).serializeArray();
        data.push({ name: "_token", value: _token });
        urlCompleteAccountant = urlCompleteAccountant.replace(":id", order_id);
        $(".loader").fadeIn();
        $("#preloder").fadeIn("slow");
        $.ajax({
            url: urlCompleteAccountant,
            method: "POST",
            data: data,
            success: function (data) {
                urlUpdateAccountant = urlUpdateAccountant.replace(
                    order_id,
                    ":id"
                );
                $(".order_status_" + order_id).html(
                    '<span style="color: #0071e3;">Đã xử lý</span>'
                );
                $(".update-account-" + order_id).html("");
                $(".loader").fadeOut();
                $("#preloder").fadeOut("slow");
                successMsg(data.success);
            },
        });
    });

    $(document).on(
        "keyup",
        ".search_target1, .search_target5, .search_target6, .search_target7",
        function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
        }
    );

    $(document).on(
        "keydown",
        ".search_target1, .search_target5, .search_target6, .search_target7",
        function () {
            clearTimeout(typingTimer);
        }
    );

    function doneTyping() {
        var _token = $('input[name="_token"]').val();
        var month = $(".search_target1").val();
        var unitCode = $(".search_target5").val();
        var unitName = $(".search_target6").val();
        var ctyName = $(".search_target7").val();
        $(".loader").fadeIn();
        $("#preloder").fadeIn("slow");
        $.ajax({
            url: urlFilterAccountant,
            method: "POST",
            data: {
                _token: _token,
                month: month,
                unitCode: unitCode,
                unitName: unitName,
                ctyName: ctyName,
            },
            success: function (data) {
                var total_price = new Intl.NumberFormat("vi-VN").format(
                    data.total_price
                );
                var total_owe = new Intl.NumberFormat("vi-VN").format(
                    data.total_owe
                );
                var total_amount_paid = new Intl.NumberFormat("vi-VN").format(
                    data.total_amount_paid
                );
                var total_quantity = new Intl.NumberFormat("vi-VN").format(
                    data.total_quantity
                );
                var total_discount = new Intl.NumberFormat("vi-VN").format(
                    data.total_discount
                );
                $("#total-price").text(total_price);
                $("#total-owe").text(total_owe);
                $("#total-amount-paid").text(total_amount_paid);
                $("#total-quantity").text(total_quantity);
                $("#total-discount").text(total_discount);
                $(".loader").fadeOut();
                $("#preloder").fadeOut("slow");
            },
        });
    }
})(jQuery);
