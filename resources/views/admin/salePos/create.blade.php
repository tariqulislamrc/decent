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
			<div class="row">
				<div class="col-md-6"></div>
				<div class="col-md-6">
					<div class="card">
						<div class="crad-body">
							<div class="row">
								<div class="col-md-6 form-group">
									<label for="brand_id">{{_lang('Brand')}}</label>
									<select name="brand_id" id="brand_id" class="form-control select" required>

										<option value="">Select Brand</option>
										@foreach ($brands as $brand)
										<option value="{{ $brand->id }}">{{ $brand->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6 form-group">
									<label for="category_id">{{_lang('Category')}}</label>
									<select name="category_id" id="category_id" class="form-control select" required>
										<option value="all">All Category</option>
										@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
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
        var location_id = $('input#location_id').val();
            get_product_suggestion_list(
                $('select#category_id').val(),
                $('select#brand_id').val(),
                null
            );

    });


 function get_product_suggestion_list(category_id, brand_id, url = null) {

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
    console.log(url);
    var quantity = parseInt($(this).data('qty'));
    $.ajax({
        type: 'GET',
        url: url,
        data: {
            variation_id: variation_id
        },
        dateType: 'json',
        success: function(data) {
            console.log(data);
           
        }
    });
});
//add row function
// function item1(item, product, quantity, type) {
//     var tr = $("#item").parent().parent();
//     var a = tr.find('.code');
//     if (a.length == 0) {
//         var row = parseInt($("#row").val());
//         $.ajax({
//             type: 'GET',
//             url: "/admin/sells/parts/scannerappend1",
//             data: {
//                 product: product,
//                 row: row,
//                 quantity: quantity,
//                 type: type
//             },
//             dateType: 'html',
//             success: function(data) {
//                 append_audio();
//                 $("#item").append(data);
//                 $('#row').val(row + 1);
//                 $(".serial").select2();
//                 calculate(0,0);
//             }
//         });
//     } else {
//         var found = true;
//         $(".code").each(function() {
//             if ($(this).val() == item.code_number) {
//                 if ($(this).data('type') == 'Single') {
//                     var id = $(this).data('id');
//                     var qty = parseFloat($('#qty_' + id).val());
//                     parseFloat($('#qty_' + id).val(qty + quantity));
//                     var nwqty = parseFloat($('#qty_' + id).val());
//                     var amt = nwqty * parseFloat(item.sell_price);
//                     $("#amt_" + id).html(amt);
//                     append_audio();
//                     calculate(0,0);
//                     found = false;
//                     return false;
//                 }
//                 found = false;
//                 return false;
//             }
//         })
//         if (found) {
//             var row = parseInt($("#row").val());
//             $.ajax({
//                 type: 'GET',
//                 url: "/admin/sells/parts/scannerappend1",
//                 data: {
//                     product: product,
//                     row: row,
//                     quantity: quantity,
//                     type: type
//                 },
//                 dateType: 'html',
//                 success: function(data) {
//                     append_audio();
//                     $("#item").append(data);
//                     $('#row').val(row + 1);
//                     $(".serial").select2();
//                     calculate(0, 0);
//                 }
//             });
//         }
//     }
// }
</script>
@endpush