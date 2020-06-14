@php
    $banner = App\models\eCommerce\PageBanner::where('page_name', 'Register')->first();
@endphp
@extends('eCommerce.layouts.app')
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    <section class="mt-contact-banner" style="background-image: url({{isset($banner)?asset('storage/page/'.$banner->image):'http://placehold.it/1920x325'}});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>SIGN IN or register</h1>
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }} ">home <i class="fa fa-angle-right"></i></a></li>
                            <li>register</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-detail-sec toppadding-zero" style="padding-bottom:20px; margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-push-1">
                    <div class="holder" style="margin: 0;">
                        <div class="mt-side-widget">
                            <header>
                                <h2 style="margin: 0 0 5px;">Register</h2>
                                <p>Don’t Have An Account?</p>
                            </header>
                            <form action="{{route('register')}}" method="post" id="content_form" autocomplete="off" style="margin: 0 0 80px;">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <input autofocus type="text" name="name" required placeholder="Enter Your Full Name" class="input">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="text" name="phone" required placeholder="Enter Your Phone Number" class="input">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="email" name="email" required placeholder="Enter Your Email Address" class="input email">
                                            <span id="emailError" class="text-danger"></span>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="password" name="password" required placeholder="Password" class="input">
                                        </div>
                                    </div>
                                    <button type="submit" id="submit" class="btn-type1 mt-5">Register</button>
                                    <button type="button" style="display: none;" id="submiting" class="btn-type1 mt-5">Please Wait ...</button>
                                </fieldset>
                            </form>
                            <header>
                                <h2 style="margin: 0 0 5px;">register with social</h2>
                                <p>Create an account using social</p>
                            </header>
                            <ul class="mt-socialicons">
                                <li class="mt-facebook"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li class="mt-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li class="mt-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li class="mt-dribbble"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mt Detail Section of the Page end -->

</main>
<!-- footer of the Page -->
@endpush
@push('scripts')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('backend/js/parsley.min.js')}}"></script>
{{-- <script src="{{ asset('js/eCommerce/register.js') }}"></script> --}}
<script>
    _formValidation();
</script>
@endpush
