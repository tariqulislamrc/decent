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
<form action="{{route('admin.request.update',$model->id)}}" method="post" class="ajax_form"
    enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Store Request ')}}</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>{{ _lang('Depertment') }}</th>
                        <th>{{ $model->depertment->name }}</th>
                    </tr>
                    <tr>
                        <th>{{ _lang('Send By') }}</th>
                        <th>{{ $model->send_by->email }}</th>
                    </tr>
                    <tr>
                        <th>{{ _lang('Send Date') }}</th>
                        <th>{{ formatDate($model->request_date) }}</th>
                    </tr>
                </thead>
            </table>
            <div class="table-responsive">
                <table class="table table-condensed table-bordered table-th-green text-center table-striped"
                    id="purchase_entry_table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Request Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" name="raw_material_id" value="{{ $model->raw_material_id}}" class="pid">
                                {{ $model->material->name }}
                            </td>
                            <td>
                                <input type="text" class="form-control qty " id="{{$model->id}}" name="qty"
                                value="{{ $model->qty }}" required>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <tfoot>
                    <tr>
                        <td colspan="2">
                        <label for="note">{{_lang('Note')}}
                        </label>
                        <textarea name="note" class="form-control" id="" placeholder="Note"></textarea>
                        </td>
                    </tr>
                </tfoot>
            </div>
        </div>
        <div class="form-group col-md-12" id="submit_btn" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Approve & Store')}}<i
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