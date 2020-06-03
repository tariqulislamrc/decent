@extends('eCommerce.layouts.app')
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    <section class="mt-contact-banner"  style="background-image: url({{isset($banner)?asset('storage/page/'.$banner->image):'http://placehold.it/1920x325'}});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>SIGN IN or register</h1>
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="{{url('/')}}">home <i class="fa fa-angle-right"></i></a></li>
                            <li>register</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Mt Detail Section of the Page -->
    <section class="mt-detail-sec toppadding-zero" style="padding-bottom:20px; padding-top:10px; margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-push-1">
                    <div class="holder" style="margin: 0;">
                        <div class="mt-side-widget">
                            <header>
                                <h2 style="margin: 0 0 5px;">SIGN IN</h2>
                                <p>Welcome back! Sign in to Your Account</p>
                            </header>
                            <form action="{{ route('login') }}" method="post" id="login">
                              @csrf
                                <fieldset>
                                    <input required type="text" placeholder="Username or email address" class="input" autofocus name="email" id="email">
                                    <input required type="password" placeholder="Password" class="input" name="password" id="password">
                                    <div class="box">
                                        <span class="left"><input class="checkbox" type="checkbox" id="check1"><label
                                                for="check1">Remember Me</label></span>
                                    </div>
                                    <button type="submit" class="btn-type1">Login</button>
                                </fieldset>
                            </form>
                        </div>

                        <div style="text-align: center;font-size: 16px;width:100%;"><span style="background:#e6f2ff;color:#000000;padding: 5px;border-radius: 20px;">If You Are New User <a href="{{route('register')}}" style="color: #327DBA;"> Sign Up </a> First</span></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Mt Detail Section of the Page end -->
    <!-- mt side widget end here -->
    {{-- <div class="container">
        <div class="or-divider" style="padding-bottom:20px;"><span class="txt">or</span></div>
    </div> --}}

</main>
<!-- footer of the Page -->
@endpush
@push('scripts')
<script src="{{asset('backend/js/parsley.min.js')}}"></script>
<script src="{{ asset('js/auth/login.js') }}"></script>
@endpush
