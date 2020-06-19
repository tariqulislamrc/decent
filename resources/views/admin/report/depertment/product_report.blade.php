@extends('layouts.app', ['title' => _lang('Product Report'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-placement="bottom" title="Product Report."><i class="fa fa-universal-access mr-4"></i>
                {{_lang('Report')}}</h1>
        </div>
    </div>
@stop
{{-- Main Section --}}
@section('content')
    <!-- Basic initialization -->
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Product Report')}}</h6>
        </div>
        <div class="card-body">
            <form action="{{route('admin.report.product_report_print')}}" method="post" enctype="multipart/form-data" target="_blank">
                @csrf
                <div class="row">
                    <div class="col-md-8 mx-auto form-group">
                        <label for="product">{{_lang('Product')}}</label>
                        <select name="product" id="product" class="form-control select">
                            <option value="All">All Product</option>
                            @foreach ($products as $product)
                                @if ($product->variation)

                                    <option value="{{ $product->product_id }}/{{ $product->variation_id }}">{{ $product->pro_name }}({{ $product->variation }})</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mx-auto">
                        <button type="submit" class="btn btn-block btn-info">{{ _lang('Get Product Report') }}</button>
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
