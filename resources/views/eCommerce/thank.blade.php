@extends('eCommerce.layouts.app')
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s"
        style="background-image: url({{isset($banner)?asset('storage/page/'.$banner->image):'http://placehold.it/1920x325'}});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">CHECK OUT</h1>
                    <!-- Breadcrumbs of the Page -->
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="{{url('/')}}">Home <i class="fa fa-angle-right"></i></a></li>
                            <li>Check Out</li>
                        </ul>
                    </nav>
                    <!-- Breadcrumbs of the Page end -->
                </div>
            </div>
        </div>
    </section>
    <!-- Mt Process Section of the Page -->
    <div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Process List of the Page -->
                    <ul class="list-unstyled process-list">
                        <li class="active">
                            <span class="counter">01</span>
                            <strong class="title">Shopping Cart</strong>
                        </li>
                        <li class="active">
                            <span class="counter">02</span>
                            <strong class="title">Check Out</strong>
                        </li>
                        <li class="active">
                            <span class="counter">03</span>
                            <strong class="title">Order Complete</strong>
                        </li>
                    </ul>
                    <!-- Process List of the Page end -->
                </div>
            </div>
        </div>
    </div><!-- Mt Process Section of the Page end -->
    <!-- Mt Detail Section of the Page -->
    
<form action="{{route('shopping-checkout-store')}}" method="post" id="content_form">
	@csrf
    <section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="bg-light p-2 row">
                <h1 class="text-center">THANK YOU</h1>
                <h3 class="text-center">Your order was completed successfully</h3>

                <div class="col-md-4 text-right" style="margin-top: 25px;">
                    <img style="width:100px;float:right;" src="{{ asset('img/thank-you.png') }}" alt="Thank You Image">
                </div>
                <div class="col-md-8 text-right" style="margin-top: 40px;">
                    <p><b>Thank you for purchase our products. Generally we deliver products within 48-72 Hours. Your Invoice Number is {{ $model->reference_no }}. We sent you an email from your email address. Pleas keep it for your records. You can also see it below and your Account.</b></p>
                </div>

                
                <div style="margin-top: 25px;">
                    <div class="col-md-8 text-right" style="margin-top: 40px;">
                        <p><b>You can visit the My Account page at any time to check the status of your order or click here to print a copy of your receipt.</b></p>
                        <img style="width:100px;float:right;" src="{{ asset('img/code.png') }}" alt="Thank You Image">
                        <img style="width:100px;float:right;" src="{{ asset('img/print.png') }}" alt="Thank You Image">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th></th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</form>
    <!-- Mt Detail Section of the Page end -->
</main><!-- Main of the Page end here -->
@endpush
@push('scripts')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('backend/js/parsley.min.js')}}"></script>
<script src="{{ asset('js/eCommerce/checkout.js') }}"></script>
<script>
    _formValidation();
</script>
@endpush
