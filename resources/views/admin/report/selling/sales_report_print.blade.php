@extends('layouts.report', ['title' => _lang('Sales Report'),'report_title'=>_lang('Sales Report')])
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row">
        <div class="col-md-6">
            <p class="h5 text-uppercase"><b>{{ _lang('Sales Report') }}: </b> {{ _lang('Date Wise') }} </p>
            <p><b>{{ _lang('Date Range') }}: </b> {{ formatDate($sDate) }} <b>To</b>{{ formatDate($eDate) }} </p>
        </div>
        <div class="col-md-6 text-right">
            <p class="mb-0"> Printing Date : {{ formatDate(date('Y-m-d')) }}</p>
            <p class="mb-0">
            Time : {{ date('H:i') }}</p>
        </div>
    </div>
    <div class="row mt-2 px-4">
        <div class="page-header-space"></div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ _lang('Ref No') }}</th>
                    <th scope="col">{{ _lang('Client') }}</th>
                    <th scope="col">{{ _lang('Product') }}</th>
                    <th scope="col">{{ _lang('Payment Status') }}</th>
                    <th scope="col">{{ _lang('Sold By') }}</th>
                    <th scope="col">{{ _lang('Date') }}</th>
                    @can('view_sale.sale_price')
                    <th scope="col">{{ _lang('Net Total') }}</th>
                    @endcan
                    @can('view_sale.sale_paid')
                    <th scope="col">{{ _lang('Paid') }}</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @php
                    $total_quantity=0;
                @endphp
                @foreach ($result as $element)
                <tr>
                    <th>{{ $element->reference_no }}</th>
                    <th>{{ $element->client?$element->client->name:'' }}</th>
                    <td>
                        <ol>
                            @foreach($element->sell_lines as $sells)
                                <li>
                                    @php 
                                        $total_quantity = $total_quantity + $sells->quantity;
                                    @endphp
                                    {{ $sells->product->name }}-{{$sells->variation->name}}
                                    (   
                                      {{$sells->quantity}} 
                                    )
                                </li>
                            @endforeach
                        </ol>
                    </td>
                    <td>{{ $element->payment_status }}</td>
                    <td>
                        {{ $element->created_person?$element->created_person->email:'' }}
                        
                    </td>
                    <td>
                        {{ formatDate($element->date) }}
                    </td>
                    @can('view_sale.sale_price')
                    <td>
                        {{ $element->net_total }}
                    </td>
                    @endcan
                    @can('view_sale.sale_paid')
                    <td>
                        {{ $element->payment->sum('amount') }}
                        @if ($element->return==true)
                           <br> <span class="badge badge-info">Sale Return</span>
                        @endif
                    </td>
                    @endcan
                </tr>
                @endforeach
            </tbody>
        </table>
            <table style="width: 50%; font-weight: bold;" align="right" class="table table-bordered visible-lg">
            @can('view_sale.sale_discount')
            <tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
                <td style="text-align: right;">
                    <b>{{ _lang('Discount Amt')}} :</b>
                </td>
                <td>
                    {{number_format($result->sum('discount_amount'),2)}}
                </td>
            </tr>
            @endcan
            @can('view_sale.sale_tax')
            <tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
                <td style="text-align: right;">
                    <b>{{_lang('Total Tax')}} :</b>
                </td>
                <td>
                    {{number_format($result->sum('tax'))}} 
                </td>
            </tr>
            @endcan
            @can('view_sale.shipping_charge')
            <tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
                <td style="text-align: right;">
                    <b>{{_lang('Shipping Charge')}} :</b>
                </td>
                <td>
                    {{number_format($result->sum('shipping_charges'))}} 
                </td>
            </tr>
            @endcan
            @can('view_sale.sale_price')

              <tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
                <td style="text-align: right;">
                    <b>{{_lang('Net Total')}} :</b>
                </td>
                <td>
                    {{number_format($result->sum('net_total'),2)}}
                </td>
            </tr>
            @endcan
            @can('view_sale.sale_paid')
              <tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
                <td style="text-align: right;">
                    <b>{{_lang('Total Paid')}} :</b>
                </td>
                <td>
                    {{number_format($result->sum('paid'),2)}}
                </td>
            </tr>
            @endcan
            @can('view_sale.qty')

            <tr style="background-color: #F8F9F9;border: 1px solid #ddd;">
                <td style="text-align: right;">
                    <b>{{_lang('Sale Qty')}} :</b>
                </td>
                <td>{{$total_quantity}}</td>
            </tr>
            @endcan

            
        </table>
        <div class="page-footer-space"></div>
    </div>
    
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