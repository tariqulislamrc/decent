@extends('layouts.app', ['title' => _lang('setting'), 'modal' => false])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-toggle="tooltip" data-placement="bottom" title="Change Your Software Module Configuration from here."><i class="fa fa-wrench mr-4"></i> {{_lang('Module Configuration')}}</h1>
            <p>{{_lang('Change Your Software Module Configuration from here.')}} </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('module-settings') }}
        </ul>
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="bs-component">

                    <!-- Tab panes -->
                    {!! Form::open(['route' => 'admin.setting', 'id' => 'content_form','files' => true, 'method' => 'POST']) !!}
                        <div class="tab-content">
                            {{-- This is for Home Section --}}
                            <h3 class="text-center">Employee Configaration</h3><hr>
                                <div class="row">
                                    {{-- Employee Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('employee_code_prefix', _lang('Employee Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('employee_code_prefix', get_option('employee_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Employee Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Employee Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_employee_code', _lang('Digits Employee Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_employee_code', get_option('digits_employee_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Employee Code')]) }}
                                    </div>
                                </div>


                            {{-- This is for Member Configaration --}}
                            <hr><h3 class="text-center">Member Configaration</h3><hr>
                                <div class="row">
                                    {{-- Member Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('member_code_prefix', _lang('Member Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('member_code_prefix', get_option('member_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Member Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Member Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_member_code', _lang('Digits Member Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_member_code', get_option('digits_member_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Member Code')]) }}
                                    </div>
                                </div>

                            {{-- This is for Production Configaration --}}
                            <hr><h3 class="text-center">Production Configaration</h3><hr>
                                <div class="row">
                                    {{-- Production Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('production_code_prefix', _lang('Production Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('production_code_prefix', get_option('production_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Production Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Production Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_production_code', _lang('Digits Production Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_production_code', get_option('digits_production_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Production Code')]) }}
                                    </div>
                                </div>

                                {{-- This is for Work Order Configaration --}}
                                <hr><h3 class="text-center">Production Work Order Configaration</h3><hr>
                                <div class="row">
                                    {{-- Production work order Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('work_order_code_prefix', _lang('Work Order Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('work_order_code_prefix', get_option('work_order_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Work Order Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Production Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_work_order_code', _lang('Digits Work Order Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_work_order_code', get_option('digits_work_order_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Work Order Code')]) }}
                                    </div>
                                </div>


                               <hr> <h3 class="text-center">Leave Configaration</h3><hr>
                                <div class="row">
                                    {{--Leave Holiday Calculation Mode --}}
                                    <div class="col-md-12">
                                        {{ Form::label('holiday_mode', _lang('Leave Holiday Calculation Mode') , ['class' => 'col-form-label ']) }}
                                        <select name="holiday_mode" id="holiday_mode" class="form-control select" data-placeholder="Select Holiday Calculation Mode">
                                            <option value="">{{_lang('Select Holiday Calculation Mode')}}</option>
                                            <option {{get_option('holiday_mode') == 'Ignore' ? 'selected' : ''}} value="Ignore">{{_lang('Ignore Holiday That falls during Leave Period')}}</option>
                                            <option {{get_option('holiday_mode') == 'Include' ? 'selected' : ''}} value="Include">{{_lang('Include Holiday That falls during Leave Period')}}</option>
                                            <option {{get_option('holiday_mode') == 'Include_if_enclosed' ? 'selected' : ''}} value="Include_if_enclosed">{{_lang('Include Holiday if followed & preceded by leave during Leave Period')}}</option>
                                        </select>
                                    </div>
                                </div>
                            <hr> <h3 class="text-center">Payroll Configaration</h3><hr>
                                <div class="row">
                                    {{--Per Day Salary Calculation Basis --}}
                                    <div class="col-md-6">
                                        {{ Form::label('per_day_sarary', _lang('Per Day Salary Calculation Basis') , ['class' => 'col-form-label ']) }}
                                        <select name="per_day_sarary" id="per_day_sarary" class="form-control select" data-placeholder="Select Per Day Salarye">
                                            <option value="">{{_lang('Select Per Day Salarye')}}</option>
                                            <option {{get_option('per_day_sarary') == 'Calender_basis' ? 'selected' : ''}} value="Calender_basis">{{_lang('As Per Calender Basis')}}</option>
                                            <option {{get_option('per_day_sarary') == 'User_defined' ? 'selected' : ''}} value="User_defined">{{_lang('User Defined')}}</option>
                                        </select>
                                    </div>
                                    {{-- User Defined Days --}}
                                    <div class="col-md-6" style="display:none;" id="defined-days">
                                        {{ Form::label('user_defined_days', _lang('User Defined Days') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('user_defined_days', get_option('user_defined_days'), ['class' => 'form-control', 'placeholder' => _lang('Type User Defined Days')]) }}
                                    </div>
                                </div>
                        </div>
                        @can('module_configuration.update')
                            {{-- This is for submit Button --}}
                            <div class="text-right mr-2 mt-4">
                                <button data-placement="bottom" title="Update The Change"  type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}</button>
                                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                            </div>
                        @endcan
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
    <script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush
