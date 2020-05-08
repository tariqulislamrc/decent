@extends('layouts.app', ['title' => _lang('Yearly Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Depertment Store Request."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Yearly Report')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 mx-auto">
                  <div class="form-group">
                    {!! Form::label('year', _lang('Please Choose Year') . ':') !!}
                    <div class="input-group">
                        {!! Form::text('year', null, ['class' => 'form-control year', 'readonly','id'=>'year','placeholder' => _lang('Date Range')]) !!}

                    </div>
                </div>
            </div>
        </div>
        @php
            $months = array(01 => 'Jan.', 02 => 'Feb.', 03 => 'Mar.', 04 => 'Apr.', 05 => 'May', 06 => 'Jun.', 07 => 'Jul.', '08' => 'Aug.', '09' => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
        @endphp
        <div class="row">
          <div class="col-md-12" id="filter_data">
              <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ _lang('Month') }}</th>
                            <th>{{ _lang('Sale') }}</th>
                            <th>{{ _lang('Sale Paid') }}</th>
                            <th>{{ _lang('Sale Due') }}</th>
                            <th>{{ _lang('Purchase') }}</th>
                            <th>{{ _lang('Purchase Paid') }}</th>
                            <th>{{ _lang('Purchase Due') }}</th>
                            <th>{{ _lang('Expense') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($months as $key=> $element) 

                            <tr>
                                <td>{{ $element }}</td>
                                <td>{{ ovarallreport('Sale',null,null,null,$key,$year)->sum('net_total') }}</td>
                                <td>{{ ovarallreport('Sale',null,null,null,$key,$year)->sum('total_paid') }}</td>
                                <td>{{ ovarallreport('Sale',null,null,null,$key,$year)->sum('net_total') - ovarallreport('Sale',null,null,null,$key,$year)->sum('total_paid') }}</td>
                                <td>{{ ovarallreport('Purchase',null,null,null,$key,$year)->sum('net_total') }}</td>
                                <td>{{ ovarallreport('Purchase',null,null,null,$key,$year)->sum('total_paid') }}</td>
                                <td>{{ ovarallreport('Purchase',null,null,null,$key,$year)->sum('net_total') - ovarallreport('Purchase',null,null,null,$key,$year)->sum('total_paid') }}</td>
                                <td>
                                    @php
                                        $expense=App\models\Expense\Expense::whereMonth('date',$key)->whereYear('date',$year)->sum('amount');
                                    @endphp
                                    {{ $expense }}
                                </td>
                            </tr>
                            @endforeach 
                    </tbody>
                    <tfoot>
                        <tr class="bg-green text-light">
                            <td>{{ _lang('Total') }}</td>
                            <td>{{ ovarallreport('Sale',null,null,null,null,$year)->sum('net_total') }}</td>
                            <td>{{ ovarallreport('Sale',null,null,null,null,$year)->sum('total_paid') }}</td>
                            <td>{{ ovarallreport('Sale',null,null,null,null,$year)->sum('net_total') - ovarallreport('Sale',null,null,null,null,$year)->sum('total_paid') }}</td>
                            <td>{{ ovarallreport('Purchase',null,null,null,null,$year)->sum('net_total') }}</td>
                            <td>{{ ovarallreport('Purchase',null,null,null,null,$year)->sum('total_paid') }}</td>
                            <td>{{ ovarallreport('Purchase',null,null,null,null,$year)->sum('net_total') - ovarallreport('Purchase',null,null,null,null,$year)->sum('total_paid') }}</td>
                             <td>
                                    @php
                                        $expense_key=App\models\Expense\Expense::whereYear('date',$year)->sum('amount');
                                    @endphp
                                    {{ $expense_key }}
                             </td>
                        </tr>
                    </tfoot>
                </table>
              </div>
          </div>
        </div>
            <div class="row mt-2">
                <div class="col-md-6 mx-auto text-center">
                    <button type="button" onclick="printContent('filter_data')" class="btn btn-primary btn-lg w-100">{{ _lang('Print') }}</button>
                </div>
            </div>
    </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
_componentYearPicker();
        $('#year').change( function() {
            var year=$(this).val();
            $('.pageloader').show();
        $.ajax({
            type: 'GET',
            url: '/admin/report/yearly',
            data: {
                year: year
            },
            dateType: 'html',
            success: function(data) {
                $('.pageloader').hide();
                $("#filter_data").html();
                $("#filter_data").html(data);
            }
        });
        });
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
    // window.close();
}
</script>
@endpush
