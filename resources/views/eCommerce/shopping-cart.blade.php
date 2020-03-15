@extends('eCommerce.layouts.app')
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s"
        style="background-image: url(http://placehold.it/1920x325);">
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
    <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row border">
                <div class="col-xs-12 col-sm-6">
                    <strong class="title">PRODUCT</strong>
                </div>
                <div class="col-xs-12 col-sm-2">
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
                $product = App\models\Production\Product::with('photo_details', 'variation')->findOrFail($model->id);
                @endphp
                <div class="row border">
                    <div class="col-xs-12 col-sm-2">
                        <div class="img-holder">
                            <img src="{{$product->photo?asset('storage/product/'.$product->photo):'http://placehold.it/105x105'}}"
                                alt="image description">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <strong class="product-name">{{$model->name}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="price"><i class="fa fa-eur"></i> {{$model->price}}</strong>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <form action="#" class="qyt-form">
                            <fieldset>
                                <input type="hidden" id="cart-id" value="{{$model->id}}">
                                <input type="number" data-url="{{route('shopping-cart-qty')}}"
                                    class="form-control cart-qty" id="cart-qty" value="{{$model->quantity}}">
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <strong class="price"><i class="fa fa-eur"></i> {{Cart::getTotal()}}</strong>
                        <a data-url="{{route('shopping-cart-remove')}}" class="remove" id="remove"><i
                                class="fa fa-close"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <form action="#" class="coupon-form">
                        <fieldset>
                            <div class="mt-holder">
                                <input type="text" class="form-control" placeholder="Your Coupon Code">
                                <button type="submit">APPLY</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- Mt Product Table of the Page end -->
    <!-- Mt Detail Section of the Page -->
    <section class="mt-detail-sec style1 wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                        <h2>Shipping Address</h2>
                        <form action="" method="post" id="contact_form">

                            <div class="form-group row">
                                <label class="col-md-3" for="forname">Full Name</label>
                                <div class="col-lg-9">
                                        <input type="text" class="form-control" name="name" id="forname" style="font-size:12px;"
                                        placeholder="Enter your Full Name" required="">
									</div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="foremail">Email Address</label>
                                <div class="col-lg-9">
                                <input type="email" class="form-control" name="email" value="" id="foremail"
                                    style="font-size:12px;" placeholder="Enter your Email" required="">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-lg-3" for="forphone">Phone Number</label>
                                <div class="col-lg-9">
                                <input type="text" class="form-control" name="phone" value="" id="forphone"
                                    style="font-size:12px;" placeholder="Enter your Phone" required="">
                                </div>
                            </div>



                            <div class="form-group row">

                                <label class="col-lg-3" for="forpassword">Address</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" name="address" style="font-size:12px;" id="forpassword" placeholder="Address" required=""></textarea>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-lg-3" for="forpasswordtwo">City</label>
                                <div class="col-lg-9">
                                <input type="text" class="form-control" name="city" id="forpasswordtwo"
                                    style="font-size:12px;" placeholder="City / District" required="">
                                </div>
                            </div>
                        </form>
                </div>



                <div class="col-xs-12 col-sm-6">
                    <h2>CART TOTAL</h2>
                    <ul class="list-unstyled block cart">
                        <li>
                            <div class="txt-holder">
                                <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                                <div class="txt pull-right">
                                    <span><i class="fa fa-eur"></i> 1299,00</span>
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
                        <li style="border-bottom: none;">
                            <div class="txt-holder">
                                <strong class="title sub-title pull-left">CART TOTAL</strong>
                                <div class="txt pull-right">
                                    <span><i class="fa fa-eur"></i> 1299,00</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a href="#" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Mt Detail Section of the Page end -->
</main><!-- Main of the Page end here -->
@endpush
@push('scripts')
<script>
    $(document).on('keyup blur', '.cart-qty', function () {
        // it will get action url
        var url = $(this).data('url');
        var qty = $(this).val();
        var id = $('#cart-id').val();

        $.ajax({
                url: url,
                data: {
                    id: id,
                    qty: qty
                },
                type: 'Get',
                dataType: 'html'
            })
            .done(function (data) {
                $('#data').html(data);
            })
    });

    $(document).on('click', '.remove', function () {
        // it will get action url
        var url = $(this).data('url');
        var id = $('#cart-id').val();

        $.ajax({
                url: url,
                data: {
                    id: id
                },
                type: 'Get',
                dataType: 'html'
            })
            .done(function (data) {
                $('#data').html(data);
            })
    });

</script>
@endpush
