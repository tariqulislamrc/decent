@extends('layouts.app', ['title' => _lang('Edit Purchase'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Purchase for Production."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Edit Purchase')}}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('purchase-create') }}
    </ul>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<form action="{{route('admin.production-purchase.update', $model->id)}}" method="post" id="content_form">
    @csrf
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Edit Purchase ')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Purchase By --}}
                <div class="col-md-3">
                    <label for="employee_id">{{_lang('Purchase By')}}
                    </label>
                    <div class="input-group">
                        <select required data-placeholder="Select Purchase By" name="purchase_by" class="form-control">
                            <option value="{{$model->purchase_by}}" selected>{{$model->employee->name}}</option>
                        </select>
                    </div>
                </div>

                {{-- Reference No: --}}
                <div class="col-md-3 form-group">
                    <label for="reference_no">{{_lang('Reference No:')}}
                    </label>
                    <input type="text" value="{{$model->reference_no}}" class="form-control" placeholder="Reference No"
                        name="reference_no" id="reference_no">
                </div>

                {{-- Invoice No: --}}
                <div class="col-md-3 form-group">
                    <label for="invoice_no">{{_lang('Invoice No:')}}
                    </label>
                    <input type="text" readonly value="{{$model->invoice_no}}" class="form-control"
                        placeholder="Invoice No" name="invoice_no" id="invoice_no">
                </div>

                {{-- Purchase Date: --}}
                <div class="col-md-3 form-group" id="child_unit_row">
                    <label for="purchase_date">{{_lang('Purchase Date')}}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" value="{{$model->date}}" class="form-control date" name="purchase_date"
                            id="purchase_date">
                    </div>
                </div>

                {{-- Purchase Status: --}}
                <div class="col-md-3 form-group">
                    <label for="purchase_status">{{_lang('Purchase Status:')}}
                    </label>
                    <select class="form-control select" data-placeholder="Select Status" name="status"
                        class="form-control select">
                        <option value="">Select Status</option>
                        <option {{$model->status == 'Received'?'selected':''}} value="Received">{{_lang('Received')}}
                        </option>
                        <option {{$model->status == 'Pending'?'selected':''}} value="Pending">{{_lang('Pending')}}
                        </option>
                        <option {{$model->status == 'Ordered'?'selected':''}} value="Ordered">{{_lang('Ordered')}}
                        </option>
                    </select>
                </div>

                @if ($model->work_order_id)
                {{-- Work Order --}}
                <div class="col-md-3 form-group" id="work_order">
                    <label for="wo_id">{{_lang('Work Order')}}
                    </label>
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Work Order" name="wo_id"
                            data-url='{{route('admin.purchase.product')}}' id="wo_id" class="form-control select">
                        </select>
                    </div>
                </div>
                @endif

                @if ($model->work_order_id == "")
                {{-- Product --}}
                <div class="col-md-3 form-group" id="product_row">
                    <label for="product_id">{{_lang('Product')}}
                    </label>
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Product" name="product_id"
                            data-url='{{route('admin.purchase.material')}}' id="product_id" class="form-control select">
                        </select>
                    </div>
                </div>
                @endif


            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">

            @if ($model->work_order_id == "")
            {{-- Product Raw Material --}}
            <div class="row pb-3">
                <div class="col-md-8 mx-auto">
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Product" name="raw_material"
                            data-url='{{route('admin.purchase.raw_material')}}' id="raw_material"
                            class="form-control select">
                        </select>
                    </div>
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-condensed table-bordered table-th-green text-center table-striped"
                    id="purchase_entry_table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Purchase Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Line Total</th>
                            <th>Waste</th>
                            <th>Uses</th>
                            <th><i class="fa fa-trash" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody id="data">
                        @foreach ($model->purchase as $item)
                        <tr>
                            <td>
                                <input type="hidden" name="raw_material[]" value="{{ $item->raw_material_id }}" class="pid">
                                 {{ $item->product?$item->product->name:'' }}({{  $item->product?$item->product->articel:'' }})
                            </td>
                            <td>
                                <input type="text" class="form-control qty qty" id="qty" name="qty[]"
                                    value="{{ $item->qty }}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" name="unit_id[]"
                                    value="{{ $item->material->unit->id }}">{{ $item->material->unit->unit }}
                                @if ($item->material->unit->child_unit)
                                / {{$item->material->unit->child_unit}}
                                @endif
                            </td>
                            <td>
                                <input type="text" class="form-control unit_price" id="unit_price" name="unit_price[]"
                                    value="{{ $item->price }}">
                            </td>
                            <td>
                                <input type="text" class="form-control price" id="price" readonly name="price[]"
                                    value="{{ $item->line_total }}">
                            </td>
                            <td>
                                <input type="number" class="form-control waste" maxlength="2" id="waste" name="waste[]"
                                    value="{{ $item->waste }}">
                            </td>
                            <td>
                                <input type="text" readonly class="form-control uses" id="uses" name="uses[]"
                                    value="{{ $item->uses }}">
                            </td>
                            <td>
                                <button type="button" name="remove" class="btn btn-danger btn-sm remmove">X</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <div class="pull-right col-md-5">
                <table class="pull-right col-md-12">
                    <tbody>
                        <tr>
                            <th class="col-md-7 text-right">Net Total Amount:</th>
                            <td class="col-md-5 text-left">
                                <span id="total_subtotal" class="display_currency">{{$model->sub_total}}</span>
                                <input type="hidden" id="total_subtotal_input" value="{{$model->sub_total}}" name="total_before_tax">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label for="discount_type">Discount Type:</label>
                                <select class="form-control select2 " id="discount_type" name="discount_type">
                                    <option value="" selected="selected">None</option>
                                    <option {{$model->discount_type == 'fixed'?'selected':''}} value="fixed">Fixed</option>
                                    <option {{$model->discount_type == 'percentage'?'selected':''}} value="percentage">Percentage</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="discount_amount">Discount Amount:</label>
                                <input class="form-control input_number" required="" name="discount_amount" type="text"
                                    value="{{$model->discount}}" id="discount_amount">
                            </div>
                        </td>
                        <td>&nbsp;</td>
                        <td class="text-right pt-5">
                            <b>Discount:</b>(-)
                            <span id="discount_calculated_amount" class="display_currency">৳{{$model->discount_amount}}</span>
                            <input name="total_discount_amount" value="{{$model->discount_amount}}" type="hidden" id="total_discount_amount">
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="text-right">
                            <input id="grand_total_hidden" name="final_total" type="hidden" value="0">
                            <b>Purchase Total: </b><span id="grand_total" class="display_currency"
                                data-currency_symbol="true">৳ {{$model->net_total}}</span>
                        </td>
                    </tr>


                    <tr>
                        <td colspan="4">
                            <div class="form-group">
                                <label for="stuff_notes">Stuff Notes</label>
                                <textarea class="form-control" rows="3" name="stuff_notes" cols="50"
                                    id="stuff_notes">{{$model->stuff_note}}</textarea>
                            </div>
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-group">
                                <label for="sell_notes">Sell Notes</label>
                                <textarea class="form-control" rows="3" name="sell_notes" cols="50"
                                    id="sell_notes">{{$model->sell_note}}</textarea>
                            </div>
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-group">
                                <label for="transaction_notes">Transaction Notes</label>
                                <textarea class="form-control" rows="3" name="transaction_notes" cols="50"
                                    id="transaction_notes">{{$model->transaction_note}}</textarea>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        

        <div class="form-group col-md-12" id="submit_btn" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Update')}}<i
                    class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
        </div>
        </div>
    </div>

</form>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
    $('.select').select2();

</script>
<script src="{{ asset('js/production/add_purchase.js') }}"></script>
<script src="{{ asset('js/production/purchase.js') }}"></script>
@endpush
