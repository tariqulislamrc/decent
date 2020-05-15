@extends('layouts.app', ['title' => _lang('Sale Return'), 'modal' => 'lg'])
{{-- Header Section --}}
@push('admin.css')
@endpush
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title=""><i class="fa fa-universal-access mr-4"></i>
        {{_lang('Sale Return')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="tile">
    <div class="tile-body">
        <div class="card">
            <div class="card-body">
                <h3>{{ _lang('Parent Sale') }}</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ _lang('Reference No') }} : {{ $model->reference_no }}</th>
                            <th>{{ _lang('Customer') }} : {{ $model->client->name }}</th>
                        </tr>
                        <tr>
                            <th>{{ _lang('Date') }} : {{ $model->date }}</th>
                            <th>{{ _lang('Total Sale') }} : {{ $model->net_total }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <form action="{{route('admin.sale.return.store')}}" method="post" enctype="multipart/form-data" id="content_form">
            <input type="hidden" name="transaction_id" value="{{ $model->id }}">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="bg-green text-light">
                            <tr>
                                <td>{{ _lang('Name') }}</td>
                                <td>{{ _lang('Qty') }}</td>
                                <td>{{ _lang('Price') }}</td>
                                <td>{{ _lang('Prevoius Return') }}</td>
                                <td>{{ _lang('Return') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($model->sell_lines as $key=> $element)
                            <tr class="bg-gray">
                                <td>
                                    <input type="hidden" name="return[{{ $key }}][sale_id]" value="{{ $element->id }}">
                                    {{$element->variation->name }}-{{$element->product->name }}
                                     <input type="hidden" name="return[{{ $key }}][product_id]" value="{{ $element->product_id }}">
                                    <input type="hidden" name="return[{{ $key }}][variation_id]" value="{{ $element->variation_id }}">
                                </td>
                                <td>
                                    {{ $element->quantity }}
                                </td>
                                <td>
                                    <input type="hidden" name="return[{{ $key }}][unit_price]" value="{{ $element->unit_price }}">
                                    {{ $element->unit_price }}
                                </td>
                                <td>
                                    {{ $element->quantity_returned }}
                                </td>
                                <td>
                                    <input type="text" name="return[{{ $key }}][return_units]" class="form-control" placeholder="Return Qty">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($model->discount>0)
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">{{ _lang('Previous Discount') }} </label>
                            <input type="text" class="form-control" value="{{ $model->discount_amount }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">{{ _lang('Return Discount') }} </label>
                            <input type="text" class="form-control" value="{{ $model->return_parent?$model->return_parent->sum('discount_amount'):'' }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">{{ _lang('New Discount To Return') }} </label>
                            <input type="text" name="discount" class="form-control" value="{{ $model->return_parent?$model->return_parent->sum('discount_amount'):$model->discount_amount }}">
                        </div>
                    </div>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-6 mx-auto text-center">
                            <button type="submit" id="submit" class="btn btn-primary btn-lg w-100">{{ _lang('Return') }}</button>
                            <button type="button" class="btn btn-primary btn-lg w-100" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }} <i class="fa fa-spinner fa-spin" style="font-size: 20px" aria-hidden="true"></i></button>
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
_formValidation();
</script>
@endpush