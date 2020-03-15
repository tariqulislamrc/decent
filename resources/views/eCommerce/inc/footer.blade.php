<!-- Footer Holder of the Page -->
<div class="footer-holder dark">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3 mt-paddingbottomsm">
                <!-- F Widget About of the Page -->
                <div class="f-widget-about">
                    <div class="logo">
                        <a href="index.html"><img src="{{asset('frontend')}}/images/logo.png" alt="Schon"></a>
                    </div>
                    <p>{{get_option('description')?get_option('description'):''}}</p>
                    <!-- Social Network of the Page -->
                    <ul class="list-unstyled social-network">
                        <li><a target="_blank" href="{{get_option('twiter')}}"><i class="fa fa-twitter"></i></a></li>
                        <li><a target="_blank" href="{{get_option('fb')}}"><i class="fa fa-facebook"></i></a></li>
                        <li><a target="_blank" href="{{get_option('youtube')}}"><i class="fa fa-youtube"></i></a></li>
                        <li><a target="_blank" href="{{get_option('linkedin')}}"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                    <!-- Social Network of the Page end -->
                </div>
                <!-- F Widget About of the Page end -->
            </div>
            <nav class="col-xs-12 col-sm-8 col-md-6 mt-paddingbottomxs">
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1">
                    <h3 class="f-widget-heading">Categories</h3>
                    <ul class="list-unstyled f-widget-nav">
                        <li><a href="#">Chairs</a></li>
                        <li><a href="#">Sofas</a></li>
                        <li><a href="#">Living</a></li>
                        <li><a href="#">Bedroom</a></li>
                    </ul>
                </div>
                <!-- Footer Nav of the Page end -->
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1">
                    <h3 class="f-widget-heading">Information</h3>
                    <ul class="list-unstyled f-widget-nav">
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        <li><a href="{{route('terms-condition')}}">Terms &amp; Conditions</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- Footer Nav of the Page end -->
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1">
                    <h3 class="f-widget-heading">Account</h3>
                    <ul class="list-unstyled f-widget-nav">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Order Tracking</a></li>
                        <li><a href="#">Wish List</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="#">Checkout</a></li>
                    </ul>
                </div>
                <!-- Footer Nav of the Page end -->
            </nav>
            <div class="col-xs-12 col-sm-6 col-md-3 text-right hidden-sm">
                <!-- F Widget About of the Page -->
                <div class="f-widget-about">
                    <h3 class="f-widget-heading">Information</h3>
                    <ul class="list-unstyled address-list align-right">
                        <li><i class="fa fa-map-marker"></i><address>{{get_option('address')?get_option('address'):''}}</address></li>
                        <li><i class="fa fa-phone"></i><a href="tel:15553332211">{{get_option('phone')?get_option('phone'):''}}</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:&#105;&#110;&#102;&#111;&#064;&#115;&#099;&#104;&#111;&#110;&#046;&#099;&#104;&#097;&#105;&#114;">{{get_option('email')?get_option('email'):''}}</a></li>
                    </ul>
                </div>
                <!-- F Widget About of the Page end -->
            </div>
        </div>
    </div>
</div><!-- Footer Holder of the Page end -->
<!-- Footer Area of the Page -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <p>© <a href="index.html">schön.</a> - All rights Reserved</p>
            </div>
            <div class="col-xs-12 col-sm-6 text-right">
                <div class="bank-card">
                    <img src="{{asset('frontend')}}/images/bank-card.png" alt="bank-card">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer Area of the Page end -->