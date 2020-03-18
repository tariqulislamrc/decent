@extends('layouts.invoice')
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row px-5">
        <div class="col-md-4 text-justify">
            <p class="h3 font-weight-bold text-uppercase text-color"> Bill To</p>
            <p class="text-justify"><span class="font-weight-bold d-inline-block text-color h5 "> Name : {{ $model->client->name }} </span>
        </p>
        <p> <span class="font-weight-bold text-color h5 text-justify"> Address : {{ $model->client->city }} </span>
    </p>
    <p class="text-justify"> <span class="font-weight-bold text-color h5"> E-mail  : {{ $model->client->email }} </span>
</p>
<p><span class="font-weight-bold text-color h5"> Contact : {{ $model->client->mobile }} </span>  </p>
</div>
<div class="col-md-4 ml-auto">
<p class="">
    <span class="font-weight-bold text-uppercase h5"> bill No : {{ $model->reference_no }} </span>
    
</p>
</div>
</div>
<p class="h2 text-uppercase mt-5 text-center"> bill for : {{ _lang('Sales Return for') }} {{ $model->reference_no }} </p>
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
        <td>{{ $element->quantity_returned }}</td>
        <td>{{ $element->returnsale->sum('return_amount') }}</td>
    </tr>
    @endforeach
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Sale Amount') }}</td>
        <td> {{ $model->net_total }} </td>
    </tr>
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Paid Amount') }}</td>
        <td> {{ $model->payment->sum('amount') }} </td>
    </tr>
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Return Discount') }}</td>
        <td> {{ $model->return_parent->sum('discount_amount') }} </td>
    </tr>
    <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ _lang('Return Amount') }}</td>
        <td> {{ $model->return_parent->sum('net_total') }} </td>
    </tr>
    @php
        $return =$model->return_parent->sum('net_total'); 
        $due = $model->net_total-($model->payment->sum('amount')+$return);
    @endphp
     <tr>
        <td class="text-right h5 font-weight-bold" colspan="3"> {{ $due>0?_lang('Due'):_lang('Return') }}</td>
        <td> {{ abs($due) }} </td>
    </tr>
</tbody>
</table>
</div>
<p class="h2 text-capitalize mt-4 text-center"> In Words : ........................................................................................................</p>
<br><br>
<div class="row mt-5 mb-3 text-center">
<div class="col-md-3">
<p class="border-top border-dark h4"> Received By </p>
</div>
<div class="col-md-3">
<p class="border-top border-dark h4 text-color"> Prepared By </p>
</div>
<div class="col-md-3">
<p class="border-top border-dark h4 text-color"> Checked By </p>
</div>
<div class="col-md-3">
<p class="border-top border-dark h4 text-color"> Authorized By </p>
</div>
</div>
</div>
@endsection