@extends('eCommerce.layouts.app')
	@push('main')
		<main id="mt-main">
			<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{isset($banner)?asset('storage/page/'.$banner->image):'http://placehold.it/1920x325'}});">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 text-center">
                            <h1>Special Offer - {{ $offer->name }}</h1>
                            <nav class="breadcrumbs">
                                <ul class="list-unstyled">
                                    <li><a href="{{url('/')}}">Home <i class="fa fa-angle-right"></i></a></li>
                                    <li>Special Offer <i class="fa fa-angle-right"></i></li>
                                </ul>
                            </nav>
						</div>
					</div>
				</div>
			</section>

            <div class="container">
				<div class="row">
					<aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
						<section class="shop-widget">
							<h2>CATEGORIES</h2>
							<ul class="list-unstyled category-list">
								@foreach ($category as $item)
									<li>
										<a href="{{route('category-product',$item->category_slug)}}">
											<span class="name">{{$item->name}}</span>
										    <span class="num">{{count($item->product)}}</span>
										</a>
									</li>
								@endforeach
							</ul>
					    </section>

						<section class="shop-widget">
							<h2>HOT SALE</h2>
                            @php
                                $hot_sale   = App\models\Production\Product::where('hot_sale_status','1')->orderBy('id','desc')->take(4)->get();
                            @endphp
                            @if(count($hot_sale) > 0)
                                @foreach ($hot_sale as $hot_sale_item)
                                @php
                                    $find_price =  App\models\Production\Variation::where('product_id', $hot_sale_item->id)->get();
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
                                        <a href="{{route('product-details',$hot_sale_item->id)}}">
                                            <img src="{{isset($hot_sale_item->photo) && $hot_sale_item->photo != null ?asset('storage/product/'.$hot_sale_item->photo): asset('img/product.jpg')}}">
                                        </a>
                                    </div>
                                    <div class="text">
                                        <div class="frame">
                                            <strong><a href="{{route('product-details',$hot_sale_item->id)}}">{{$hot_sale_item->name}}</a></strong>
                                            <ul class="mt-stars">
                                                <li class="list-group-item count_rating" data-score={{$hot_sale_item->avarage_retting}}>
                                            </ul>
                                        </div>
                                        <span class="price">৳ {{$per_product_price}} </span>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <p style="margin: 0 0 9.5px;
                                padding: 10px;
                                font-size: 20px;
                                background-color: #ddd;
                                color: red;
                                text-align: center;">Sorry. No Hot Sale Product Found At This Moment.</p>
                            @endif
						</section>
					</aside>

                    <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
						@if (count($items) > 0)
							<ul class="mt-productlisthold list-inline">
								@foreach ($items as $item)
                                @php
                                    $product = App\models\Production\Product::where('id', $item->product_id)->firstOrFail();
                                    $variation = App\models\Production\Variation::where('id', $item->variation_id)->firstOrFail();
                                @endphp
								<li>

                                <div class="mt-product1 large">
									<div class="box">
										<div class="b1">
											<div class="b2">

                                                <a href="{{route('offer-product',$product->product_slug)}}"> <img src="{{$product->photo && $product->photo != '' ?asset('storage/product/'.$product->photo): asset('img/product.jpg') }}" alt="image description"> </a>

                                                <span class="caption">
                                                    <span class="off">
                                                    @if ($item->discount_type == 'Percentages')

                                                    @else

                                                        {{ get_option('currency') }}

                                                    @endif
                                                    {{ $item->discount_amount }}{{ $item->discount_type == 'Percentages' ? '%' : ''}} Off</span>
                                                </span>
                                                <form action="{{route('shopping-cart-add')}}" method="post" id="content_form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$product->id}}">
                                                    <input type="hidden" name="name" value="{{$product->name}}">
                                                    <input type="hidden" name="variation" value="{{ $variation->id }}">
                                                    <input type="hidden" name="price" value="{{ $item->price_with_dis }}" id="product_price">
                                                    <input type="hidden"  name="qty" value="1" id="qty">
                                                    <ul class="links">
                                                        <li>
                                                            <button type="submit"><i class="icon-handbag"></i><span>Add to Cart</span></button>
                                                        </li>
                                                    </ul>
                                                </form>

											</div>
										</div>
									</div>
                                    <div class="txt">

                                        <strong class="title"><a href="{{route('offer-product',$product->product_slug)}}">{{$product->name}} | {{$variation->name}}</a></strong>
                                        <span class="price">৳<span>{{ number_format($item->price_with_dis, 2) }}</span></span>

                                    </div>
								</div>
							</li>
							@endforeach
						</ul>
					@endif
				</div>
			</div>
		</div>
	</main>
@endpush
@push('scripts')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('backend/js/parsley.min.js')}}"></script>
<script src="{{asset('js/eCommerce/offer_product.js')}}"></script>
@endpush
