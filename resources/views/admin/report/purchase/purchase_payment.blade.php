@extends('layouts.app', ['title' => _lang('Purchase Payment Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
	<div>
		<h1 data-placement="bottom" title="Purchase Payment Report."><i class="fa fa-universal-access mr-4"></i>
		{{_lang('Report')}}</h1>
	</div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
	<div class="card-header">
		<h6>{{_lang('Purchase PaymentReport')}}</h6>
	</div>
	<div class="card-body">
		<form action="{{route('admin.report.purchasing.purchase_payment_report')}}" method="post" enctype="multipart/form-data" target="_blank">
			@csrf
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="employee_id">{{_lang('Purchase Person')}}</label>
                  <select name="employee_id" id="employee_id" class="form-control select">
                  	<option value="All">All Person</option>
                  	@foreach ($employee as $customer)
                  		<option value="{{ $customer->id }}">{{ $customer->name }}({{ $customer->phone }})</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-6 form-group">
					<label for="transaction_id">{{_lang('Purchase Reference')}}</label>
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
					<button type="submit" class="btn btn-block btn-info">{{ _lang('Get Purchase Payment Report') }}</button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
$('.select').select2();
_componentDatefPicker();
</script>
@endpush