@extends('layouts.report', ['title' => _lang('Product Report'),'report_title'=>_lang('Product Report')])
@section('content')
    <div class="container-fluid px-4 pt-4">
        <div class="row">
            <div class="col-md-6">
                <p class="h5 text-uppercase"><b>{{ _lang('Product Report') }}: </b> {{ _lang('Product Wise') }} </p>
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
                    <th scope="col">{{ _lang('Product') }}</th>
                    <th scope="col">{{ _lang('Variation') }}</th>
                    @can('view_product.cost_price')
                        <th scope="col">{{ _lang('Cost Price') }}</th>
                    @endcan
                    @can('view_product.sale_price')
                        <th scope="col">{{ _lang('Sale Price') }}</th>
                    @endcan
                    @can('view_product.qty')
                        <th scope="col">{{ _lang('Sale Qty') }}</th>
                        <th scope="col">{{ _lang('Return Qty') }}</th>
                        <th scope="col">{{ _lang('Stock') }}</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $element)
                    <tr>
                        <td>{{ $element->pro_name }}</td>
                        <td>{{ $element->variation }}</td>
                        @can('view_product.cost_price')
                            <td>{{ $element->default_purchase_price }}</td>
                        @endcan
                        @can('view_product.sale_price')
                            <td>{{ $element->selling_price }}</td>
                        @endcan
                        @can('view_product.qty')
                            <td>
                                @php
                                    $sale =App\models\inventory\TransactionSellLine::where('product_id',$element->product_id)->where('variation_id',$element->variation_id)->get();
                                @endphp
                                {{ $sale->sum('quantity') }}
                            </td>
                            <td>{{ $sale->sum('quantity_returned') }}</td>
                            <td>{{ $element->qty }}</td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
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
