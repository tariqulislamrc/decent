@extends('eCommerce.layouts.app')         
	@push('main')
	<!-- Main of the Page -->
      <main id="mt-main">
        <section class="mt-contact-banner mt-banner-22 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(http://placehold.it/1920x325);">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <h1 class="text-center">CHECK OUT</h1>
                <!-- Breadcrumbs of the Page -->
                <nav class="breadcrumbs">
                  <ul class="list-unstyled">
                    <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
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
                  <li>
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
        <section class="mt-detail-sec toppadding-zero wow fadeInUp" data-wow-delay="0.4s">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-6">
                <h2>BILLING DETAILS</h2>
                <!-- Bill Detail of the Page -->
                <form action="#" class="bill-detail">
                  <fieldset>
                    <div class="form-group">
                      <select class="form-control">
                        <option value="1">Select Country</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <input type="text" class="form-control" placeholder="Name">
                      </div>
                      <div class="col">
                        <input type="text" class="form-control" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Town / City">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="State / Country">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Postcode / Zip">
                    </div>
                    <div class="form-group">
                      <div class="col">
                        <input type="email" class="form-control" placeholder="Email Address">
                      </div>
                      <div class="col">
                        <input type="tel" class="form-control" placeholder="Phone Number">
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="checkbox"> Ship to a different address?
                    </div>
                    <div class="form-group">
                      <textarea class="form-control" placeholder="Order Notes"></textarea>
                    </div>
                  </fieldset>
                </form>
                <!-- Bill Detail of the Page end -->
              </div>
              <div class="col-xs-12 col-sm-6">
                <div class="holder">
                  <h2>YOUR ORDER</h2>
                  <ul class="list-unstyled block">
                    <li>
                      <div class="txt-holder">
                        <div class="text-wrap pull-left">
                          <strong class="title">PRODUCTS</strong>
                          <span>Marvelous Modern 3 Seater       x1</span>
                          <span>Bombi Chair    x1</span>
                        </div>
                        <div class="text-wrap txt text-right pull-right">
                          <strong class="title">TOTALS</strong>
                          <span><i class="fa fa-eur"></i> 299,00</span>
                          <span><i class="fa fa-eur"></i> 532,00</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="txt-holder">
                        <strong class="title sub-title pull-left">CART SUBTOTAL</strong>
                        <div class="txt pull-right">
                          <span><i class="fa fa-eur"></i> 532,00</span>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="txt-holder">
                        <strong class="title sub-title pull-left">SHIPPING</strong>
                        <div class="txt pull-right">
                          <span>Free Shipping</span>
                        </div>
                      </div>
                    </li>
                    <li style="border-bottom: none;">
                      <div class="txt-holder">
                        <strong class="title sub-title pull-left">ORDER TOTAL</strong>
                        <div class="txt pull-right">
                          <span><i class="fa fa-eur"></i> 1299,00</span>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <h2>PAYMENT METHODS</h2>
                  <!-- Panel Group of the Page -->
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <!-- Panel Panel Default of the Page -->
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            DIRECT BANK TRANSFER
                            <span class="check"><i class="fa fa-check"></i></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                          <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                        </div>
                      </div>
                    </div>
                    <!-- Panel Panel Default of the Page end -->
                    <!-- Panel Panel Default of the Page -->
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            CHEQUE PAYMENT
                            <span class="check"><i class="fa fa-check"></i></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                          <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                        </div>
                      </div>
                    </div>
                    <!-- Panel Panel Default of the Page end -->
                    <!-- Panel Panel Default of the Page -->
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                          <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            PAYPAL
                            <span class="check"><i class="fa fa-check"></i></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <p>Make your payment directly into our bank account. Please use your order id as the payment reference. Your order wont be shippided until the funds have cleared in our account</p>
                        </div>
                      </div>
                    </div>
                    <!-- Panel Panel Default of the Page end -->
                  </div>
                  <!-- Panel Group of the Page end -->
                </div>
                <div class="block-holder">
                  <input type="checkbox" checked> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                </div>
                <a href="#" class="process-btn">PROCEED TO CHECKOUT <i class="fa fa-check"></i></a>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
      </main><!-- Main of the Page end here -->
@endpush