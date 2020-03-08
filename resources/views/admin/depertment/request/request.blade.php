@extends('layouts.app', ['title' => _lang('Depertment Store Request'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Depertment Store Request."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Depertment Store Request')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<form action="{{route('admin.request.store')}}" method="post" class="ajax_form"
    enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="depertment_id" value="{{ $depert->id }}">
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Send Store Request ')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">

                {{-- Purchase Date: --}}
                <div class="col-md-6 form-group" id="child_unit_row">
                    <label for="request_date">{{_lang('Request Date')}}</label>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control date" name="request_date" id="request_date" value="{{ date('Y-m-d') }}">
                    </div>
                </div>


                {{-- Work Order --}}
                @if ($type=='work_order')
                <div class="col-md-6 form-group" id="work_order">
                    <label for="wo_id">{{_lang('Work Order')}}
                    </label>
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Work Order" name="wo_id"
                            data-url='{{route('admin.request.product_append')}}' id="wo_id" class="form-control select">
                        </select>
                    </div>
                </div>
                @endif
                @if ($type=='row_material')
                {{-- Product --}}
                <div class="col-md-6 form-group" id="product_row">
                    <label for="product_id">{{_lang('Product')}}
                    </label>
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Product" name="product_id"
                            data-url='{{route('admin.request.material_append')}}' id="product_id" class="form-control select">
                        </select>
                    </div>
                </div>
                @endif


            </div>
        </div>


        <div class="card-header">
            <h6>{{_lang('Store Request ')}}</h6>
        </div>
        <div class="card-body">
            @if ($type=='row_material')
            <div class="row">
                <div class="col-md-8 mx-auto" >
                    <div class="input-group mb-3">
                        <select class="form-control select" data-placeholder="Select Row Material" name="row_material"
                            data-url='{{route('admin.request.row_material_append')}}' id="row_material" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-condensed table-bordered table-th-green text-center table-striped"
                    id="purchase_entry_table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Previous Request</th>
                            <th>Request Quantity</th>
                            <th><i class="fa fa-trash" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody id="data">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group col-md-12" id="submit_btn" align="right" style="display:none">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                    class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
        </div>
    </div>
</form>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
    $('.select').select2();

</script>
<script src="{{ asset('js/department/request.js') }}"></script>

@endpush
