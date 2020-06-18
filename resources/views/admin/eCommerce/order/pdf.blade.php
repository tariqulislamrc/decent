@php
    $find_shiping_address = App\models\Production\Transaction::where('shipping_status', '!=', null)->first();
    if($find_shiping_address) {
        $x = 1;
    } else {
        $x = 0;
    }
@endphp
@extends('layouts.invoice')
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row px-5">
        <div class="col-md-4 text-justify">
        <p class="h3 font-weight-bold text-uppercase text-color"> Invoice To</p>
        @if ($x != 1)
            <p class="text-justify"><span class="font-weight-bold d-inline-block text-color h5 "> Name : {{ get_client_name($model->id) }} </span></p>
            <p> <span class="font-weight-bold text-color h5 text-justify"> Address : {{ get_client_address($model->client_id) }} </span></p>
            <p class="text-justify"> <span class="font-weight-bold text-color h5"> E-mail  : {{ $model->client->email }} </span></p>
            <p><span class="font-weight-bold text-color h5"> Contact : {{ $model->client->mobile }} </span>  </p>
        @else 
            <p class="text-justify"><span class="font-weight-bold d-inline-block text-color h5 "> Name : {{ $find_shiping_address->full_name }} </span></p>
            <p> <span class="font-weight-bold text-color h5 text-justify"> Address : {{ $find_shiping_address->address }} {{ $find_shiping_address->city}} </span></p>
            <p class="text-justify"> <span class="font-weight-bold text-color h5"> E-mail  : {{ $find_shiping_address->email }} </span></p>
            <p><span class="font-weight-bold text-color h5"> Contact : {{ $find_shiping_address->phone }} </span>  </p>
        @endif
    </div>
<div class="col-md-4 ml-auto">
<p class="">
    <span class="font-weight-bold text-uppercase h5"> Invoice No : #{{ $model->invoice_no }} </span>
    
</p>
</div>
</div>
<p class="h2 text-uppercase mt-5 text-center"> Product Details for : {{ $model->reference_no }} </p>
<div class="row mt-5 px-4">
<table class="table table-bordered border-dark">
<thead>
    <tr class="table-danger">
        <th scope="col">{{ _lang('Sl') }}</th>
        <th scope="col">{{ _lang('Name') }}</th>
        <th scope="col-2">{{ _lang('Qty') }}</th>
        <th scope="col">{{ _lang('Total') }}</th>
    </tr>
</thead>
<tbody>
    @foreach ($model->sell_lines as $element)
    <tr>
        <td>{{ $loop->index+1 }}</td>
        <td>{{ $element->variation->name }}-{{ $element->product->name }}</td>
        <td>{{ $element->quantity }}</td>
        <td>{{ $element->unit_price }}</td>
    </tr>
    @endforeach
    @if ($model->return==1)
    <tr>
        <td colspan="4"> <small>Sale Has Return</small></td>
    </tr>
       
    @endif
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Sub Total') }}</td>
        <td> {{ get_option('currency') ? get_option('currency') : 'BDT'}} {{ $model->sub_total }} </td>
    </tr>
    @if ($model->discount)
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Discount Amount') }}</td>
        <td> {{ get_option('currency') ? get_option('currency') : 'BDT'}} {{ $model->discount_amount }} </td>
    </tr>
    @endif

    @if ($model->tax)
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Discount Amount') }}</td>
        <td> {{ get_option('currency') ? get_option('currency') : 'BDT'}} {{ $model->tax }} </td>
    </tr>
    @endif

    @if ($model->shipping_charges)
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Shipping Charge') }}</td>
        <td> {{ get_option('currency') ? get_option('currency') : 'BDT'}} {{ $model->shipping_charges }} </td>
    </tr>
    @endif

    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Net Total') }}</td>
        <td> {{ get_option('currency') ? get_option('currency') : 'BDT'}} {{ $model->net_total }} </td>
    </tr>
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Paid') }}</td>
        <td>  {{ get_option('currency') ? get_option('currency') : 'BDT'}} {{ $model->paid == '' ? 0 : $model->paid }} </td>
    </tr>
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Payment Method') }}</td>
        <td> {{ $model->payment_status == 'cash_on_delivery' ? 'Cash On Delivery' : $model->payment_status }} </td>
    </tr>
 
</tbody>
</table>
</div>
{{-- <p class="h2 text-capitalize mt-4 text-center"> In Words : ........................................................................................................</p> --}}
<br><br>
<div class="row mt-5 mb-3 text-center">
<div class="col-md-12">
    <p>Thanks & Welcome Again For Shopping ---- 
    </p>
<p class="border-top border-dark h4 text-color" style="float:right"> Author Signature  </p>
</div>
</div>
</div>
@endsection