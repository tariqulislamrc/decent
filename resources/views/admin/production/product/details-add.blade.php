@extends('layouts.app', ['title' => _lang('Production Product For Ecommerce'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Product for Ecommerce."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Ecommerce Product Details Add')}}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('product-details') }}
    </ul>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<form action="{{route('admin.production-product.details-store')}}" method="post" id="content_form"
    enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Add New Production Product')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Short Description --}}
                <div class="col-md-6 form-group">
                    <label for="short_description">{{_lang('Short Description')}} <span class="text-danger">*</span>
                    </label>
                    <textarea  name="short_description" id="short_description" class="form-control" placeholder="Enter Short Description" required></textarea>
                </div>
                {{-- Information --}}
                <div class="col-md-6 form-group">
                    <label for="information">{{_lang('Information')}} <span class="text-danger">*</span>
                    </label>
                    <textarea  name="information" id="information" class="form-control" placeholder="Enter Information" required></textarea>
                </div>
                {{-- Product Details --}}
                <div class="col-md-12 form-group">
                    <label for="description">{{_lang('Description')}}
                    </label>
                    <textarea name="description" class="form-control summernote" id="description"
                        placeholder="Enter Product Details"></textarea>
                </div>

                {{-- Select Image --}}
                <div class="col-md-6 form-group">
                    <label for="photo">{{_lang('Upload Product Photo')}}</label>
                    <input type="file" class="form-control" name="photo" id="photo" multiple>
                </div>

                {{-- Meta Title --}}
                <div class="col-md-6 form-group">
                    <label for="title">{{_lang('Meta Title')}}</label>
                    <input type="text" class="form-control" name="title" id="title" multiple>
                </div>
                {{-- Meta Keyword --}}
                <div class="col-md-6 form-group">
                    <label for="keyword">{{_lang('Meta Keyword')}}</label>
                    <input type="text" class="form-control" name="keyword" id="keyword" multiple>
                </div>
                {{-- Meta Description --}}
                <div class="col-md-6 form-group">
                    <label for="meta_description">{{_lang('Meta Description')}}</label>
                    <textarea name="meta_description" class="form-control" id="meta_description"
                        placeholder="Enter Meta Description"></textarea>
                </div>
            </div>
            
        </div>
        <div class="form-group col-md-12" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                    class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script src="{{ asset('js/production/product.js') }}"></script>
<script src="{{ asset('js/production/add_product.js') }}"></script>
@endpush
