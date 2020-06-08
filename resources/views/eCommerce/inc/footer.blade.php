<div class="footer-holder dark">
    <div class="container">
        <div class="row">

            {{-- Footer First Side --}}
            <div class="col-xs-12 col-sm-4 col-md-3 mt-paddingbottomsm">
                <div class="f-widget-about">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            <img style="width: 100px;" alt="Brand Logo" src="{{ get_option('logo') && get_option('logo') != '' ? asset('storage/logo'. '/' . get_option('logo')) : asset('frontend/images/mt-logo.png') }}">
                        </a>
                    </div>
                    <p>{{get_option('description')?get_option('description'):''}}</p>
                    <!-- Social Network of the Page -->
                    <ul class="list-unstyled social-network">
                        @if (get_option('twiter') && get_option('twiter') != '')
                            <li><a target="_blank" href="{{get_option('twiter')}}"><i class="fa fa-twitter"></i></a></li>
                        @endif
                        @if (get_option('fb') && get_option('fb') != '')
                            <li><a target="_blank" href="{{get_option('fb')}}"><i class="fa fa-facebook"></i></a></li>
                        @endif
                        @if (get_option('youtube') && get_option('youtube') != '')
                            <li><a target="_blank" href="{{get_option('youtube')}}"><i class="fa fa-youtube"></i></a></li>
                        @endif
                        @if (get_option('linkedin') && get_option('linkedin') != '')
                            <li><a target="_blank" href="{{get_option('linkedin')}}"><i class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            {{-- Footer Second Part --}}
            <nav class="col-xs-12 col-sm-8 col-md-5 mt-paddingbottomxs">
                <div class="nav-widget-1">
                    <h3 class="f-widget-heading">Categories</h3>
                    <ul class="list-unstyled f-widget-nav">
                        @php
                            $category = App\models\Production\Category::inRandomOrder()->take(4)->get();
                        @endphp
                        @foreach ($category as $item)
                        <li>
                            <a href="{{route('category-product',$item->id)}}">
                                <span class="name">{{$item->name}}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                <div class="nav-widget-1" style="margin-left:50px">
                    <h3 class="f-widget-heading">Information</h3>
                    <ul class="list-unstyled f-widget-nav">
                        <li><a href="{{route('about')}}">About Us</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        <li><a href="{{route('terms-condition')}}">Terms &amp; Conditions</a></li>
                        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
                    </ul>
                </div>

            </nav>

            <div class="col-xs-12 col-sm-6 col-md-4 text-right hidden-sm">
                <div class="f-widget-about">
                    <h3 class="f-widget-heading">Information</h3>
                    <ul class="list-unstyled address-list align-right">
                        <li><i class="fa fa-map-marker"></i>
                            <address>{{get_option('address')?get_option('address'):''}}</address>
                            @if (get_option('address_2') && get_option('address_2') != '')
                                <address>{{ get_option('address_2') }}</address>
                            @endif
                            @if (get_option('address_optional') && get_option('address_optional') != '')
                                <address>{{ get_option('address_optional') }}</address>
                            @endif
                            <address>{{get_option('city') ? get_option('city') : '' }}, {{get_option('state') ? get_option('state') : '' }}, {{get_option('zip') ? get_option('zip') : '' }}, {{get_option('country') ? get_option('country') : '' }}</address>
                        </li>
                        <li><i class="fa fa-phone"></i><a href="tel:{{get_option('phone')?get_option('phone'):''}}">{{get_option('phone')? ''.get_option('phone'):''}}</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="mailto:{{get_option('email')?get_option('email'):''}}">{{get_option('email')?get_option('email'):''}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <p>© <a href="{{url('/')}}">Decent Footwear.</a> - All rights Reserved. Powered by <a href="http://sattit.com" target="_blank">Satt IT</a></p>
            </div>
            <div class="col-xs-12 col-sm-6 text-right">
                <div class="bank-card">
                    {{-- <img src="{{asset('frontend')}}/images/bank-card.png" alt="bank-card"> --}}
                </div>
            </div>
        </div>
    </div>
</div>
