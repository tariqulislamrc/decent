@extends('layouts.report', ['title' => _lang('Purchase Payment Report'),'report_title'=>_lang('Purchase Payment Report')])
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row">
        <div class="col-md-6">
            <p class="h5 text-uppercase"><b>{{ _lang('Purchase Payment Report') }}: </b> {{ _lang('Date Wise') }} </p>
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
                    <th scope="col" style="width: 15%">{{ _lang('Ref No') }}</th>
                    <th scope="col" style="width: 15%">{{ _lang('Client') }}</th>
                    <th scope="col" style="width: 70%">{{ _lang('Payment') }}</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($result as $element)
                <tr>
                    <th>{{ $element->transaction->reference_no }} <br>{{ _lang('Total Amt') }} ({{ $element->transaction->net_total }}) </th>
                    <td>{{ $element->employee?$element->employee->name:'' }} </td>
                 @php
                    $payments =App\models\Production\TransactionPayment::where('transaction_id',$element->transaction_id)->whereBetween('payment_date',[$sDate,$eDate])->get();
                @endphp
                <td>
                    <table class="table">
                     <tbody>
                    @foreach ($payments as $payment)
                         <tr>
                             <td style="width: 30%">{{ $payment->payment_date }}</td>
                             <td style="width: 30%">{{ $payment->method }}</td>
                             <td style="width: 40%">{{ $payment->amount }}</td>
                         </tr>
                    @endforeach
                     <tr>
                         <td colspan="2">{{ _lang('Total Payment') }}</td>
                         <td>{{ $payments->sum('amount') }}</td>
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