@extends('layouts.app', ['title' => _lang('Production Purchases'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Purchases for Production."><i class="fa fa-universal-access mr-4"></i> {{_lang('Production Purchases')}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('purchase') }}
        </ul>
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">
                    @can('production_purchase.create')
                        <a data-placement="bottom" title="Create New Production Product" type="button" class="btn btn-info" href ="{{ route('admin.production-purchase.request') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</a>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.purchase.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('SL')}}</th>
                                <th>{{_lang('Purchase By')}}</th>
                                <th>{{_lang('Company')}}</th>
                                <th>{{_lang('Reference No')}}</th>
                                <th>{{_lang('Invoice No')}}</th>
                                <th>{{_lang('Purchase Date')}}</th>
                                <th>{{_lang('Grand Total')}}</th>
                                <th>{{_lang('Purchase Status')}}</th>
                                <th>{{_lang('action')}}</th>
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
    <script src="{{ asset('js/production/purchase.js') }}"></script>
@endpush

