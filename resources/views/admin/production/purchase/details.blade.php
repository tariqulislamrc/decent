@extends('layouts.app', ['title' => _lang('Purchase Details'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Product for Production."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Purchase Details')}}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('purchase-details') }}
    </ul>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header row">
        <div class="col-md-4">
            <h6>{{_lang('Purchase Details')}}(Reference No: #{{$model->reference_no}})</h6>
        </div>
        <div class="col-md-8" align="right">
            @can('production_purchase.update')
        <a class="btn btn-warning btn-sm has-tooltip" data-original-title="null"
            href="{{route('admin.production-purchase.edit',$model->id)}}"><i class="fa fa-edit"></i> {{_lang('Edit')}}</a>
        @endcan
        @can('production_purchase.delete')
        <button id="delete_item" data-id="{{$model->id}}"
            data-url="{{route('admin.production-purchase.destroy',$model->id)  }}"
            class="btn btn-danger btn-sm has-tooltip" data-original-title="null" data-placement="bottom"><i
                class="fa fa-trash"></i> {{_lang('Delete')}}</button>
        @endcan

        @if ($model->due > 0)
        @can('production_purchase.payment')
        <button class="btn btn-info btn-sm has-tooltip"
            id="content_managment" data-url="{{route('admin.production-purchase.payment',$model->id)}}"><i
                class="fa fa-credit-card"></i> {{_lang('Add Payment')}}</button>
        @endcan
        @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <address>
                    <strong>{{_lang('Employee')}} :
                        {{$model->employee ? $model->employee->name : ''}}({{$model->employee ? $model->employee->prefix : ''}}-{{$model->employee ? $model->employee->code : ''}})</strong>
                    <br>
                    {{_lang('Address')}} : {{$model->employee ? $model->employee->present_address_line_1 : ''}}<br>
                    {{_lang('Mobile')}} : {{$model->employee ? $model->employee->contact_number : ''}}<br>
                </address>
            </div>

            {{-- Reference No: --}}
            <div class="col-md-4">
                <address>
                    <strong>{{_lang('Brand')}} : {{$model->brand ? $model->brand->name : ''}}</strong><br>
                    {{_lang('Owner Name')}} : {{$model->brand ? $model->brand->owner_name : ''}}<br>
                    {{_lang('Mobile')}} : {{$model->brand? $model->brand->phone : ''}}<br>
                    {{_lang('Address')}} : {{$model->brand? $model->brand->address : ''}}
                </address>
            </div>

            {{-- Invoice No: --}}
            <div class="col-md-4">
                <b>{{_lang('Reference No')}}:</b> #{{$model->reference_no}}<br>
                <b>{{_lang('Date')}}:</b> {{$model->date}}<br>
                <b>{{_lang('Purchase Status')}}:</b> {{$model->type}}<br>
                <b>{{_lang('Payment Status')}}:</b> {{$model->payment_status}}<br>
            </div>
        </div>


        <div class="col-md-12 pt-3">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>{{ _lang('#') }}</th>
                        <th>{{ _lang('Invoice No') }}</th>
                        <th>{{ _lang('Purchase Date') }}</th>
                        <th>{{ _lang('Sub Total') }}</th>
                        <th>{{ _lang('Discount') }}</th>
                        <th>{{ _lang('Net Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ 1 }} </td>
                        <td>{{ $model->invoice_no }} </td>
                        <td> {{ $model->date }}</td>
                        <td> {{ $model->sub_total }} </td>
                        <td>{{ $model->discount_amount }}</td>
                        <td>{{ $model->net_total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
<div class="row py-5">
<h5 class="col-md-12">{{_lang('Payment info:')}}</h5>
        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr class="bg-success text-light">
                            <th>#</th>
                            <th>{{_lang('Date')}}</th>
                            <th>{{_lang('Amount')}}</th>
                            <th>{{_lang('Payment mode')}}</th>
                            <th>{{_lang('Payment note')}}</th>
                        </tr>
                        @foreach ($model->payment as $item)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$item->payment_date}}</td>
                            <td><span class="display_currency" data-currency_symbol="true">{{$item->amount}}</span></td>
                            <td>{{$item->method}}</td>
                            <td>{{$item->note}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Net Total Amount: </th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true">{{$model->sub_total}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>
                                <b>(-)</b>
                            </td>
                            <td>
                                <span class="display_currency pull-right" data-currency_symbol="true">{{$model->discount_amount}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Purchase Total:</th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true">{{$model->net_total}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Pay:</th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true">{{$model->paid}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Total Due:</th>
                            <td></td>
                            <td><span class="display_currency pull-right" data-currency_symbol="true">{{$model->due}}</span>
                            </td>
                        </tr>
                    </tbody>
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
    $('.select').select2();

</script>
<script src="{{ asset('js/production/add_purchase.js') }}"></script>
<script src="{{ asset('js/production/purchase.js') }}"></script>
@endpush
