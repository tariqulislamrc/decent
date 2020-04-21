@extends('layouts.report', ['title' => _lang('Expense Report'),'report_title'=>_lang('Expense Report')])
@section('content')
<div class="container-fluid px-4 pt-4">
    <div class="row">
        <div class="col-md-6">
            <p class="h5 text-uppercase"><b>{{ _lang('Expense Report') }}: </b> {{ _lang('Date Wise') }} </p>
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
                    <th scope="col">{{ _lang('Category') }}</th>
                    <th scope="col">{{ _lang('Invest Account') }}</th>
                    <th scope="col">{{ _lang('Expense Reason') }}</th>
                    <th scope="col">{{ _lang('Expense By') }}</th>
                    <th scope="col">{{ _lang('Date') }}</th>
                    <th scope="col">{{ _lang('Amount') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($result as $element)
                <tr>
                    <th>{{ $element->category->name }}</th>
                    <th>{{ $element->investment?$element->investment->name:'' }}</th>
                    <td>{{ $element->reson  }}</td>
                    <td>
                        {{ $element->user->email }}
                        
                    </td>
                    <td>
                        {{ formatDate($element->date) }}
                    </td>
                    <td>
                        {{ $element->amount }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="text-center">{{ _lang('Total') }}</td>
                <td>{{ $result->sum('amount') }}</td>
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