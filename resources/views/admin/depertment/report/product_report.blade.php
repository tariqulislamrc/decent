@extends('layouts.app', ['title' => _lang('Depertment Product Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Depertment Store Request."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Depertment Product Report')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<form action="{{route('admin.report.store')}}" method="post" class="ajax_form"
    enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Depertment Product Report')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">

                {{-- Purchase Date: --}}
                   <div class="col-md-6 form-group" id="work_order">
                    <label for="department_id">{{_lang('Depertment')}}
                    </label>
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Depertment" name="department_id" id="department_id">
                            <option value="">Select One</option>
                            @foreach ($depertments as $depert)
                                <option value="{{ $depert->id }}">{{ $depert->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6 form-group" id="work_order">
                    <label for="work_order_id">{{_lang('WorkOrder')}}
                    </label>
                    <div class="input-group">
                        <select class="form-control select" data-placeholder="Select Work Order" name="work_order_id" id="work_order_id"  data-url="">
                            <option value="">Select One</option>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">{{ $order->prefix}}-{{  $order->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" id="data">
                
            </div>
        </div>

    </div>
</form>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
$('.select').select2();
$(document).on('change', '#work_order_id,#department_id', function () {
// it will get action url
$('.pageloader').show();
    var url = "{{ route('admin.report.get_variation_product') }}";
    var id = $("#work_order_id").val();
    var depertment = $("#department_id").val();
        $.ajax({
            url: url,
            data: {
            id: id,
            depertment:depertment
            },
            type: 'Get',
            dataType: 'html'
        })
    .done(function (data) {
        $('.pageloader').hide();
          $('#data').html(data);
          $("#data").find('.select_custom').select2();
    })
});
_classformValidation();
</script>

@endpush
