@extends('layouts.app', ['title' => _lang('Home page Image edit'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Home Page."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Home Page')}}</h1>
        <p>{{_lang('Edit home page image for E-commerce Website')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{Breadcrumbs::render('home-page-edit') }}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<form action="{{route('admin.eCommerce.home-page.update', $model->id)}}" method="post" id="content_form"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <h6>{{_lang('Edit home page Image')}}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Product_id --}}
                <div class="col-md-3 form-group">
                    <label for="product_id">{{_lang('Product name')}}</label>
                    <select name="product_id" id="product_id" class="form-control select" data-palceholder="Select One">
                        <option value="">Select One</option>
                        @foreach ($product as $product_item)
                            <option {{$model->product_id==$product_item->id?'selected':''}} value="{{$product_item->id}}">{{$product_item->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{-- banner_image_one_check --}}
                <div class="col-md-3 form-group">
                    <label for="banner_image_one">{{_lang('Banner Image One (415x225)')}}
                        <input type="checkbox" id="banner_image_one_check" name="banner_image_one_check" value="1">
                    </label>
                    <input type="file" disabled name="banner_image_one"  id="banner_image_one" class="form-control" />
                </div>

                {{-- banner_image_one_alt --}}
                <div class="col-md-3 form-group">
                    <label for="banner_image_one_alt">{{_lang('Banner Image one alt')}}</label>
                    <input type="text"  name="banner_image_one_alt" disabled id="banner_image_one_alt" class="form-control" />
                </div>

                {{-- Image Two --}}
                <div class="col-md-3 form-group">
                    <label for="banner_image_two">{{_lang('Banner image Two (415x335) ')}}
                     <input type="checkbox" id="banner_image_two_check" name="banner_image_two_check" value="1">
                    </label>
                    <input type="file" disabled name="banner_image_two" id="banner_image_two" class="form-control" />
                </div>
                 {{-- banner_image_two_alt --}}
                <div class="col-md-3 form-group">
                    <label for="banner_image_two_alt">{{_lang('Banner image two alt')}}</label>
                    <input type="text" disabled name="banner_image_two_alt" id="banner_image_two_alt" class="form-control" />
                </div>

                {{-- banner_frame_one --}}
                <div class="col-md-3 form-group">
                    <label for="banner_frame_one">{{_lang('Banner Frame One (400x210)')}}</label>
                    <input type="file"  name="banner_frame_one" id="banner_frame_one" class="form-control" />
                </div>

                {{-- banner_frame_one_alt --}}
                <div class="col-md-3 form-group">
                    <label for="banner_frame_one_alt">{{_lang('Banner frame one Alt')}}</label>
                    <input type="text"  name="banner_frame_one_alt" id="banner_frame_one_alt" class="form-control" />
                </div>

                {{-- banner_frame_two --}}
                <div class="col-md-3 form-group">
                    <label for="banner_frame_two">{{_lang('Banner Frame Two(590x250)')}}</label>
                    <input type="file"  name="banner_frame_two" id="banner_frame_two" class="form-control" />
                </div>

                {{-- banner_frame_two_alt --}}
                <div class="col-md-3 form-group">
                    <label for="banner_frame_two_alt">{{_lang('Banner frame two Alt')}}</label>
                    <input type="text"  name="banner_frame_two_alt" id="banner_frame_two_alt" class="form-control" />
                </div>

                {{-- tab_slider_image --}}
                <div class="col-md-3 form-group">
                    <label for="tab_slider_image">{{_lang('Tab slider image(275x290)')}}</label>
                    <input type="file"  name="tab_slider_image" id="tab_slider_image" class="form-control" />
                </div>

                {{-- tab_slider_image_alt --}}
                <div class="col-md-3 form-group">
                    <label for="tab_slider_image_alt">{{_lang('Tab slider image alt')}}</label>
                    <input type="text"  name="tab_slider_image_alt" id="tab_slider_image_alt" class="form-control" />
                </div>

                {{-- sale_category_image --}}
                <div class="col-md-3 form-group">
                    <label for="sale_category_image">{{_lang('Tab slider image(80x80)')}}</label>
                    <input type="file"  name="sale_category_image" id="sale_category_image" class="form-control" />
                </div>

                {{-- tab_slider_image_alt --}}
                <div class="col-md-3 form-group">
                    <label for="tab_slider_image_alt">{{_lang('Tab slider image alt')}}</label>
                    <input type="text"  name="tab_slider_image_alt" id="tab_slider_image_alt" class="form-control" />
                </div>

            </div>
        </div>
        <div class="form-group col-md-12" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
        </div>
    </div>
</form>

<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
<script src="{{ asset('js/eCommerce/home_page.js') }}"></script>
<script>
    $(document).ready(function() {

    $('#banner_image_one_check').change(function() {
        if(this.checked) {
            $("#banner_image_one").prop("disabled", false);
            $("#banner_image_one_alt").prop("disabled", false);
            $("#banner_image_two_check").prop("disabled", true);
            $("#banner_image_two").prop("disabled", true);
        }else{
            $("#banner_image_two_check").prop("disabled", false);
            $("#banner_image_one").prop("disabled", true);
            $("#banner_image_one_alt").prop("disabled", true);
        }
         
    });

    $('#banner_image_two_check').change(function() {
        if(this.checked) {
            $("#banner_image_one").prop("disabled", true);
            $("#banner_image_one_check").prop("disabled", true);
            $("#banner_image_two").prop("disabled", false);
            $("#banner_image_two_alt").prop("disabled", false);
        }else{
            $("#banner_image_one_check").prop("disabled", false);
            $("#banner_image_two").prop("disabled", true);
            $("#banner_image_two_alt").prop("disabled", true);
        }
         
    });
});
</script>
@endpush
