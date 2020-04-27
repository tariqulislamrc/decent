@extends('layouts.app', ['title' => _lang('Sales Return Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
	<div>
		<h1 data-placement="bottom" title="Sales Return Report."><i class="fa fa-universal-access mr-4"></i>
		{{_lang('Report')}}</h1>
	</div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
	<div class="card-header">
		<h6>{{_lang('Sales Return Report')}}</h6>
	</div>
	<div class="card-body">
		<form action="{{route('admin.report.selling.sale_return_report')}}" method="post" enctype="multipart/form-data" target="_blank">
			@csrf
			<div class="row">
				<div class="col-md-4 form-group">
					<label for="client_id">{{_lang('Customer')}}</label>
                  <select name="client_id" id="client_id" class="form-control select">
                  	<option value="All">All Customer</option>
                  	@foreach ($client as $customer)
                  		<option value="{{ $customer->id }}">{{ $customer->name }}({{ $customer->mobile }})</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-4 form-group">
					<label for="transaction_id">{{_lang('Sales Reference')}}</label>
                  <select name="transaction_id" id="transaction_id" class="form-control select">
                  	<option value="All">All Reference</option>
                  	@foreach ($refs as $ref)
                  		<option value="{{ $ref->id }}">{{ $ref->reference_no }}</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-4 form-group">
					<label for="user_id">{{_lang('Return By')}}</label>
                  <select name="user_id" id="user_id" class="form-control select">
                  	<option value="All">All User</option>
                  	@foreach ($users as $user)
                  		<option value="{{ $user->id }}">{{ $user->email }}</option>
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
					<button type="submit" class="btn btn-block btn-info">{{ _lang('Get Sales Payment Report') }}</button>
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