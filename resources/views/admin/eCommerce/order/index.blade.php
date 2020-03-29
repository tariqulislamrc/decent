@extends('layouts.app', ['title' => _lang('Employee Category'), 'modal' => 'xl'])
@push('admin.css')
    <link rel="stylesheet" href="{{asset('backend/css/daterangepicker.css')}}">
@endpush
{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="E-Commerce Order List."><i class="fa fa-shopping-cart mr-4"></i> {{_lang('E-Commerce Order List')}}</h1>
            <p>{{_lang('View all request for E-Commerce Order List')}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('ecommerce-ordeer-list') }}
        </ul>
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h4 class="tile-title">
                    {{_lang('Sort Order List Usign Order Status')}}
                </h4>
                <div class="tile-body">
                    <select data-url="{{route('admin.eCommerce.order.sort_order')}}" name="sort_order" id="sort_order" class="form-control select">
                        <option value="pending">{{_lang('Pending')}}</option>
                        <option value="confirm">{{_lang('Confirm')}}</option>
                        <option value="progressing">{{_lang('In Progressing')}}</option>
                        <option value="shipment">{{_lang('In Shipment')}}</option>
                        <option value="success">{{_lang('Success')}}</option>
                        <option value="cancel">{{_lang('Cancel')}}</option>
                        <option value="all">{{_lang('All Order')}}</option>
                    </select>
                
                    <input data-url="{{route('admin.eCommerce.order.sort_order_date_wise')}}" type="text" class="form-control mt-3" id="date" autocomplete="off" >

                    <div class="text-center" id="show_loader" style="display:none;">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body table-responsive" id="data">
                    <table class="table table-hover table-bordered content_managment_table">
                        <thead>
                            <tr>
                                <th>{{_lang('ID')}}</th>
                                <th>{{_lang('Payment Type')}}</th>
                                <th>{{_lang('Track Code')}}</th>
                                <th>{{_lang('Subtotal')}}</th>
                                <th>{{_lang('Shipping Name')}}</th>
                                <th>{{_lang('Phone')}}</th>
                                <th>{{_lang('Total')}}</th>
                                <th>{{_lang('Date')}}</th>
                                <th>{{_lang('Status')}}</th>
                                <th>{{_lang('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($models as $model)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$model->payment_status}}</td>
                                    <td>{{$model->reference_no}}</td>
                                    <td>{{get_option('currency') ? 'BDT' : get_option('currenct') }} {{$model->sub_total}}</td>
                                    <td>{{get_client_name($model->client_id)}}</td>
                                    <td>{{get_client_phone($model->client_id)}}</td>
                                    <td>{{get_option('currency') ? 'BDT' : get_option('currenct') }} {{$model->net_total}}</td>
                                    <td>{{formatDate($model->created_at)}}</td>
                                    <td>
                                        @if ($model->ecommerce_status == 'pending')
                                            {{_lang('Pending')}}
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.eCommerce.order.show',$model->id)}}" ><i class="fa fa-shopping-bag"></i></button>
                                    </td>
                                </tr>
                            @endforeach
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
    <script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script>
    <script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
    <script src="{{ asset('backend/js/moment.min.js') }}"></script>
    <script src="{{ asset('backend/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('js/ecommerce/order.js') }}"></script>
    <script>
        $('#sort_order').change(function() {
            var val = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    val: val
                },
                beforeSend: function() {
                    $('#show_loader').fadeIn();
                }, 
                success: function (data) {
                    $('#data').html(data);
                    $('#show_loader').fadeOut();
                }
            });
        });

        $('#date').dateRangePicker(
	{
	}).on('datepicker-first-date-selected', function(event, obj)
	{
		/* This event will be triggered when first date is selected */
		// console.log('first-date-selected',obj.date1);
		// obj will be something like this:
		// {
		// 		date1: (Date object of the earlier date)
		// }
	})
	.on('datepicker-change',function(event,obj)
	{
		/* This event will be triggered when second date is selected */
		// console.log('change',obj.value);
		// obj will be something like this:
		// {
		// 		date1: (Date object of the earlier date),
		// 		date2: (Date object of the later date),
		//	 	value: "2013-06-05 to 2013-06-07"
		// }
	})
	.on('datepicker-apply',function(event,obj)
	{
        /* This event will be triggered when user clicks on the apply button */
        var val = $('#sort_order').val();
        var start = obj.value;
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                val: val, start:start
            },
            beforeSend: function() {
                $('#show_loader').fadeIn();
            },
            success: function (data) {
                $('#data').html(data);
                $('#show_loader').fadeOut();
            }
        });
	})
	// .on('datepicker-close',function()
	// {
	// 	/* This event will be triggered before date range picker close animation */
	// 	console.log('before close');
	// })
	// .on('datepicker-closed',function()
	// {
	// 	/* This event will be triggered after date range picker close animation */
	// 	console.log('after close');
	// })
	// .on('datepicker-open',function()
	// {
	// 	/* This event will be triggered before date range picker open animation */
	// 	console.log('before open');
	// })
	.on('datepicker-opened',function()
	{
		/* This event will be triggered after date range picker open animation */
		console.log('after open');
	});
    </script>
@endpush
