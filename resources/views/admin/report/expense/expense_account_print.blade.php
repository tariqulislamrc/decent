@extends('layouts.report', ['title' => _lang('Expense Account Report'),'report_title'=>_lang('Expense Account Report')])
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row">
        <div class="col-md-6">
            <p class="h5 text-uppercase"><b>{{ _lang('Expense Account Name') }}: </b> {{ $investment->name }} </p>
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
                    <th scope="col">{{ _lang('Transection Sub Type') }}</th>
                    <th scope="col">{{ _lang('Date') }}</th>
                    <th scope="col">{{ _lang('Account By') }}</th>
                    @if ($transaction_type=='All' || $transaction_type=='credit')
                    <th scope="col">{{ _lang('Credit') }}</th>
                    @endif
                    @if ($transaction_type=='All' || $transaction_type=='debit')
                    <th scope="col">{{ _lang('Debit') }}</th>
                    @endif
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $element)
                <tr>
                    <td>{{ $element->sub_type }}</td>
                    <td>
                        {{ formatDate($element->date) }}
                    </td>
                    <td>
                        {{ $element->user->email }}
                        
                    </td>
                   @if ($transaction_type=='All' || $transaction_type=='credit')
                       <td>
                           @if ($element->type=='credit')
                              {{ number_format($element->amount,2) }}
                           @endif
                       </td>
                   @endif

                   @if ($transaction_type=='All' || $transaction_type=='debit')
                       <td>
                            @if ($element->type=='debit')
                              {{ number_format($element->amount,2) }}
                           @endif
                       </td>
                   @endif
                  
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">{{ _lang('Total') }}</th>
                    @if ($transaction_type=='All' || $transaction_type=='credit')
                    <td>{{ number_format($result->where('type','credit')->sum('amount'),2) }}</td>
                    @endif
                    @if ($transaction_type=='All' || $transaction_type=='debit')
                    <td>{{ number_format($result->where('type','debit')->sum('amount'),2) }}</td>
                    @endif
                </tr>
            </tfoot>
    
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