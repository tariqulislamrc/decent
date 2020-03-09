@extends('layouts.app', ['title' => _lang('Production Product Create'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Product for Production."><i class="fa fa-universal-access mr-4"></i>
                {{_lang('Production Product Create')}}</h1>
            <p>{{_lang('Create brand for Production.')}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('product-create') }}
        </ul>
    </div>
@stop
{{-- Main Section --}}
@section('content')
    <!-- Basic initialization -->
        <div class="modal fade border-top-success rounded-top-0 category_modal" role="dialog" >
    </div>

    <div class="modal fade border-top-success rounded-top-0 material_modal" role="dialog" >
    </div>
    <div class="modal fade border-top-success rounded-top-0 unit_modal" role="dialog" >
    </div>
    <!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
    <script src="{{ asset('js/production/product.js') }}"></script>
    <script src="{{ asset('js/production/add_product.js') }}"></script>
    <script>
        $('.select_custom').select2({
            width:'88%'
        });
    </script>
@endpush
