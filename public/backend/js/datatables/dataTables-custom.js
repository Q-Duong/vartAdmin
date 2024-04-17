"use strict";
(function ($) {
    $.fn.dataTable.ext.order['dom-text'] = function(settings, col) {
        return this.api()
            .column(col, {
                order: 'index'
            })
            .nodes()
            .map(function(td, i) {
                return $('input', td).val();
            });
    };

    /* Create an array with the values of all the input boxes in a column, parsed as numbers */
    $.fn.dataTable.ext.order['dom-text-numeric'] = function(settings, col) {
        return this.api()
            .column(col, {
                order: 'index'
            })
            .nodes()
            .map(function(td, i) {
                var value = $('input', td).val();
                var value1 = value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, "");
                return value1 * 1;
            });
    };

    /* Create an array with the values of all the select options in a column */
    $.fn.dataTable.ext.order['dom-select'] = function(settings, col) {
        return this.api()
            .column(col, {
                order: 'index'
            })
            .nodes()
            .map(function(td, i) {
                return $('select', td).val();
            });
    };

    /* Create an array with the values of all the checkboxes in a column */
    $.fn.dataTable.ext.order['dom-checkbox'] = function(settings, col) {
        return this.api()
            .column(col, {
                order: 'index'
            })
            .nodes()
            .map(function(td, i) {
                return $('input', td).prop('checked') ? '1' : '0';
            });
    };

    /* Initialise the table with the required column ordering data types */
    $(document).ready(function() {
        $(".example thead tr").clone(true).appendTo(".example thead");

        // add a text input filter to each column of the new row
        $(".example thead tr:eq(1) th").each(function(i) {
            var title = $(this).text();
            $(this).html('<input type="text" id="' + i + '" class="form-control search_target'+ i + '" placeholder="'+ title +  '"/>');
            $("input", this).on("keyup change", function() {

                if ($(".example").DataTable().column(i).search() !== $(this).val()) {
                    $(".example").DataTable().column(i).search($(this).val()).draw();
                }
            });
        });
        $('#myTableScroll').DataTable({
            "scrollX": true,
            "orderCellsTop": true,
            // "processing": true,
            "deferRender": true,
            columns: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                // {
                //     orderDataType: 'dom-text-numeric',
                //     type: "numeric"
                // },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text-numeric',
                    type: "numeric"
                },
                {
                    orderDataType: 'dom-text',
                    type: 'string'
                },
                null,
                null,
                null,
                null,
            ],
        });
    });
})(jQuery);
