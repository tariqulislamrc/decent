@extends('eCommerce.layouts.app')     

@push('main')
<main id="mt-main">
    <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{isset($banner)?asset('storage/page/'.$banner->image):'http://placehold.it/1920x325'}});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">My Account</h1>
                    <!-- Breadcrumbs of the Page -->
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="{{url('/')}}">Home <i class="fa fa-angle-right"></i></a></li>
                            <li>My Account</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumbs of the Page end -->
                </div>
            </div>
        </div>
    </section>
    
    <!-- Mt Product Table of the Page -->
    <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">

        <div class="container">
            <div class='row'>
                <h3>Track Order</h3>
                <p>Here you can track all of your order stattus from here</p>
                <div class="col-md-12 mt-5">
                    <div class="row">
                        {{-- Tracking Code --}}
                        <div class="col-md-12 form-group">
                            <label for="code">Tracking Code</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Enter Your Tracking Code Here" required>
                        </div>
                    </div>
                    <div class="text-center">
                        <button data-url="{{route('member.client_track_code')}}" type="button" name="track_code" id="track_code" class="brn btn-info btn-lg">Track</button>
                        <button type="button" class="btn btn-primary btn-lg" disabled  id="track_code_submitting" style="display: none;">{{_lang('Tracking')}} <i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></button>
                    </div>

                    <div id="track_status">
                        
                    </div>
                </div>
            </div>
        </div>

    </div>    

</main>
<!-- footer of the Page -->
@endpush

@push('scripts')
<script src="{{ asset('backend/js/parsley.min.js') }}"></script>
<script>

    // order Tracking
    $('#track_code').click(function() {
        var code = $('#code').val();
        if(code != '') {
            $('#track_status').html('');
            $(this).hide();
            $('#track_code_submitting').show();
            var url = $(this).data('url');
            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    code:code,
                },
                success: function (data) {
                    if(data.status == 'success') {
                        $('#track_status').html(data.html);

                    }
                    if(data.status == 'error') {
                        $('#track_status').html(data.html);
                        $("p").css("background-color");

                    }
                    $('#track_code').show();
                    $('#track_code_submitting').hide();
                }
            });
        }
    });


</script>

@endpush