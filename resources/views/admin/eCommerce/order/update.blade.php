@php
    
    $find_shiping_address = App\models\eCommerce\ClientShippingAddress::where('transaction_id', $model->id)->first();
    if($find_shiping_address) {
        $x = 1;
    } else {
        $x = 0;
    }

    function get_product_code($id) {
        $query = App\models\Production\Product::where('id', $id)->first();
        if($query) {

            if($query->prefix != '' ) {
                $prefix = $query->prefix;
            } else {
                $prefix = '';
            }

            if($query->code != '' ) {
                $code = $query->code;
            } else {
                $code = '';
            }

            $name = $prefix . '-' . $code;

        } else {
            $name = 'No Product Found';
        }

        return $name;

    }

    function get_product_name($id) {
        $query = App\models\Production\Product::where('id', $id)->first();
        if($query) {

            $name = $query->name;

        } else {
            $name = 'No Product Found';
        }

        return $name;
    }

    function get_product_image($id) {
        $query = App\models\Production\Product::where('id', $id)->first();
        if($query) {

            $name = '<img width="100px;" alt="Product Image" src="/storage/product/'.$query->photo.'">';

        } else {
            $name = 'No Product Found';
        }

        return $name;
    }

    function get_product_color($id) {
        $query = App\models\Production\Variation::where('id', $id)->first();
        if($query) {
            $variation_value_id = $query->variation_value_id_2;
            $find = App\models\Production\VariationTemplateDetails::where('id', $variation_value_id)->first();

            if($find) {
                $name = $find->name;
            } else {
                $name = 'Color Not Found';
            }
        } else {
            $name = 'No Color Found';
        }

        return $name;
    }

    function get_product_size($id) {
        $query = App\models\Production\Variation::where('id', $id)->first();
        if($query) {
            $variation_value_id = $query->variation_value_id;
            $find = App\models\Production\VariationTemplateDetails::where('id', $variation_value_id)->first();

            if($find) {
                $name = $find->name;
            } else {
                $name = 'Color Not Found';
            }
        } else {
            $name = 'No Color Found';
        }

        return $name;
    }
