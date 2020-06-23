@extends('layouts.app', ['title' => _lang('Sales Payment Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
	<div>
		<h1 data-placement="bottom" title="Sales Payment Report."><i class="fa fa-universal-access mr-4"></i>
		{{_lang('Report')}}</h1>
	</div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
	<div class="card-header">
		<h6>{{_lang('Sales PaymentReport')}}</h6>
	</div>
	<div class="card-body">
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="client_id">{{_lang('Customer')}}</label>
                  <select name="client_id" id="client_id" class="form-control select">
                  	<option value="All">All Customer</option>
                  	@foreach ($client as $customer)
                  		<option value="{{ $customer->id }}">{{ $customer->name }}({{ $customer->mobile }})</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-6 form-group">
					<label for="transaction_id">{{_lang('Sales Reference')}}</label>
                  <select name="transaction_id" id="transaction_id" class="form-control select">
                  	<option value="All">All Reference</option>
                  	@foreach ($refs as $ref)
                  		<option value="{{ $ref->id }}">{{ $ref->reference_no }}</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-6 form-group">
					<label for="sDate">{{_lang('Start Date')}}</label>
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						</div>
						<input type="text" class="form-control date" name="sDate" id="sDate" value="{{ date('Y-m-d') }}">
					</div>
				</div>
				<div class="col-md-6 form-group">
					<label for="eDate">{{_lang('End Date')}}</label>
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						</div>
						<input type="text" class="form-control date" name="eDate" id="eDate" value="{{ date('Y-m-d') }}">
					</div>
				</div>
			  <div class="col-md-6 mx-auto">
              <button data-url="{{route('admin.report.selling.sales_payment_report')}}" type="button" id="submit" class="btn btn-block btn-sm btn-info">{{ _lang('Get  Report') }}</button>
               <button style="display: none;" type="button" id="submiting" class="btn btn-block btn-sm btn-info" disabled>{{ _lang('Processing...') }}</button>
            </div>
			</div>
	</div>
</div>
 <div class="card mt-3">
    <div class="card-header">
    	Requested Report
    </div>
    <div id="report_data" class="card-body">

    </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
$('.select').select2();
_componentDatefPicker();
$(function() {
    $('#submit').hide();
    $('#submiting').show();
    var client_id = $('#client_id').val();
    var transaction_id = $('#transaction_id').val();
    var sDate = $('#sDate').val();
    var eDate = $('#eDate').val();


    get_data(client_id,transaction_id, sDate, eDate);
});
$('#submit').click(function() {
    $('#submit').hide();
    $('#submiting').show();
    var client_id = $('#client_id').val();
    var transaction_id = $('#transaction_id').val();
    var sDate = $('#sDate').val();
    var eDate = $('#eDate').val();

    get_data(client_id,transaction_id, sDate, eDate);
   
});

function get_data(client_id,transaction_id, sDate, eDate) {
    var url = $('#submit').data('url');
    
    $.ajax({
        url: url,
        data: {
            client_id: client_id,
            transaction_id: transaction_id,
            sDate: sDate,
            eDate: eDate
        },
        type: 'POST',
        dataType: 'html'
    })
    .done(function(data) {
        $('#report_data').html(data);
        toastr.success('Report Genarate');
        $('#submit').show();
        $('#submiting').hide();
    });
}
</script>
@endpush