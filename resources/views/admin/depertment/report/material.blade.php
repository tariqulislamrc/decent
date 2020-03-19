@extends('layouts.app', ['title' => _lang('Depertment Material Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Depertment Store Request."><i class="fa fa-universal-access mr-4"></i>
        {{_lang('Depertment Material Report')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<p class="text-right"> 
<a class="btn btn-danger mb-2" href="{!!  url()->previous() !!}"><i class="fa fa-backward" aria-hidden="true"></i>{{ _lang('Go Back') }}</a>
</p>
<form action="{{route('admin.report.store')}}" method="post" class="ajax_form"
    enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Depertment Material Report ')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Purchase Date: --}}
                <div class="col-md-10 mx-auto form-group" id="work_order">
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
            </div>
        </div>
    </div>
    <div id="data">
        
    </div>
</form>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script>
$('.select').select2();
$(document).on('change', '#department_id', function () {
// it will get action url
$('.pageloader').show();
    var url = "{{ route('admin.report.get_depertment_material') }}";
    var depertment = $("#department_id").val();
        $.ajax({
            url: url,
            data: {
            depertment:depertment
            },
            type: 'Get',
            dataType: 'html'
        })
    .done(function (data) {
        $('.pageloader').hide();
          $('#data').html(data);
          $(".example").DataTable({
            searching: true
          });
    })
});
_classformValidation();
</script>
@endpush