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
                    @can('view_account.credit')
                    @if ($transaction_type=='All' || $transaction_type=='Credit')
                    <th scope="col">{{ _lang('Credit') }}</th>
                    @endif
                    @endcan

                    @can('view_account.debit')
                    @if ($transaction_type=='All' || $transaction_type=='Debit')
                    <th scope="col">{{ _lang('Debit') }}</th>
                    @endif
                    @endcan
                   
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
                   @can('view_account.credit')
                   @if ($transaction_type=='All' || $transaction_type=='Credit')
                       <td>
                           @if ($element->type=='Credit')
                              {{ number_format($element->amount,2) }}
                           @endif
                       </td>
                   @endif
                   @endcan

                   @can('view_account.debit')
                   @if ($transaction_type=='All' || $transaction_type=='Debit')
                       <td>
                            @if ($element->type=='Debit')
                              {{ number_format($element->amount,2) }}
                           @endif
                       </td>
                   @endif
                   @endcan
                  
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">{{ _lang('Total') }}</th>
                    @can('view_account.credit')
                    @if ($transaction_type=='All' || $transaction_type=='Credit')
                    <td>{{ number_format($result->where('type','Credit')->sum('amount'),2) }}</td>
                    @endif
                    @endcan
                    @can('view_account.debit')
                    @if ($transaction_type=='All' || $transaction_type=='Debit')
                    <td>{{ number_format($result->where('type','Debit')->sum('amount'),2) }}</td>
                    @endif
                    @endcan
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