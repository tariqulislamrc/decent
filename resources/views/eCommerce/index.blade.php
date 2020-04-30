@extends('eCommerce.layouts.app')         
	@push('main')
	<!-- mt main start here -->
	<main id="mt-main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
				
					{{-- Banner Start --}}
						<div class="banner-frame mt-paddingsmzero wow fadeInUp" data-wow-delay="0.4s">
							<div class="slider-7 mt-paddingbottomsm wow fadeInLeft" data-wow-delay="0.4s">
								<div class="slider banner-slider">
									@php
										$banner = App\EcommerceOffer::where('size', '765 X 580')->with('product')->get();
									@endphp
									@if (count($banner) > 0)
										@foreach ($banner as $item)
											<div class="s-holder">
												<img src="{{$item->image && $item->image != '' ? asset('storage/offer/'. $item->image) : 'http://placehold.it/765x580'}}" alt="image description">
												<div class="s-box">
													<strong class="s-title">{{$item->product->category->name}}</strong>
													<span class="heading add">{{$item->heading}}</span>
													<div class="s-txt">
														<p>{{$item->sub_heading}}</p>
													</div>
													<a href="{{route('offer',$item->uuid)}}" class="s-shop">SHOP NOW</a>
												</div>
											</div>
										@endforeach
									@else 
										<div class="s-holder">
											<img src="http://placehold.it/765x580" alt="image description">
											<div class="s-box">
												<strong class="s-title">No Offer Available</strong>
												<span class="heading add">Add 765 X 589 Size Offer for show</span>
												<div class="s-txt">
													<p>
														You Have to Add 765 X 589 Size Offer for show
													</p>
												</div>
												{{-- <a href="{{route('offer',$item->uuid)}}" class="s-shop">SHOP NOW</a> --}}
											</div>
										</div>
									@endif
								</div>
							</div>

							{{-- 415 X 225 --}}
							<div class="banner-box third wow fadeInRight" data-wow-delay="0.4s">
								@php
									$banner = App\EcommerceOffer::where('size', '415 X 225')->with('product')->get();
								@endphp
								@if (count($banner) > 0)
									@foreach ($banner as $item)
										<div class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
											<img src="{{$item->image && $item->image != '' ? asset('storage/offer/'. $item->image) : 'http://placehold.it/765x580'}}" alt="image description">
											<div class="holder">
												<h2><span>{{$item->product->category->name}}</span><strong>{{$item->heading}}</strong></h2>
												<a class="btn-shop" href="{{route('offer',$item->uuid)}}">
													<span>SHOP NOW</span>
													<i class="fa fa-angle-right"></i>
												</a>
											</div>
										</div>
									@endforeach
								@else 
									<div class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
										<img src="http://placehold.it/415x225" alt="image description">
										<div class="holder">
											<h2><span>No Offer Available</span><strong>Add 765 X 589 Size Offer for show</strong></h2>
											{{-- <a class="btn-shop" href="product-detail.html">
												<span>SHOP NOW</span>
												<i class="fa fa-angle-right"></i>
											</a> --}}
										</div>
									</div>
									<div class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
										<img src="http://placehold.it/415x225" alt="image description">
										<div class="holder">
											<h2><span>No Offer Available</span><strong>Add 765 X 589 Size Offer for show</strong></h2>
											{{-- <a class="btn-shop" href="product-detail.html">
												<span>SHOP NOW</span>
												<i class="fa fa-angle-right"></i>
											</a> --}}
										</div>
									</div>
								@endif
							</div>
						</div>
					{{-- Banner End --}}
					<!-- F Promo Box style2 of the Page -->
					<aside class="f-promo-box style2 wow fadeInUp" data-wow-delay="0.4s">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 col-sm-3">
									<!-- F Widget Item of the Page -->
									<div class="f-widget-item">
										<span class="widget-icon"><i class="fa fa-plane"></i></span>
										<div class="txt-holder">
											<h1 class="f-promo-box-heading">FREE SHIPPING</h1>
											<p>Free shipping on all US order</p>
										</div>
									</div>
									<!-- F Widget Item of the Page end -->
								</div>
								<div class="col-xs-12 col-sm-3">
									<!-- F Widget Item of the Page -->
									<div class="f-widget-item border">
										<span class="widget-icon"><i class="fa fa-life-ring"></i></span>
										<div class="txt-holder">
											<h1 class="f-promo-box-heading">SUPPORT 24/7</h1>
											<p>We support 24 hours a day</p>
										</div>
									</div>
									<!-- F Widget Item of the Page end -->
								</div>
								<div class="col-xs-12 col-sm-3">
									<!-- F Widget Item of the Page -->
									<div class="f-widget-item border">
										<span class="widget-icon"><i class="fa fa-dropbox"></i></span>
										<div class="txt-holder">
											<h1 class="f-promo-box-heading">GIFT CARDS</h1>
											<p>Give perfect gift</p>
										</div>
									</div>
									<!-- F Widget Item of the Page end -->
								</div>
								<div class="col-xs-12 col-sm-3">
									<!-- F Widget Item of the Page -->
									<div class="f-widget-item border">
										<span class="widget-icon"><i class="fa fa-money"></i></span>
										<div class="txt-holder">
											<h1 class="f-promo-box-heading">PAYMENT 100% SECURE</h1>
											<p>Payment 100% secure</p>
										</div>
									</div>
									<!-- F Widget Item of the Page end -->
								</div>
							</div>
						</div>
					</aside>

					{{-- Banner Part Start --}}
					<div class="banner-frame nospace wow fadeInUp" data-wow-delay="0.4s">
						@php
							$banner = App\EcommerceOffer::where('size', '400 X 210')->with('product')->get();
						@endphp
						@if (count($banner) > 0)
							@foreach ($banner as $item)
								<div class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
									<img src="{{$item->image && $item->image != '' ? asset('storage/offer/'. $item->image) : 'http://placehold.it/765x580'}}" alt="image description">
									<div class="holder">
										<h2><span>{{$item->product->category->name}}</span><strong>{{$item->heading}}</strong></h2>
										<a class="btn-shop" href="{{route('offer',$item->uuid)}}">
											<span>SHOP NOW</span>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</div>
								<div class="banner-9">
									<img alt="image description" src="{{$item->image && $item->image != '' ? asset('storage/offer/'. $item->image) : 'http://placehold.it/400X210'}}">
									<div class="holder">
										<h2><span>{{$item->product->category->name}}</span><strong>{{$item->heading}}</strong></h2>
										<a href="{{route('offer',$item->uuid)}}" class="btn-shop">
											<span>VIEW</span>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</div>
							@endforeach
						@else 
							<div class="banner-9">
								<img alt="image description" src="http://placehold.it/400x210">
								<div class="holder">
									<h2><span>No Offer Found</span><strong>Add 400 X 210 Size Offer for show</strong></h2>
									{{-- <a href="product-detail.html" class="btn-shop">
										<span>VIEW</span>
										<i class="fa fa-angle-right"></i>
									</a> --}}
								</div>
							</div>
							<div class="banner-9">
								<img alt="image description" src="http://placehold.it/400x210">
								<div class="holder">
									<h2><span>No Offer Found</span><strong>Add 400 X 210 Size Offer for show</strong></h2>
									{{-- <a href="product-detail.html" class="btn-shop">
										<span>VIEW</span>
										<i class="fa fa-angle-right"></i>
									</a> --}}
								</div>
							</div>
							<div class="banner-9">
								<img alt="image description" src="http://placehold.it/400x210">
								<div class="holder">
									<h2><span>No Offer Found</span><strong>Add 400 X 210 Size Offer for show</strong></h2>
									{{-- <a href="product-detail.html" class="btn-shop">
										<span>VIEW</span>
										<i class="fa fa-angle-right"></i>
									</a> --}}
								</div>
							</div>
						@endif
						
					</div>
					{{-- Banner Part End --}}

					<!-- mt producttabs style5 start here -->
					<div class="mt-producttabs style5 wow fadeInUp" data-wow-delay="0.4s">
						<!-- producttabs start here -->
						<ul class="producttabs">
							<li><a href="#tab1" class="active">FEATURED</a></li>
							<li><a href="#tab2">LATEST</a></li>
							<li><a href="#tab3">BEST SELLER</a></li>
						</ul>
						<!-- producttabs end here -->
						<div class="tab-content row">

							{{-- Feature Product --}}
							<div id="tab1">
								<div class="tabs-sliderlg">
									<div class="related-products wow fadeInUp" data-wow-delay="0.4s">
										<div class="container">
											<div class="row">
												<div class="col-xs-12">
													@foreach ($featur_product as $item)
														@include('eCommerce.product')
													@endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							{{-- Latest Product List --}}
							<div id="tab2">
								<div class="tabs-sliderlg">
									<div class="related-products wow fadeInUp" data-wow-delay="0.4s">
										<div class="container">
											<div class="row">
												<div class="col-xs-12">
													@foreach ($latest_product as $item)
														@include('eCommerce.product')
													@endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							{{-- Best Selling Product --}}
							<div id="tab3">
								
							</div>

						</div>
					</div><!-- mt producttabs end here -->

				
					{{-- Banner Part Start Here --}}
					<div class="banner-frame wow fadeInUp" data-wow-delay="0.4s">
						@php
							$banner = App\EcommerceOffer::where('size', '590 X 250')->with('product')->get();
						@endphp
						@if (count($banner) > 0)
							@foreach ($banner as $item)
								<div class="banner-15 right">
									<img src="{{$item->image && $item->image != '' ? asset('storage/offer/'. $item->image) : 'http://placehold.it/590X250'}} alt="image description">
									<div class="holder">
										<h2>{{$item->product->category->name}}<strong>{{$item->heading}}</strong></h2>
										<a class="btn-shop" href="{{route('offer',$item->uuid)}}">
											<span>SHOP NOW</span>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</div>
								<div class="banner-9">
									<img alt="image description" src="{{$item->image && $item->image != '' ? asset('storage/offer/'. $item->image) : 'http://placehold.it/400X210'}}">
									<div class="holder">
										<h2><span>{{$item->product->category->name}}</span><strong>{{$item->heading}}</strong></h2>
										<a href="{{route('offer',$item->uuid)}}" class="btn-shop">
											<span>VIEW</span>
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</div>
							@endforeach
						@else 
							<div class="banner-15 right">
								<img src="http://placehold.it/590x250" alt="image description">
								<div class="holder">
									<h2>No Offer Found <strong>Add 590 X 250 Size Offer for Size</strong></h2>
									{{-- <a class="btn-shop" href="#">
										<span>SHOP NOW</span>
										<i class="fa fa-angle-right"></i>
									</a> --}}
								</div>
							</div>
							<div class="banner-15 right">
								<img src="http://placehold.it/590x250" alt="image description">
								<div class="holder">
									<h2>No Offer Found <strong>Add 590 X 250 Size Offer for Size</strong></h2>
									{{-- <a class="btn-shop" href="#">
										<span>SHOP NOW</span>
										<i class="fa fa-angle-right"></i>
									</a> --}}
								</div>
							</div>
						@endif
					</div>
					{{-- Banner Part End Here --}}

					<div class="mt-smallproducts mt-nopaddingtopxs wow fadeInUp" data-wow-delay="0.4s">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<h3 class="heading">Hot Sale</h3>
								
								@foreach ($hot_sale as $hot_sale_item)
									@php
										$find_price =  App\models\Production\Variation::where('product_id', $item->id)->get();
										if(count($find_price) > 0) {
											$total_product_variation = count($find_price);
											$price = 0;
											foreach($find_price as $row) {
												$default_price = $row['default_sell_price'];
												$price = $price + $default_price;
											}
									
											$per_product_price = round($price / $total_product_variation) ;
											
										}
									@endphp
									<div class="mt-product4 mt-paddingbottom20">
										<div class="img">
											<a href="{{route('product-details',$hot_sale_item->id)}}"><img src="{{isset($hot_sale_item->photo)?asset('storage/product/'.$hot_sale_item->photo):''}}"></a>
										</div>
										<div class="text">
											<div class="frame">
												<strong><a href="{{route('product-details',$hot_sale_item->id)}}">{{$hot_sale_item->name}}</a></strong>
												<ul class="ratting-area">
													<li class="list-group-item count_rating" data-score={{$hot_sale_item->avarage_retting}}>
												</li>
											</ul>
											</div>
											{{-- <del class="off">$75,00</del> --}}
											<span class="price">৳ {{$per_product_price}}</span>
										</div>
									</div>
								@endforeach	
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<h3 class="heading">Featured Products</h3>
								@foreach ($footer_featur_product as $footer_item)
									@php
										$find_price =  App\models\Production\Variation::where('product_id', $item->id)->get();
										if(count($find_price) > 0) {
											$total_product_variation = count($find_price);
											$price = 0;
											foreach($find_price as $row) {
												$default_price = $row['default_sell_price'];
												$price = $price + $default_price;
											}
									
											$per_product_price = round($price / $total_product_variation) ;
											
										}
									@endphp
									<div class="mt-product4 mt-paddingbottom20">
										<div class="img">
											<a href="{{route('product-details',$footer_item->id)}}"><img src="{{isset($footer_item->photo)?asset('storage/product/'.$footer_item->photo):''}}"></a>
										</div>
										<div class="text">
											<div class="frame">
												<strong><a href="{{route('product-details',$footer_item->id)}}">{{$footer_item->name}}</a></strong>
												<ul class="ratting-area">
													<li class="list-group-item count_rating" data-score={{$footer_item->avarage_retting}}>
												</li>
											</ul>
											</div>
											{{-- <del class="off">$75,00</del> --}}
											<span class="price">৳ {{$per_product_price}}</span>
										</div>
									</div>
								@endforeach
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
								<h3 class="heading">Sale Products</h3>
								@foreach ($general_products as $item)
									@php
										$find_price =  App\models\Production\Variation::where('product_id', $item->id)->get();
										if(count($find_price) > 0) {
											$total_product_variation = count($find_price);
											$price = 0;
											foreach($find_price as $row) {
												$default_price = $row['default_sell_price'];
												$price = $price + $default_price;
											}
									
											$per_product_price = round($price / $total_product_variation) ;
											
										}
									@endphp
									<div class="mt-product4 mt-paddingbottom20">
										<div class="img">
											<a href="{{route('product-details',$item->id)}}"><img src="{{isset($item->photo)?asset('storage/product/'.$item->photo):''}}"></a>
										</div>
										<div class="text">
											<div class="frame">
												<strong><a href="{{route('product-details',$item->id)}}">{{$item->name}}</a></strong>
												<ul class="ratting-area">
													<li class="list-group-item count_rating" data-score={{$item->avarage_retting}}>
												</li>
											</ul>
											</div>
											{{-- <del class="off">$75,00</del> --}}
											<span class="price">৳ {{$per_product_price}}</span>
										</div>
									</div>
								@endforeach
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<h3 class="heading">Top Rated Products</h3>
								<!-- mt product4 start here -->
								@foreach ($products as $item)
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="{{route('product-details',$item->id)}}"><img src="{{$item->photo?asset('storage/product/'.$item->photo):'http://placehold.it/80x80'}}" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="{{route('product-details',$item->id)}}">{{$item->name}}</a></strong>
										<ul class="ratting-area">
                                            <li class="list-group-item count_rating" data-score={{$item->avarage_retting}}>
                                            </li>
                                        </ul>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<!-- footer of the Page -->
