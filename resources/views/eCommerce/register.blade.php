@extends('eCommerce.layouts.app')
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    @if (auth('client')->check())
    <section class="mt-contact-banner" style="background-image: url(http://placehold.it/1920x205);">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>SIGN IN or register</h1>
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="index.html">home <i class="fa fa-angle-right"></i></a></li>
                            <li>register</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Mt Detail Section of the Page end -->
    <!-- mt side widget end here -->
    {{-- <div class="container">
        <div class="or-divider" style="padding-bottom:20px;"><span class="txt">or</span></div>
    </div> --}}
    <!-- mt side widget start here -->
    <!-- Mt Detail Section of the Page -->
    <section class="mt-detail-sec toppadding-zero" style="padding-bottom:20px; margin-top:20px">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-push-1">
                    <div class="holder" style="margin: 0;">
                        <div class="mt-side-widget">
                            <header>
                                <h2 style="margin: 0 0 5px;">register</h2>
                                <p>Don’t have an account?</p>
                            </header>
                            <form action="{{route('register')}}" method="post" id="content_form" style="margin: 0 0 80px;">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="text" name="name" required placeholder="First Name" class="input">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="text" name="last_name" required placeholder="Last Name" class="input">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <input autocomplete="off" type="text" name="username" id="username" required placeholder="Username" class="input">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="email" name="email" required placeholder="Your Email" class="input">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="text" name="phone" required placeholder="Your Phone" class="input">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <textarea placeholder="Address" required name="address" class="input"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="password" name="password" required placeholder="Password" class="input">
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <input type="password" name="password_confirmation" required placeholder="Re-type Password" class="input">
                                            <input type="hidden" name="url" value="{{ url()->previous() }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn-type1">Register</button>
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
                                <li class="mt-dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li class="mt-pinterest"><a href="#"><i class="fa fa-openid"></i></a></li>
                                <li class="mt-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
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
    $('#username').keypress(function() {
        var val = $(this).val();
        if(val.trim()) {
            // alert(val);
        }
    })
</script>
@endpush
