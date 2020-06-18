@extends('layouts.invoice')
@section('content')
<div class="container-fluid px-4 pt-4">
     <div class="row px-5">
        <div class="col-md-4 text-justify">
            <p class="h3 font-weight-bold text-uppercase text-color">{{ _lang('Product') }} : {{ $model->name }}</p>
            <p class="h3 font-weight-bold text-uppercase text-color">{{ _lang('Article') }} : {{ $model->articel }}</p>
        </div>
    </div>

<p class="h2 text-uppercase mt-5 text-center"> {{ _lang('Product Pair Costing') }} </p>
<div class="row mt-5 px-4">
    <table class="table table-bordered border-dark">
        <thead>
            <tr class="table-danger">
                <th width="20%">{{ _lang('Material Des') }}</th>
                <th width="20%">{{ _lang('Consumstion') }}</th>
                <th width="10%">{{ _lang('Unit') }}</th>
                <th width="15%">{{ _lang('Unit Cost') }}</th>
                <th width="15%">{{ _lang('Cost/PR') }}</th>
                <th width="20%">{{ _lang('Note') }}</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($model->material as $element)
            <tr>
                <td>{{ $element->material?$element->material->name:'' }}</td>
                <td>{{ $element->qty }}</td>
                <td>{{ $element->material?$element->material->unit->unit:'' }}</td>
                <td>{{ $element->unit_price }}</td>
                <td>{{ $element->price }}</td>
                <td>{{ $element->description }}</td>
            </tr>
            @endforeach
            <tr>
                <td class="text-right h5 font-weight-bold" colspan="5"> {{ _lang('Total Material Cost') }}</td>
                <td> {{ $model->default_purchase_price }} </td>
            </tr>
            @if ($model->rejection)
            <tr>
                <td class="text-right h5 font-weight-bold" colspan="5"> {{ _lang('Rejection') }} :({{ $model->rejection }} %)</td>
                <td> {{ $model->rejection_amt }} </td>
            </tr>
            @endif
            @if ($model->overhead)
            <tr>
                <td class="text-right h5 font-weight-bold" colspan="5"> {{ _lang('Overhead') }}</td>
                <td> {{ $model->overhead }} </td>
            </tr>
            @endif
            
            @if ($model->profit_percent)
            <tr>
                <td class="text-right h5 font-weight-bold" colspan="5"> {{ _lang('Profit') }} : ({{ $model->profit_percent }} %)</td>
                <td> {{ $model->profit_amt }} </td>
            </tr>
            @endif
        
           @if ($model->commercial)
              <tr>
                <td class="text-right h5 font-weight-bold" colspan="5"> {{ _lang('Commercial') }}</td>
                <td> {{ $model->commercial }} </td>
            </tr>
           @endif
            <tr>
                <td class="text-right h5 font-weight-bold" colspan="5"> {{ _lang('Sale Price') }}</td>
                <td> {{ $model->default_sell_price }} </td>
            </tr>
            
        </tbody>
    </table>
</div>
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