@endpush
@push('scripts')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('frontend/js/jquery.raty.js')}}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e6f1c98ea2e3519"></script>
<script>
    $('.count_rating').raty({
        score: function () {
            return $(this).attr('data-score');
		}, //default score
		starHalf: '{{asset("frontend/images/star-half.png")}}',
        starOn: '{{asset("frontend/images/star-on.png")}}',
        starOff: '{{asset("frontend/images/star-off.png")}}',
		readOnly: true,
		halfShow: true //read only
    });

	$(document).on('click', '.heart', function() {
		var id = $(this).data('id');
		var ip = '{{getIp()}}';
		var url = $(this).data('url');
		
		$(this).html('<i class="fa fa-heart" aria-hidden="true"></i>');
		
		$.ajax({
            type: 'GET',
            url: url,
            data: {
                id: id, ip: ip
            },
			beforeSend: function() {
                $(this).html(' <i class="fa fa-spinner fa-spin fa-fw"></i>');
            }, 
            success: function (data) {
                if(data.status == 'success') {
                    toastr.success(data.message);
                }
				if(data.status == 'warning') {
                    toastr.warning(data.message);
                }
            }
        });
	})
</script>

<script>
	@if(Session::get('error'))
	toastr.warning('{{Session::get('error')}}');
	@endif
</script>
@endpush

	