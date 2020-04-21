@extends('layouts.app', ['title' => _lang('Expense Account Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
	<div>
		<h1 data-placement="bottom" title="Expense Account Report."><i class="fa fa-universal-access mr-4"></i>
		{{_lang('Report')}}</h1>
	</div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="card">
	<div class="card-header">
		<h6>{{_lang('Expense Report')}}</h6>
	</div>
	<div class="card-body">
		<form action="{{route('admin.report.expense.get_expense_account_report')}}" method="post" enctype="multipart/form-data" target="_blank">
			@csrf
			<div class="row">
				<div class="col-md-4 form-group">
					<label for="investment_account_id">{{_lang('Investment Account')}}</label>
					<select name="investment_account_id" id="investment_account_id" class="form-control select">
						@foreach ($invest_accounts as $account)
						<option value="{{ $account->id }}">{{ $account->name}}-{{  $account->account_number }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4 form-group">
					<label for="transaction_type">{{_lang('Transection Type')}}</label>
					<select name="transaction_type" id="transaction_type" class="form-control select">
						<option value="All">All</option>
						<option value="credit">Credit</option>
						<option value="debit">Debit</option>
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
					<button type="submit" class="btn btn-block btn-info">{{ _lang('Get Expense Account Report') }}</button>
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