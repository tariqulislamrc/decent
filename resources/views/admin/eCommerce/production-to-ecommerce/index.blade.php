@extends('layouts.app', ['title' => _lang('Production to eCommerce '), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Work Order for Production."><i class="fa fa-universal-access mr-4"></i> {{_lang('Production to eCommerce')}}</h1>
            <p>{{_lang('Create New ecommerce product from Production. Here you can Add, Edit & Delete The production Work Order')}}</p>
        </div>
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">
                    {{-- @can('production_work_order.create') --}}
                        <a data-placement="bottom" title="Create New Ecommerce Product" type="button" class="btn btn-info" href ="{{ route('admin.eCommerce.production-to-ecommerce.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('Transfer Stock')}}</a>
                    {{-- @endcan --}}
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.eCommerce.producion-to-ecommerce.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Product')}}</th>
                                <th>{{_lang('Variation')}}</th>
                                <th>{{_lang('Quantity')}}</th>
                                <th>{{_lang('Date')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
    <script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
    <script src="{{ asset('js/eCommerce/production-to-ecommerce.js') }}"></script>
@endpush

