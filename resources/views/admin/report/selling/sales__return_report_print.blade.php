@extends('layouts.report', ['title' => _lang('Sales Return Report'),'report_title'=>_lang('Sales Return Report')])
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row">
        <div class="col-md-6">
            <p class="h5 text-uppercase"><b>{{ _lang('Sales Return Report') }}: </b> {{ _lang('Date Wise') }} </p>
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
                    <th scope="col" style="width: 15%">{{ _lang('Sale Ref No') }}</th>
                    <th scope="col" style="width: 15%">{{ _lang('Client') }}</th>
                    <th scope="col" style="width: 70%">{{ _lang('Return Transaction') }}</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($result as $element)
                <tr>
                    <th>{{ $element->return_trans->reference_no }} 
                        <br>{{ _lang('Sale Amt') }} ({{ $element->return_trans->net_total }})
                        <br>{{ _lang('Paid Amt') }} ({{ $element->return_trans->payment->sum('amount') }})
                     </th>
                    <td>{{ $element->client->name }} </td>
                <td>
                @php
                    $returns =App\models\Production\Transaction::where('return_parent_id',$element->return_parent_id)->whereBetween('date',[$sDate,$eDate])->get();

                @endphp
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ _lang('Return Ref') }}</th>
                                <th>{{ _lang('Date') }}</th>
                                <th>{{ _lang('Discount') }}</th>
                                <th>{{ _lang('Net Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($returns as $return)
                         <tr>
                             <td style="width: 25%">{{ $return->reference_no }}</td>
                             <td style="width: 25%">{{ $return->date }}</td>
                             <td style="width: 25%">{{ number_format($return->discount_amount,2) }}</td>
                             <td style="width: 25%">{{ number_format($return->net_total,2) }}</td>
                         </tr>
                       @endforeach
                           <tr>
                               <td colspan="2">{{ _lang('Total') }}</td>
                               <td>{{ number_format($returns->sum('discount_amount'),2) }}</td>
                               <td>{{ number_format($returns->sum('net_total'),2) }}</td>
                           </tr>
                        </tbody>
                    </table>
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