/* ------------------------------------------------------------------------------
 *
 *  # Select extension for Datatables
 *
 *  Demo JS code for datatable_extension_select.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var DatatableSelect = function () {


    //
    // Setup module components
    //

    // Basic Datatable examples
    var _componentDatatableSelect = function () {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [2]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                }
            }
        });

        $('.content_managment_table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copy',
                className: 'btn btn-primary glyphicon glyphicon-duplicate'
            }, {
                extend: 'csv',
                className: 'btn btn-primary glyphicon glyphicon-save-file'
            }, {
                extend: 'excel',
                className: 'btn btn-primary glyphicon glyphicon-list-alt'
            }, {
                extend: 'pdf',
                className: 'btn btn-primary glyphicon glyphicon-file'
            }, {
                extend: 'print',
                className: 'btn btn-primary glyphicon glyphicon-print'
            }],
            columnDefs: [{
                orderable: false,
                targets: [5]
            }],

            order: [0, 'asc'],
            processing: true,
            serverSide: true,

            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'code',
                    name: 'code'
                }, {
                    data: 'type',
                    name: 'type'
                },{
                    data: 'date',
                    name: 'date'
                }, {
                    data: 'delivery_date',
                    name: 'delivery_date'
                }, {
                    data: 'action',
                    name: 'action'
                }
            ]
        });


    };

    var _componentRemoteModalLoad = function () {
        $(document).on('click', '#content_managment', function (e) {
            e.preventDefault();
            //open modal
            $('#modal_remote').modal('toggle');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                url: url,
                type: 'Get',
                dataType: 'html'
            })
                .done(function (data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    $('#branch_no').focus();
                    _modalFormValidation();
                })
                .fail(function (data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });
    };



    //
    // Return objects assigned to module
    //

    return {
        init: function () {
            _componentDatatableSelect();
            _componentRemoteModalLoad();
            _componentSelect2Normal();
            _componentDatefPicker();
            _formValidation();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function () {
    DatatableSelect.init();
});

$(function () {

        $("#item").on('click', '.remove', function () {
            $(this).closest('tr').remove();
            $("#discount_amount").val("");
            $("#discount").val("");
            $("#paid").val("");
        });


        $("#item").on('keyup change', '.qty, .price', function () {
            var tr = $(this).parent().parent();
            var qty = tr.find('.qty').val();
            var price = tr.find('.price').val();
            var total = qty * price;
            tr.find('.sub_total').val(total);
            tr.find('.net_total').val(total);
            tr.find('.sub_total_text').text(total);
            tr.find('.net_total_text').text(total);
        });


    $('.select_custom').select2({
        width: '88%'
    });

    // Modal :::::::::::::::::::
    $(document).on('click', '.btn-modal', function (e) {
        e.preventDefault();
        var container = $(this).data('container');
        $.ajax({
            url: $(this).data('url'),
            dataType: 'html',
            success: function (result) {
                $(container)
                    .html(result)
                    .modal('show');
                _remortFormValidation();
            },
        });
    });

    if ($('#search_product').length > 0) {
        $('#search_product')
            .autocomplete({
                source: '/admin/product/get_product',
                minLength: 2,
                response: function(event, ui) {
                    if (ui.content.length == 1) {
                        ui.item = ui.content[0];
                        $(this)
                            .data('ui-autocomplete')
                            ._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    } else if (ui.content.length == 0) {
                        var term = $(this).data('ui-autocomplete').term;
                        toastr.error('No Product Found', 'Opps!');
                        /*swal({
                            title: 'No Product found',
                            text: term + 'Add as a new Product',
                            buttons: ['Cancel', 'Ok'],
                        }).then(value => {
                            if (value) {
                                var container = $('.quick_add_product_modal');
                                $.ajax({
                                    url: '/products/quick_add?product_name=' + term,
                                    dataType: 'html',
                                    success: function(result) {
                                        $(container)
                                            .html(result)
                                            .modal('show');
                                    },
                                });
                            }
                        });*/
                    }
                },
                select: function(event, ui) {
                    $(this).val(null);
                    get_purchase_entry_row(ui.item.product_id, ui.item.variation_id);
                },
            })
            .autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.text + '</div>')
                .appendTo(ul);
        };
    }

    function get_purchase_entry_row(product_id, variation_id) {


        if (product_id) {
            var row_count = $('#row').val();
            $.ajax({
                method: 'POST',
                url: '/admin/production-work-order/append',
                dataType: 'json',
                data: { product_id: product_id, row_count: row_count, variation_id: variation_id },
                success: function(result) {
                    $('#item').append(result.html);
                    var item = $('#item').find('.product_id');
                    $.each(item, function (i, v) {
                        console.log($(this).data('variation'));
                    })
                    if ($(result.html).find('.qty').length) {
                        $('#row').val(
                            $(result.html).find('.qty').length + parseInt(row_count)
                        );
                    }
                },
            });
        }
    }

});
