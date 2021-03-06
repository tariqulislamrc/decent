@extends('layouts.app', ['title' => _lang('Sale List'), 'modal' => 'xl'])
@push('admin.css')
<style>
.table th, .table td {
padding: 0.2rem 0.5rem;
}
</style>
@endpush
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Purchases for Production."><i class="fa fa-universal-access mr-4"></i> {{_lang('Sale List')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">
            @can('sale_pos.create')
            <a data-placement="bottom" title="Create New Sale" type="button" class="btn btn-info" href ="{{ route('admin.sale.pos.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>{{_lang('New Sale')}}</a>
            @endcan
            </h3>
            <div class="card">
                <div class="card-body">
                  <div class="row">
                          <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sell_list_filter_customer_id',  _lang('Customer')) !!}
                            {!! Form::select('sell_list_filter_customer_id', $customer, null, ['class' => 'form-control select', 'style' => 'width:100%', 'placeholder' => _lang('All')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sell_list_filter_payment_status',  _lang('Payment Status')) !!}
                            {!! Form::select('sell_list_filter_payment_status', ['paid' => _lang('Paid'), 'due' => _lang('Due'), 'partial' => _lang('Partial')], null, ['class' => 'form-control select', 'style' => 'width:100%', 'placeholder' => _lang('All')]); !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('sale_type',  _lang('Sale Type') . ':') !!}
                            {!! Form::select('sale_type', ['retail' => _lang('Retail'), 'wholesale' => _lang('WholeSale')], null, ['class' => 'form-control select', 'style' => 'width:100%', 'placeholder' => _lang('All')]); !!}
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('created_by',  _lang('Created By') . ':') !!}
                            {!! Form::select('created_by', $user, null, ['class' => 'form-control select', 'style' => 'width:100%', 'placeholder' => _lang('All')]); !!}
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="tile-body">
                <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.sale.pos.index') }}">
                    <thead>
                        <tr>
                            <th>{{_lang('Date')}}</th>
                            <th>{{_lang('Ref')}}</th>
                            <th>{{_lang('Client')}}</th>
                            <th>{{_lang('Payment Status')}}</th>
                            <th>{{_lang('Total Amount')}}</th>
                            <th>{{_lang('Total Paid')}}</th>
                            <th>{{_lang('Due')}}</th>
                            <th>{{_lang('Balance')}}</th>
                            <th>{{_lang('action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
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
              // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                orderable: false,
                width: 100,
                targets: [7]
            }],
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                }
            }
        });

       var emran= $('.content_managment_table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copy',
                className: 'btn btn-primary glyphicon glyphicon-duplicate'
            }, {
                extend: 'csv',
                className: 'btn btn-primary glyphicon glyphicon-save-file'
            }, {
                extend: 'excel',
                className: 'btn btn-primary glyphicon glyphicon-list-alt'
            }, {
                extend: 'pdf',
                className: 'btn btn-primary glyphicon glyphicon-file'
            }, {
                extend: 'print',
                className: 'btn btn-primary glyphicon glyphicon-print'
            }],
            columnDefs: [{
                orderable: false,
                targets: [7]
            }],

            order: [0, 'asc'],
            processing: true,
            serverSide: true,
            "ajax": {
            "url": $('.content_managment_table').data('url'),
            "data": function ( d ) {
                d.sale_type = $('#sale_type').val();
                d.customer_id = $('#sell_list_filter_customer_id').val();
                d.payment_status = $('#sell_list_filter_payment_status').val();
                d.created_by = $('#created_by').val();
            }
           },
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
               {
                    data: 'date',
                    name: 'date'
                }, {
                    data: 'reference_no',
                    name: 'reference_no'
                }, {
                    data: 'client',
                    name: 'client'
                }, {
                    data: 'payment_status',
                    name: 'payment_status'
                }, {
                    data: 'net_total',
                    name: 'net_total'
                }, {
                    data: 'paid',
                    name: 'paid'
                }, {
                    data: 'due',
                    name: 'due'
                },{
                    data: 'return',
                    name: 'return'
                }, {
                    data: 'action',
                    name: 'action'
                }
            ]

        });

     $(document).on('change', '#sale_type, #sell_list_filter_customer_id, #sell_list_filter_payment_status, #created_by',  function() {
        emran.ajax.reload();
      });

       $('.select').select2();

     $(document).on('click', '#content_managment', function(e) {
            e.preventDefault();
            //open modal
            $('#modal_remote').modal('toggle');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function(data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    $('#branch_no').focus();
                    $('.select').select2();
                    _modalClassFormValidation();
                    _modalFormValidation();
                })
                .fail(function(data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });

 function myFunction(url) {
    window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=1400,height=400");
    }
</script>
@endpush