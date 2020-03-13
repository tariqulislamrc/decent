@extends('layouts.report', ['title' => _lang('Depertment Product Report'),'report_title'=>_lang('Product Report')])

@section('content')
 <div class="container-fluid px-4 pt-4">

        <div class="row">
            <div class="col-md-6">
                <p class="h5 text-uppercase"><b>{{ $order->name }} Depertment: </b> {{ _lang('Product Report') }} </p>
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
                        <th scope="col">{{ _lang('WorkOrder') }}</th>
                        <th scope="col">{{ _lang('Product') }}</th>
                        <th scope="col">{{ _lang('Request Qty') }}</th>
                        <th scope="col">{{ _lang('Done Qty') }}</th>
                        <th scope="col">{{ _lang('Waste') }}</th>
                        <th scope="col">{{ _lang('Done By') }}</th>
                        <th scope="col">{{ _lang('Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($result as $element)
                	<tr>
                		<th>{{ $element->work_order->prefix }}-{{ $element->work_order->code }}</th>
                        <th>{{ $element->product?$element->product->name:'' }}-{{ $element->variation->name }}</th>
                        <td>{{ $element->qty  }}</td>
                        <td> 
                        	@if ($order->flow=='First')
                        		{{ $element->qty  }}
                        	@else
                        	{{ report_product_flow($depertment_id,$element->work_order_id,$element->variation_id,$element->id) }}
                        	@endif
                        </td>
                        <td>
                        	@if ($order->flow=='First')
                        	0
                        	@else
                        		{{ $element->qty-report_product_flow($depertment_id,$element->work_order_id,$element->variation_id,$element->id) }}
                        	@endif
                        </td>
                        <td>
                           {{ $element->send_by->email }}
                        	
                        </td>
                        <td>
                        	{{ formatDate($element->date) }}
                        </td>
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