@extends('layouts.app', ['title' => _lang('Production Product Show'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Product for Production."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Production Product Show')}}</h1>
        <p>{{_lang('Show Product for Production.')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('work-order-view') }}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header">
        <h6>{{_lang('Production Product Details')}}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="pr-3">
                    <p class="h5"> {{_lang('Code')}} : {{$model->prefix}}-{{$model->code}}</p>
                    <p> {{_lang('Brand Name')}} : {{$model->brand->name?$model->brand->name:'Brand Name Empty'}}</p>
                    <p> {{_lang('Order Type')}} : {{$model->type}} </p>
                    <p> {{_lang('Order Date')}} : {{$model->date}} </p>
                    <p> {{_lang('Delivery Date')}} : {{$model->delivery_date}} </p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="card-header">
    <h6>{{_lang('Raw Material Details')}}</h6>
</div>

<div class="card py-4">
    <div class="col-md-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>{{ _lang('#') }}</th>
                    <th>{{ _lang('Prodjuct Name') }}</th>
                    <th>{{ _lang('Quantity') }}</th>
                    <th>{{ _lang('Price') }}</th>
                    <th>{{ _lang('Sub Price') }}</th>
                    <th>{{ _lang('Net Total') }}</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($model->workOrderProduct as $key => $item)
                   <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$item->product->name}}</td>
                       <td>{{$item->qty}}</td>
                       <td>{{$item->price}}</td>
                       <td>{{$item->sub_total}}</td>
                       <td>{{$item->net_total}}</td>
                   </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
@endpush