@endphp
@extends('layouts.app', ['title' => _lang('Ecommerce Order List'), 'modal' => 'xl'])
@push('admin.css')
@endpush
{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="E-Commerce Order List."><i class="fa fa-shopping-cart mr-4"></i> {{_lang('Update eCommerce Order')}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('ecommerce-ordeer-list') }}
        </ul>
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body" id="data">
                    <div class="row">
                        {{-- Order Detailse --}}
                        <div class="col-md-6 table-responsive">
                            <h6 class="text-center">{{_lang('Order Details')}}</h6>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th width="20%">{{_lang('eCommerce Orderer Name')}}</th>
                                    <td width="80%"><input type="text" name="client_name" class="text-center form-control" value="{{get_client_name($model->client_id)}}"></td>
                                </tr>
                                <tr>
                                    <th width="50%">{{_lang('Phone')}}</th>
                                    <td><input type="text" name="client_phone" class="text-center form-control" value="{{get_client_phone($model->client_id)}}"></td>
                                </tr>
                                <tr>
                                    <th width="50%">{{_lang('Address')}}</th>
                                    <td>
                                        <div class="address_show">
                                            <textarea name="client_address" class="form-control" cols="30" rows="2">{{get_client_address($model->client_id)}}</textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">{{_lang('City')}}</th>
                                    <td>
                                        <div><input required type="text" name="client_city" class="form-control" value="{{get_client_city($model->client_id)}}"> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="50%">{{_lang('Note')}}</th>
                                    <td>
                                        <div><textarea name="note" id="note" class="form-control" cols="30" rows="2">{{$model->sell_note}}</textarea></div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Product List --}}
                        <div class="col-md-6">
                                <label for="name">{{_lang('Select Product')}} <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="search_product" class="form-control" placeholder="Type Product Name">
                               {{-- <select required data-placeholder="Select One" name="product_id" id="product_id"
                                        class="form-control select">
                                    <option value="" selected>Select One</option>
                                </select>--}}
                        </div>
                    </div>
                    
                    <div class="col-md-12 my-2 table-responsive">
                        <h4 class="text-center">Order Invoice</h4>
                        <table class="table table-bordered table-striped table-hover update_invoice_table">
                            <thead>
                                <tr>
                                    <th><i class="fa fa-trash text-danger text-center" aria-hidden="true"></i></th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($sell_products as $item)
                                    @php
                                        $total += $item->total;
                                    @endphp
                                    <tr class="table_row_{{$item->id}}">
                                        <td><i data-id="{{ $item->id }}" style="cursor: pointer;" class="fa fa-trash text-danger delete_row text-center" aria-hidden="true"></i></td>
                                        <td>
                                            {{get_product_name($item->product_id)}} - {{get_product_color($item->variation_id)}} - {{get_product_size($item->variation_id)}}
                                            <input type="hidden" name="variation_id[]" value="{{get_product_color($item->variation_id)}}">
                                        </td>
                                        <td><input autocomplete="off" type="text" style="width: 50px;" name="quantity[]" class="text-center qty" value="{{round($item->quantity)}}"></td>
                                        <td>
                                            {{round($item->unit_price)}} 
                                            <input type="hidden" name="price[]" class="price" value="{{round($item->unit_price)}}">
                                        </td>
                                        <td>
                                            <span class="sub_total_text">{{round($item->total)}}</span>
                                            <input type="hidden" name="sub_total[]"  class="sub_total" value="{{round($item->total)}}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right">Subtotal</td>
                                    <td>
                                        <span id="show_subtotal">{{ number_format($total, 2) }}</span>                                        
                                        <input type="hidden" id="total_subtotal" name="subtotal" value="{{ $total }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Coupon Discount ({{ $coupon_type == 'fixed' ? '+' : '%' }}) </td>
                                    <td>
                                        <input type="text" id="total_discount" name="total_discount" value="{{ number_format($coupon_amount, 2) }}">
                                        {{ $coupon_type == 'fixed' ? '+' : '%' }}
                                        <input type="hidden" id="discount_type" value="{{ $coupon_type }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total</td>
                                    <td>
                                        <span class="total_payable_amount">{{ $total }}</span> 
                                        <input type="hidden" id="total_payable_amount" name="net_total" value="{{ $total }}">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script>
    // delete the row
    $(document).on('click', '.delete_row', function() {
        var row_id = $(this).data('id');

        $(".table_row_" + row_id).fadeOut('slow').remove();
        calc();
    });

    if ($('#search_product').length > 0) {
        $('#search_product')
            .autocomplete({
                source: '/admin/product/get_product',
                minLength: 2,
                response: function (event, ui) {
                    if (ui.content.length == 1) {
                        ui.item = ui.content[0];
                        $(this)
                            .data('ui-autocomplete')
                            ._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    } else if (ui.content.length == 0) {
                        var term = $(this).data('ui-autocomplete').term;
                        toastr.error('No Product Found', 'Opps!');
                    }
                },
                select: function (event, ui) {
                    $(this).val(null);
                    get_purchase_entry_row(ui.item.product_id, ui.item.variation_id);
                },
            })
            .autocomplete('instance')._renderItem = function (ul, item) {
            return $('<li>')
                .append('<div>' + item.text + '</div>')
                .appendTo(ul);
        };
    }

    function get_purchase_entry_row(product_id, variation_id) {
        //Get item addition method
        var is_added = false;
        //Search for variation id in each row of pos table
        $('#item')
            .find('tr')
            .each(function () {
                var row_v_id = $(this)
                    .find('.variation_id')
                    .val();
                if (
                    row_v_id == variation_id
                ) {
                    is_added = true;
                    //Increment product quantity
                    qty_element = $(this).find('.qty');
                    qty_element.val(parseInt(qty_element.val()) + 1);
                    update_sub_total($(this));
                    $('input#search_product')
                        .focus()
                        .select();
                }
            });


        if (!is_added && product_id) {
            var row_count = $('#row').val();
            $.ajax({
                method: 'POST',
                url: '/admin/production-work-order/append',
                dataType: 'json',
                data: {product_id: product_id, row_count: row_count, variation_id: variation_id},
                success: function (result) {
                    $('.update_invoice_table tbody').append(result.html);

                    if ($(result.html).find('.qty').length) {
                        $('#row').val(
                            $(result.html).find('.qty').length + parseInt(row_count)
                        ).trigger('change');
                    }
                    // var net_total = total_function();
                    // $('#refresh_net_total').html(net_total.toFixed(2));
                    // $('#net_total').val(net_total);
                    // $('#show_net_total').html(net_total.toFixed(2));
                    // $('.total_payable_amount').html(net_total.toFixed(2));
                    // $('#total_payable_amount').val(net_total.toFixed(2));

                    // console.log(sub);
                    var discount_amount = $('#total_discount').val();
                    var sub_total = total_function();
                    var discount_type = $('#discount_type').val();
                    $('#show_subtotal').text(sub_total.toFixed(2));
                    if(discount_type == 'fixed') {
                        discount = sub_total - discount_amount;
                    } else {
                        discount = (sub_total * discount_amount) / 100;
                    }


                    if(sub_total == '') {
                        sub_total = 0;
                    } else {
                        sub_total = parseInt(sub_total);
                    }

                    var total_payable = parseFloat(sub_total) - parseFloat(discount); 

                    console.log(total_payable);


                    $('.total_payable_amount').html(total_payable.toFixed(2));
                    $('#total_payable_amount').val(total_payable.toFixed(2));
                },
            });
        }

        // console.log(net_total);
    }

    function total_function()
    {
        var total = 0;
        $('.update_invoice_table tbody tr').each(function(i, element) {
            
            var html = $(this).html();
            if(html!='')
            {
                var net_total = $(this).find('.sub_total');
                if(net_total.length > 0){
                    total += parseInt(net_total.val());
                }
            
            }
        });
        
        return total;
    }

    $(document).on('click', '.remove', function () {
        $(this).closest('tr').remove();
        $("#discount_amount").val("");
        $("#discount").val("");
        $("#paid").val("");
    });

    $(".update_invoice_table tbody tr").on('keyup change', '.qty, .price', function () {
        var tr = $(this).parent().parent();
        update_sub_total(tr);
        // console.log(sub);
        var discount_amount = $('#total_discount').val();
        var sub_total = total_function();
        var discount_type = $('#discount_type').val();
        $('#show_subtotal').text(sub_total.toFixed(2));
        if(discount_type == 'fixed') {
            discount = sub_total - discount_amount;
        } else {
            discount = (sub_total * discount_amount) / 100;
        }


        if(sub_total == '') {
            sub_total = 0;
        } else {
            sub_total = parseInt(sub_total);
        }

        var total_payable = parseFloat(sub_total) - parseFloat(discount); 

        console.log(total_payable);


        $('.total_payable_amount').html(total_payable.toFixed(2));
        $('#total_payable_amount').val(total_payable.toFixed(2));
    });

    function update_sub_total(tr) {
        var qty = tr.find('.qty').val();
        var price = tr.find('.price').val();
        var total = qty * price;
        tr.find('.sub_total').val(total);
        // tr.find('.net_total').val(total);
        tr.find('.sub_total_text').text(total);
        // tr.find('.net_total_text').text(total);
    }
</script>
@endpush

