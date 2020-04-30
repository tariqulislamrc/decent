@extends('layouts.app', ['title' => _lang('Details Account'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Account."><i class="fa fa-universal-access mr-4"></i> {{_lang('Account')}}</h1>
        <p>{{_lang('Details Account.')}}</p>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            
            <div class="tile-body">
                <div class="row">
                    <div class="col-sm-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>{{ _lang('Account Name') }}: </th>
                                        <td>{{$account->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ _lang('Account No') }}:</th>
                                        <td>{{$account->account_number}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ _lang('Balance') }}:</th>
                                        <td><span id="account_balance"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> <i class="fa fa-filter" aria-hidden="true"></i> {{ _lang('Filter') }}:</h3>
                            </div>
                            <div class="card-body">
                               <div class="row">
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('transaction_date_range', _lang('Date Range') . ':') !!}
                                        <div class="input-group">
                                            {!! Form::text('transaction_date_range', null, ['class' => 'form-control', 'readonly', 'placeholder' => _lang('Date Range')]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('transaction_type', _lang('Transection Type') . ':') !!}
                                        <div class="input-group">
                                            {!! Form::select('transaction_type', ['' => _lang('All'),'debit' => _lang('Debit'), 'credit' => _lang('Credit')], '', ['class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                @can('account.access')
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="account_book">
                                        <thead>
                                            <tr>
                                                <th>{{ _lang('Date') }}</th>
                                                <th>{{ _lang('Description') }}</th>
                                                <th>{{ _lang('Credit') }}</th>
                                                <th>{{ _lang('Debit') }}</th>
                                                <th>{{ _lang('Balance') }}</th>
                                                <th>{{ _lang('Action') }}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
{{-- <script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script> --}}
<script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
<script>
        $(document).ready(function(){
        update_account_balance();
        
        // Account Book
        account_book = $('#account_book').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{{route('admin.accounting.account.show',$account->id)}}',
                          columnDefs: [{
                                orderable: false,
                                targets: [5]
                            }],

                        order: [0, 'asc'],
                        "searching": false,
                        columns: [
                            {data: 'operation_date', name: 'operation_date'},
                            {data: 'sub_type', name: 'sub_type'},
                            {data: 'credit', name: 'amount'},
                            {data: 'debit', name: 'amount'},
                            {data: 'balance', name: 'balance'},
                            {data: 'action', name: 'action'}
                        ],
                    });
    });

        $('#transaction_type').change( function(){
            var transaction_type = $('select#transaction_type').val();
            account_book.ajax.url( '{{route("admin.accounting.account.show",[$account->id])}}?type=' + transaction_type ).load();
        });

    function update_account_balance(argument) {
        $('span#account_balance').html('<i class="fa fa-refresh fa-spin"></i>');
        $.ajax({
            url: '{{route('admin.accounting.getAccountBalance',$account->id)}}',
            dataType: "json",
            success: function(data){
                $('span#account_balance').text(data.balance);
            }
        });
    }
</script>
@endpush