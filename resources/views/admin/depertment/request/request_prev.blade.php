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
<div class="card">
    <div class="card-header">
        <h6>{{_lang('Send Store Request ')}}</h6>
    </div>
    <div class="card-body">
        @include('admin.utilities.include_request',['row'=>route('admin.store_request.department',['type'=>'row_material','id'=>$id]),'work'=>route('admin.store_request.department',['type'=>'work_order','id'=>$id])])
    </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
@endpush