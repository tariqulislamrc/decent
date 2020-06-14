@extends('eCommerce.layouts.app')
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s"
        style="background-image: url({{isset($banner)?asset('storage/page/'.$banner->image):'http://placehold.it/1920x325'}});">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-center">SHOPPING CART</h1>
                    <!-- Breadcrumbs of the Page -->
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                            <li>Shopping Cart</li>
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
                    <ul class="list-unstyled process-list">
                        <li class="active">
                            <span class="counter">01</span>
                            <strong class="title">Shopping Cart</strong>
                        </li>
                        <li>
                            <span class="counter">02</span>
                            <strong class="title">Check Out</strong>
                        </li>
                        <li>
                            <span class="counter">03</span>
                            <strong class="title">Order Complete</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div><!-- Mt Process Section of the Page end -->
    <!-- Mt Product Table of the Page -->

<form action="{{route('shopping-cart-store')}}" method="post" id="content_form">
	@csrf
    <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row border">
                <div class="col-xs-12 col-sm-5">
                    <strong class="title">PRODUCT</strong>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <strong class="title">VARIATION</strong>
                </div>
                <div class="col-xs-12 col-sm-1">
                    <strong class="title">PRICE</strong>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <strong class="title">QUANTITY</strong>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <strong class="title">TOTAL</strong>
                </div>
            </div>
            <div id='data'>
                @foreach ($models as $model)
                @php
                $product = App\models\Production\Product::with('photo_details', 'variation')->findOrFail($model->attributes->product_id);
                $variation = App\models\Production\Variation::findOrFail($model->id);
                @endphp
                <div class="row border">
                    <div class="col-xs-12 col-sm-2">
                        <div class="img-holder">
                            <img src="{{$product->photo?asset('storage/product/'.$product->photo):'http://placehold.it/105x105'}}"
                                alt="image description">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <strong class="product-name">{{$model->name}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="product-name">{{$variation->name}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-1">
                        <strong class="price">{{get_option('currency')}} {{$model->price}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <div action="#" class="qyt-form">
                            <fieldset>
                                <input type="hidden" class="cart-id" id="cart-id" value="{{$model->id}}">
                                <input type="number" data-url="{{route('shopping-cart-qty')}}"
                                    class="form-control cart-qty" id="cart-qty" value="{{$model->quantity}}">
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="price">{{get_option('currency')}} {{($model->price)*($model->quantity)}}</strong>
                        <a data-url="{{route('shopping-cart-remove')}}" class="remove" id="remove"><i
                                class="fa fa-close"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div  class="coupon-form">
                        <fieldset>
                            <div class="mt-holder">
                                <input type="text" autocomplete="off" id="coupon-value"  class="form-control" placeholder="Your Coupon Code">
                                <input type="hidden" id="c_amount" value="0">
                                <input type="hidden" id="c_type" value="0">
                                <button type="button" data-url="{{route('coupon-check')}}" id="coupon-submit">APPLY</button>
                                <button type="button" style="display: none; font-size:12px;" type="button" class="small" disabled id="submitting">Processing...</button>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Mt Product Table of the Page end -->
    <!-- Mt Detail Section of the Page -->
    <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-offset-3" >
                    <h2>CART TOTAL</h2>
                    <ul class="list-unstyled block cart">
                        <li>
                            <div class="txt-holder">
                                <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                                <div class="txt pull-right">
                                    <span id="sub_total">{{get_option('currency')}} {{Cart::getSubTotal()}}</span>
                                    <input type="hidden" name="sub_total_hidden" value="{{Cart::getSubTotal()}}" id="sub_total_hidden">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="txt-holder">
                                <strong class="title sub-title pull-left">SHIPPING</strong>
                                <div class="txt pull-right">
                                    <strong>Free Shipping</strong>
                                </div>
                            </div>
                        </li>
                        <li id="show_coupon_area" style="display: none;">
                            <div class="txt-holder">
                                <strong class="title sub-title pull-left">Coupon Amount</strong>
                                <div class="txt pull-right">
                                    <strong id="show_discount_amount">৳0.00</strong>
                                </div>
                            </div>
                        </li>
                        <li style="border-bottom: none;">
                            <div class="txt-holder">
                                <strong class="title sub-title pull-left">CART TOTAL</strong>
                                <div class="txt pull-right">
                                    <span id="total">{{get_option('currency')}} {{Cart::getTotal()}}</span>
                                    <input type="hidden" name="total_hidden" value="{{Cart::getTotal()}}" id="total_hidden">
                                    <input type="hidden" name="coupon_amt" value="" id="coupon_amt">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <button type="submit" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
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
<script src="{{ asset('js/eCommerce/cart.js') }}"></script>
<script>
    _formValidation();
</script>
@endpush

