@extends('layouts.app', ['title' => _lang('Sale Pos'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
	<div>
		<h1 data-placement="bottom" title="Depertment Store Request."><i class="fa fa-universal-access mr-4"></i>
		{{_lang('Sale Pos')}}</h1>
	</div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="tile">
	<div class="tile-body">
		<form action="{{route('admin.report.depertment.get_rawmaterial_report')}}" method="post" enctype="multipart/form-data" target="_blank">
            <input type="hidden" id="row" value="0">
			<div class="row">
				<div class="col-md-6">
                  <div class="row">
                      <div class="col-md-6"></div>
                      <div class="col-md-6">
                          <div class="input-group mb-3">
                            <div class="input-group-append">
                                 <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                             </div>
                            <input type="text" class="form-control search_product " id="search_product" name="search_product" value="">
                         </div>
                      </div>
                      <div class="col-md-12">
                             <div class="card">
                                <div class="card-body">
                                    <div class="pos_product_div">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>{{ _lang('Product') }}</th>
                                                <th>{{ _lang('Qty') }}</th>
                                                <th>{{ _lang('Price') }}</th>
                                                <th>{{ _lang('Total') }}</th>
                                                <th>{{ _lang('X') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="item"></tbody>
                                    </table>
                                </div>
                                </div>
                            </div>  
                      </div>
                  </div>          
                </div>
				<div class="col-md-6">
					<div class="card">
						<div class="crad-body">
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
									<select name="brand_id" id="brand_id" class="form-control select" required>

										<option value="">Select Brand</option>
										@foreach ($brands as $brand)
										<option value="{{ $brand->id }}">{{ $brand->name }}</option>
										@endforeach
									</select>
                                </div>
								</div>
								<div class="col-md-6">
                                    <div class="form-group">
									<select name="category_id" id="category_id" class="form-control select" required>
										<option value="all">All Category</option>
										@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
                                </div>
								</div>
							</div>
							<input type="hidden" id="suggestion_page" value="1">
							<div class="row">
								<div class="col-md-12">
									<div class="eq-height-row" id="product_list_body"></div>
								</div>
								<div class="col-md-12 text-center" id="suggestion_page_loader" style="display: none;">
									<i class="fa fa-spinner fa-spin fa-2x"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
	$('.select').select2();

	    //Show product list.
    get_product_suggestion_list(
        $('select#category_id').val(),
        $('select#brand_id').val(),
    );

	$('div#product_list_body').on('scroll', function() {
    if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
        var page = parseInt($('#suggestion_page').val());
        page += 1;
        $('#suggestion_page').val(page);
        var category_id = $('select#category_id').val();
        var brand_id = $('select#brand_id').val();

        get_product_suggestion_list(category_id, brand_id);
    }
});

	$('select#category_id, select#brand_id').on('change', function(e) {
        $('input#suggestion_page').val(1);
            get_product_suggestion_list(
                $('select#category_id').val(),
                $('select#brand_id').val(),
                null
            );

    });



 function get_product_suggestion_list(category_id, brand_id, url = null,term=null) {

    if($('div#product_list_body').length == 0) {
        return false;
    }

    if (url == null) {
        url = '/admin/sale/pos/get-product-suggestion';
    }
    $('#suggestion_page_loader').fadeIn(700);
    var page = $('input#suggestion_page').val();
    if (page == 1) {
        $('div#product_list_body').html('');
    }
    if ($('div#product_list_body').find('input#no_products_found').length > 0) {
        $('#suggestion_page_loader').fadeOut(700);
        return false;
    }
    $.ajax({
        method: 'GET',
        url: url,
        data: {
            category_id: category_id,
            brand_id: brand_id,
            page: page,
            term:term
        },
        dataType: 'html',
        success: function(result) {
            $('div#product_list_body').append(result);
            $('#suggestion_page_loader').fadeOut(700);
        },
    });
}

// add row to click
$(document).delegate(".add_product", "click", function(e) {
    var variation_id = $(this).data('variation_id');
    var url = $(this).data('url');
    var quantity = parseInt($(this).data('qty'));
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            variation_id: variation_id
        },
        dateType: 'json',
        success: function(data) {
            item1(data.product, variation_id, quantity);
           
        }
    });
});
//add row function
function item1(item, variation_id, quantity) {
    var tr = $("#item").parent().parent();
    var a = tr.find('.code');
    if (a.length == 0) {
        var row = parseInt($("#row").val());
        $.ajax({
            type: 'GET',
            url: "/admin/sale/pos/scannerappend1",
            data: {
                variation_id: variation_id,
                row: row,
                quantity: quantity,
            },
            dateType: 'html',
            success: function(data) {
                $("#item").append(data);
                $('#row').val(row + 1);
            }
        });
    } else {
        var found = true;
        $(".code").each(function() {
            if ($(this).val() == item.sku) {
                    var id = $(this).data('id');
                    var qty = parseFloat($('#qty_' + id).val());
                    parseFloat($('#qty_' + id).val(qty + quantity));
                    var nwqty = parseFloat($('#qty_' + id).val());
                    var amt = nwqty * parseFloat(item.sell_price);
                    $("#amt_" + id).html(amt);
                    found = false;
                    return false;

            }
        })
        if (found) {
            var row = parseInt($("#row").val());
            $.ajax({
                type: 'GET',
                url: "/admin/sale/pos/scannerappend1",
                data: {
                    variation_id: variation_id,
                    row: row,
                    quantity: quantity,
                },
                dateType: 'html',
                success: function(data) {
                    $("#item").append(data);
                    $('#row').val(row + 1);
                }
            });
        }
    }
}


    //Add Product
    $('#search_product')
        .autocomplete({
            source: function(request, response) {
                 $.getJSON(
                    '/admin/products/list',
                    {
                        brand_id: $('input#brand_id').val(),
                        term: request.term,
                    },
                    response
                );
            },
            minLength: 2,
            response: function(event, ui) {
                if (ui.content.length == 1) {
                    ui.item = ui.content[0];
                    if (ui.item.qty > 0) {
                        $(this)
                            .data('ui-autocomplete')
                            ._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    }
                } else if (ui.content.length == 0) {
                    toastr.error('No Product Found');
                    $('input#search_product').select();
                }
            },
            focus: function(event, ui) {
                if (ui.item.qty <= 0) {
                    return false;
                }
            },
            select: function(event, ui) {
                    console.log(ui);
                if ( ui.item.qty > 0) {
                    $(this).val(null);
                     item1(ui.item, ui.item.variation_id, 1);
                } else {
                  toastr.error('Out Of Stock');
                }
            },
        })
        .autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.name + '</div>')
                .appendTo(ul);
        };
</script>
@endpush