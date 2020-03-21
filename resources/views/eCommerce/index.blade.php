@extends('eCommerce.layouts.app')         
	@push('main')
	<!-- mt main start here -->
	<main id="mt-main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!-- banner frame start here -->
					<div class="banner-frame mt-paddingsmzero wow fadeInUp" data-wow-delay="0.4s">

						<!-- slider 7 start here -->
						<div class="slider-7 mt-paddingbottomsm wow fadeInLeft" data-wow-delay="0.4s">
							<!-- slider start here -->
							<div class="slider banner-slider">
								@foreach ($slider as $slider_item)
								<!-- holder star here -->
								<div class="s-holder">
									<img src="{{$slider_item->slider_image?asset('storage/eCommerce/slider/'.$slider_item->slider_image):'http://placehold.it/765x580'}}" alt="Slider Image">
									<div class="s-box">
										<strong class="s-title">{{$slider_item->title}}</strong>
										<span class="heading add">{{$slider_item->title_heading}}</span>
										<div class="s-txt">
											<p>{{$slider_item->short_description}}</p>
										</div>
										<a href="{{route('product-details',$slider_item->product_id)}}" class="s-shop">SHOP NOW</a>
									</div>
								</div><!-- holder end here -->
								@endforeach
							</div>
						</div><!-- slider 7 end here -->


						<!-- banner box third start here -->
						<div class="banner-box third wow fadeInRight" data-wow-delay="0.4s">
							<!-- banner 12 right white start here -->
							@if (isset($banner_image_one))
							<div  class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
								<img src="{{asset('storage/eCommerce/home_page/'.$banner_image_one->banner_image_one)}}" alt="{{$banner_image_one->banner_image_one_alt}}">
								<div class="holder">
									<h2>{{$banner_image_one->product->name}}</h2>
									<a class="btn-shop" href="{{route('product-details',$banner_image_one->product_id)}}">
										<span>SHOP NOW</span>
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div><!-- banner 12 right white end here -->
							@endif
							<!-- banner 13 right start here -->
							@if (isset($banner_image_two))
							<div class="banner-13 right wow fadeInDown" data-wow-delay="0.4s">
								<img src="{{asset('storage/eCommerce/home_page/'.$banner_image_two->banner_image_two)}}" alt="{{$banner_image_two->banner_image_two_alt}}">
								<div class="holder">
									<h2>{{$banner_image_two->product->name}}</h2>
									<a class="btn-shop" href="{{route('product-details',$banner_image_two->product_id)}}">
										<span>SHOP NOW</span>
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div><!-- banner 13 right end here -->
							@endif
						</div><!-- banner box third end here -->
					</div><!-- banner frame end here -->
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
					<!-- F Promo Box of the Page end -->
					<!-- banner frame start here -->
					<div class="banner-frame nospace wow fadeInUp" data-wow-delay="0.4s">
						<!-- banner 9 start here -->
						@foreach ($banner_fream as $banner_fream_item)
						<div class="banner-9">
							<img alt="{{$banner_fream_item->banner_frame_one_alt}}" src="{{asset('storage/eCommerce/home_page/'.$banner_fream_item->banner_frame_one)}}">
							<div class="holder">
								<h2><strong>{{$banner_fream_item->product->name}}</strong></h2>
								<a href="{{route('product-details', $banner_fream_item->product_id)}}" class="btn-shop">
									<span>VIEW</span>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div><!-- banner 9 end here -->
						@endforeach
					</div><!-- banner frame end here -->
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
							<div id="tab1">
								<!-- tabs slider start here -->
								<div class="tabs-sliderlg">
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product2 start here -->
										<div class="mt-product2 large bg-grey">
											<!-- box start here -->
											<div class="box">
												<img alt="image description" src="http://placehold.it/275x290">
												<ul class="mt-stars">
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-eye"></i></a></li>
												</ul>
											</div><!-- box end here -->
											<!-- txt end here -->
											<div class="txt">
												<strong class="title">Bombi Chair</strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div><!-- txt end here -->
										</div><!-- mt product2 end here -->
									</div><!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product2 start here -->
										<div class="mt-product2 large bg-grey">
											<!-- box start here -->
											<div class="box">
												<img alt="image description" src="http://placehold.it/275x290">
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-eye"></i></a></li>
												</ul>
											</div><!-- box end here -->
											<!-- txt end here -->
											<div class="txt">
												<strong class="title">Marvelous Modern 3 Seater</strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div><!-- txt end here -->
										</div><!-- mt product2 end here -->
									</div><!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product2 start here -->
										<div class="mt-product2 large bg-grey">
											<!-- box start here -->
											<div class="box">
												<img alt="image description" src="http://placehold.it/275x290">
												<span class="caption">
													<span class="off">15% Off</span>
												</span>
												<ul class="mt-stars">
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-eye"></i></a></li>
												</ul>
											</div><!-- box end here -->
											<!-- txt end here -->
											<div class="txt">
												<strong class="title">Puff  Armchair</strong>
												<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
											</div><!-- txt end here -->
										</div><!-- mt product2 end here -->
									</div><!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product2 start here -->
										<div class="mt-product2 large bg-grey">
											<!-- box start here -->
											<div class="box">
												<img alt="image description" src="http://placehold.it/275x290">
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-eye"></i></a></li>
												</ul>
											</div><!-- box end here -->
											<!-- txt end here -->
											<div class="txt">
												<strong class="title">Bombi Chair</strong>
												<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
											</div><!-- txt end here -->
										</div><!-- mt product2 end here -->
									</div><!-- slide end here -->
									<!-- slide start here -->
									<div class="slide">
										<!-- mt product2 start here -->
										<div class="mt-product2 large bg-grey">
											<!-- box start here -->
											<div class="box">
												<img alt="image description" src="http://placehold.it/275x290">
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icon-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-eye"></i></a></li>
												</ul>
											</div><!-- box end here -->
											<!-- txt end here -->
											<div class="txt">
												<strong class="title">Marvelous Modern 3 Seater</strong>
												<span class="price"><i class="fa fa-eur"></i> <span>599,00</span></span>
											</div><!-- txt end here -->
										</div><!-- mt product2 end here -->
									</div>
								</div>
								<!-- tabs slider end here -->
							</div>
						</div>
					</div><!-- mt producttabs end here -->

					<!-- mt producttabs style6 start here -->
					<div class="mt-producttabs style6 wow fadeInUp" data-wow-delay="0.4s">
						<div class="mt-heading2">
							<h2 class="head">WOODEN CHAIRS</h2>
							<p>FURNITURE DESIGNS IDEAS</p>
						</div>
						<!-- tabs slider start here -->
						<div class="tabs-slider row">
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<span class="caption">
													<span class="new">new</span>
												</span>
												<ul class="mt-stars">
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Puff Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>287,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<span class="caption">
													<span class="off">15% Off</span>
													<span class="new">new</span>
												</span>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<ul class="links add">
													<li><a href="#"><i class="icon-handbag"></i></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>399,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Wood Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>198,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
							<!-- slide start here -->
							<div class="slide">
								<!-- mt product1  start here -->
								<div class="mt-product1">
									<div class="box">
										<div class="b1">
											<div class="b2">
												<a href="product-detail.html"><img src="http://placehold.it/215x215" alt="image description"></a>
												<span class="caption">
													<span class="off">15% Off</span>
													<span class="new">new</span>
												</span>
												<ul class="links">
													<li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a></li>
													<li><a href="#"><i class="icomoon icon-heart-empty"></i></a></li>
													<li><a href="#"><i class="icomoon icon-exchange"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="txt">
										<strong class="title"><a href="product-detail.html">Bombi Chair</a></strong>
										<span class="price"><i class="fa fa-eur"></i> <span>200,00</span></span>
									</div>
								</div><!-- mt product1  end here -->
							</div><!-- slide end here -->
						</div>
						<!-- tabs slider end here -->
					</div><!-- mt producttabs style3 end here -->
					<!-- banner frame start here -->
					<div class="banner-frame wow fadeInUp" data-wow-delay="0.4s">
						<!-- banner 15 start here -->
						<div class="banner-15 right">
							<img src="http://placehold.it/590x250" alt="image description">
							<div class="holder">
								<h2>Chairs <strong>ZIO DINING CHAIR</strong></h2>
								<a class="btn-shop" href="#">
									<span>SHOP NOW</span>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div><!-- banner 15 end here -->
						<!-- banner 15 start here -->
						<div class="banner-15 right">
							<img src="http://placehold.it/590x250" alt="image description">
							<div class="holder">
								<h2>Accessories / Lighting <strong>TOTEM FLOOR LAMP</strong></h2>
								<a class="btn-shop" href="#">
									<span>SHOP NOW</span>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</div><!-- banner 15 end here -->
					</div><!-- banner frame end here -->
					<div class="mt-smallproducts mt-nopaddingtopxs wow fadeInUp" data-wow-delay="0.4s">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<h3 class="heading">Hot Sale</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Egon Wooden Chair</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Kurve Chair</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<h3 class="heading">Featured Products</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Bombi Chair</a></strong>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$33,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
										</div>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Puff Chair</a></strong>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
								<h3 class="heading">Sale Products</h3>
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Marvelous Wooden Chair</a></strong>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Oyo Cantilever Chair</a></strong>
											<ul class="mt-stars">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
								<!-- mt product4 start here -->
								<div class="mt-product4 mt-paddingbottom20">
									<div class="img">
										<a href="product-detail.html"><img src="http://placehold.it/80x80" alt="image description"></a>
									</div>
									<div class="text">
										<div class="frame">
											<strong><a href="product-detail.html">Kurve Chair</a></strong>
										</div>
										<del class="off">$75,00</del>
										<span class="price">$55,00</span>
									</div>
								</div><!-- mt product4 end here -->
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
                                            <li class="list-group-item count_rating"
                                                data-score={{$item->avarage_retting}}>

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
</script>

<script>
	@if(Session::get('error'))
	toastr.warning('{{Session::get('error')}}');
	@endif
</script>
@endpush

	