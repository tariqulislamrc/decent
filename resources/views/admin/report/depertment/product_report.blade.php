@extends('layouts.app', ['title' => _lang('Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
	<div>
		<h1 data-placement="bottom" title="Depertment Store Request."><i class="fa fa-universal-access mr-4"></i>
		{{_lang('Report')}}</h1>
	</div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
	<div class="card-header">
		<h6>{{_lang('Depertment Product Report')}}</h6>
	</div>
	<div class="card-body">
		<form action="{{route('admin.report.depertment.get_product_report')}}" method="post" enctype="multipart/form-data" target="_blank">
			@csrf
			<div class="row">
				<div class="col-md-4 form-group">
					<label for="depertment_id">{{_lang('Depertment')}}</label>
                  <select name="depertment_id" id="depertment_id" class="form-control select">
                  	@foreach ($depertments as $element)
                  		<option value="{{ $element->id }}">{{ $element->name }}</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-4 form-group">
					<label for="work_order_id">{{_lang('Work Order')}}</label>
                  <select name="work_order_id" id="work_order_id" class="form-control select">
                  	<option value="All">All Work Order</option>
                  	@foreach ($orders as $order)
                  		<option value="{{ $order->id }}">{{ $order->prefix}}-{{  $order->code }}</option>
                  	@endforeach
                  </select>
				</div>

				<div class="col-md-4 form-group">
					<label for="user_id">{{_lang('User')}}</label>
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
					<button type="submit" class="btn btn-block btn-info">{{ _lang('Report') }}</button>
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
</script>
<script src="{{ asset('js/department/request.js') }}"></script>
@endpush