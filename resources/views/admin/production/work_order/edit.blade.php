@extends('layouts.app', ['title' => _lang('Production Work Order edit'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Work Order for Production."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Production work order edit')}}</h1>
        <p>{{_lang('edit work order for Production.')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{Breadcrumbs::render('work-order-edit') }}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<form action="{{route('admin.production-work-order.update', $model->id)}}" method="post" id="content_form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Edit Production work order')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="prefix">{{_lang('Code')}} <span class="text-danger">*</span></label>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="prefix" id="prefix" class="form-control" placeholder="Prefix" value="{{$model->prefix}}" required></div>
                        <div class="col-md-8">
                            <input type="text" name="code" id="code" class="form-control" placeholder="Code Here" required value="{{$model->code}}"></div>
                    </div>
                </div>

                {{-- Select  Brand --}}
                <div class="col-md-4 form-group">
                    <label for="brand_id">{{_lang('Select Brand')}}</label>
                    <select data-placeholder="Select One" name="brand_id" id="brand_id" class="form-control select">
                        <option value="">Select One</option>
                        @foreach ($brand as $item)
                            <option {{$model->brand_id==$item->id?'selected':''}} == value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Select  work Order Type --}}
                <div class="col-md-4 form-group">
                    <label for="type">{{_lang('Work Order Type')}} <span class="text-danger">*</span>
                    </label>
                    <select data-placeholder="Select One" name="type" id="type" class="form-control select">
                        <option value="">Select One</option>
                        @if ($model->type == 'sample')
                            <option selected='selected' value="sample">Sample</option>
                            <option value="production">Production</option>
                        @else
                            <option value="sample">Sample</option>
                            <option selected='selected' value="production">Production</option>
                        @endif
                    </select>
                </div>

                {{-- Select Work Order Date --}}
                <div class="col-md-4 form-group">
                    <label for="date">{{_lang('Work Order date')}}</label>
                    <input type="text" readonly name="date" id="date" value="{{$model->date}}" class="form-control date" />
                </div>

                {{-- Select Work Order Delivery Date --}}
                <div class="col-md-4 form-group">
                    <label for="delivery_date">{{_lang('Delivery Date')}}</label>
                    <input type="text" readonly name="delivery_date" value="{{$model->delivery_date}}" id="delivery_date" class="form-control date" />
                </div>

                    <div class="col-md-4 form-group">
                        <label for="name">{{_lang('Select Product')}} <span class="text-danger">*</span>
                        </label>
                        <select data-placeholder="Select One" name="product_id" id="product_id" class="form-control select">
                        <option value="" selected>Select One</option>
                    </select>
                    </div>

            </div>
        </div>
            <input type="hidden" value="0"  id="row" >
        <div class="card-header">
            <h6>{{_lang('Work Order Product For production')}}</h6>
        </div>
         <input type="hidden" value="0"  id="row" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <td>{{_lang('Product Name')}}</td>
                            <td>{{_lang('Quantity')}}</td>
                            <td>{{_lang('price')}}</td>
                            <td>{{_lang('Sub Total')}}</td>
                            <td>{{_lang('Net Total')}}</td>
                            <td>{{_lang('Action')}}</td>
                            </tr>
                        </thead>
                        <tbody id="item">
                            @foreach ($model->workOrderProduct as $key => $produc_titem)
                            <tr>
                                <td>
                                    {{$produc_titem->product->name}} {{ \App\models\Production\Variation::where('id', $produc_titem->variation_id)->first() ? \App\models\Production\Variation::where('id', $produc_titem->variation_id)->first()->name : '' }}
                                    <input type="hidden" name="product_id[]" class="product_id" value="{{$produc_titem->product_id}}">
                                    <input type="hidden" name="variation_id[]" class="variation_id" value="{{$produc_titem->variation_id}}">
                                    <input type="hidden" class="form-controll code" id="code_{{$key}}" data-id="{{$key}}" value="{{$produc_titem->product_id}}">
                                </td>

                                <td>
                                    <input type="text" name="quantity[]" class="form-control qty" id="qty_{{$key}}" value="{{$produc_titem->qty}}">
                                </td>
                                <td>
                                    <input type="text" name="price[]" class="form-control price" value="{{$produc_titem->price}}">
                                </td>
                                <td>
                                    <input type="hidden" name="sub_total[]" class="sub_total" value="{{$produc_titem->qty*$produc_titem->price}}">
                                    <span id="sub_total_{{$key}}" class="sub_total_text">{{$produc_titem->sub_total}}</span>
                                </td>
                                <td>
                                    <input type="hidden" name="net_total[]" class="net_total" value="{{$produc_titem->qty*$produc_titem->price}}">
                                    <span id="net_total_{{$key}}" class="net_total_text">{{$produc_titem->net_total}}</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info remove">X</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="form-group col-md-12" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-info" id="submiting"
                style="display: none;">{{_lang('Processing')}} <i class="fa fa-spinner fa-spin" style="font-size: 20px" aria-hidden="true"></i></button>
        </div>
    </div>
</form>

<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
<script src="{{ asset('js/production/work_order.js') }}"></script>
<script>
$(document).ready(function(){
	$(document).on('change','#product_id',function(){
        var product_id = $(this).val();
        var quantity =1;
        var price = 1;
		$.ajax({
			url:"{{route('admin.production-work-order.item')}}",
			method:'get',
			dataType:'json',
			data:{product_id:product_id},
			success:function(data){
                item(data,product_id,quantity,price);
			}
		});
	});

function item(item, product,quantity,price) {
    var tr = $("#item").parent().parent();
    var a = tr.find('.code');
    if (a.length == 0) {
        var row = parseInt($("#row").val());
        $.ajax({
            type: 'GET',
            url: "/admin/production-work-order/append",
            data: {
                product: product,
                row: row,
                quantity: quantity,
                price: price,
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
            if ($(this).val() == item.id) {
                var id = $(this).data('id');
                var qty = parseFloat($('#qty_' + id).val());
                parseFloat($('#qty_' + id).val(qty + quantity));
                var nwqty = parseFloat($('#qty_' + id).val());
                var amt = nwqty * parseFloat(price);
                $("#sub_total_" + id).html(amt);
                $("#net_total_" + id).html(amt);
                found = false;
                return false;

            }
        })
        if (found) {
            var row = parseInt($("#row").val());
            $.ajax({
                type: 'GET',
                url: "/admin/production-work-order/append",
                data: {
                    product: product,
                    row: row,
                    quantity: quantity,
                    price: price,
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

    $("#item").on('click', '.remove', function() {
        $(this).closest('tr').remove();
        $("#discount_amount").val("");
        $("#discount").val("");
        $("#paid").val("");
    });


    $("#item").on('keyup change', '.qty, .price', function() {
    var tr = $(this).parent().parent();
    var qty =tr.find('.qty').val();
    var price= tr.find('.price').val();
    var total =qty*price;
    tr.find('.sub_total').val(total);
    tr.find('.net_total').val(total);
    tr.find('.sub_total_text').text(total);
    tr.find('.net_total_text').text(total);
    });

});
</script>
@endpush
