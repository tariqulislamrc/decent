@extends('layouts.app', ['title' => _lang('Work Order Product Materials'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Product for Production."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Work Order Product Materials Show')}}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('wop-materials-show') }}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header">
        <h6>{{_lang('Production Work Order Details')}}</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="pr-3">
                    <p class="h5"> {{_lang('Code')}} : {{$models->prefix}}-{{$models->code}}</p>
                    <p class="">{{_lang('Work Order Type')}} : {{$models->type}}</p>
                    <p> {{_lang('Date')}} : {{$models->date}}</p>
                    <p> {{_lang('Delivery Date')}} : {{$models->delivery_date}} </p>
                    <p>{{_lang('Status')}} : <span class="font-weight-bold badge badge-success">
                            {{$models->status}} </span> </p>
                </div>
            </div>

             <div class="col-md-6">
                <div class="pr-3">
                    <p class="h5"> {{_lang('Brand Name')}} : {{$models->brand->name}}</p>
                    <p class="">{{_lang('Owner Name')}} : {{$models->brand->owner_name}}</p>
                    <p> {{_lang('Email')}} : {{$models->brand->email}}</p>
                    <p> {{_lang('Phone')}} : {{$models->brand->phone}} </p>
                    <p>{{_lang('Address')}} : {!!$models->brand->address!!} </p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="card-header">
    <h6>{{_lang('Product Materials Details')}}</h6>
</div>

<div class="card py-4">

    <div class="col-md-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>{{ _lang('SL') }}</th>
                    <th>{{ _lang('Product') }}</th>
                    <th>{{ _lang('Raw Material') }}</th>
                    <th>{{ _lang('Quantity') }}</th>
                    <th>{{ _lang('Total Price') }}</th>
                    <th>{{ _lang('Waste') }}</th>
                    <th>{{ _lang('Uses') }}</th>
                </tr>
            </thead>
            <tbody>
                            @foreach ($models->wop_material as $item)
                            <tr>
                                <td>{{ $loop->index+1 }} </td>
                                <td>{{ $item->work_order_product->product->name }} </td>
                                <td>{{ $item->raw_material->name }} </td>
                                <td> {{ $item->qty }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->waste }}</td>
                                <td>{{ $item->uses }}</td>
                            </tr>
                            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
