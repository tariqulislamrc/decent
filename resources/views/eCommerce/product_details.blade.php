@extends('eCommerce.layouts.app')
@push('admin.css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('seo_section')
<meta name="title" content="{{$model->seo_title}}">
<meta name="keyword" content="{{$model->keyword}}">
<meta name="description" content="{{$model->meta_description}}">

@endpush
@push('main')
<!-- mt main start here -->
<main id="mt-main">
    <!-- Mt Product Detial of the Page -->
    <section class="mt-product-detial wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- Slider of the Page -->
                    <div class="slider">
                        <!-- Comment List of the Page -->
                        <ul class="list-unstyled comment-list">
                            <li><a href="#"><i class="fa fa-heart"></i>27</a></li>
                            <li><a href="#"><i class="fa fa-comments"></i>12</a></li>
                            <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                        </ul>
                        <!-- Comment List of the Page end -->
                        <!-- Product Slider of the Page -->
                        <div class="product-slider">
                            @foreach ($model->photo_details as $item)
                            <div class="slide">
                                <img src="{{$item->photo?asset('storage/product/'.$item->photo):'http://placehold.it/610x490'}}"
                                    alt="image descrption">
                            </div>
                            @endforeach
                        </div>
                        <!-- Product Slider of the Page end -->
                        <!-- Pagg Slider of the Page -->
                        <ul class="list-unstyled slick-slider pagg-slider">
                            @foreach ($model->photo_details as $item)
                            <li>
                                <div class="img"><img
                                        src="{{$item->photo?asset('storage/product/'.$item->photo):'http://placehold.it/105x105'}}"
                                        alt="image description"></div>
                            </li>
                            @endforeach
                        </ul>
                        <!-- Pagg Slider of the Page end -->
                    </div>
                    <!-- Slider of the Page end -->
                    <!-- Detail Holder of the Page -->
					<form action="{{route('shopping-cart-add')}}" method="post" id="content_form">
						@csrf
                        <input type="hidden" name="id" value="{{$model->id}}">
                        <input type="hidden" name="name" value="{{$model->name}}">
                        <div class="detial-holder">
                            <!-- Breadcrumbs of the Page -->
                            <ul class="list-unstyled breadcrumbs">
                                <li><a href="#">Chairs <i class="fa fa-angle-right"></i></a></li>
                                <li>Products</li>
                            </ul>
                            <!-- Breadcrumbs of the Page end -->
                            <h2 class="text-uppercase">{{$model->name}}</h2>
                            <!-- Rank Rating of the Page -->
                            <div class="rank-rating">
                                <ul class="list-unstyled rating-list">
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                </ul>
                                <span class="total-price">Reviews (12)</span>
                            </div>
                            <!-- Rank Rating of the Page end -->
                            <ul class="list-unstyled list">
                                <li><a href="#"><i class="fa fa-share-alt"></i>SHARE</a></li>
                                <li><a href="#"><i class="fa fa-exchange"></i>COMPARE</a></li>
                                <li><a href="#"><i class="fa fa-heart"></i>ADD TO WISHLIST</a></li>
                            </ul>
                            <div class="txt-wrap">
                                {{$model->short_description}}
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-4">Choose Variation</label>
                                <div class="col-md-8">
                                    <select name="variation" required class="form-control select"
                                        data-placeholder="Select Variation" id="get_price"
                                        data-url='{{route('get-price')}}'>
                                        <option value="">Select Variation</option>
                                        @foreach ($model->variation as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-holder row">
                                <input type="hidden" name="price" value="" id="product_price">
                                <div class="col-md-6"><span class="price" id="price"></span></div>
                                <div class="col-md-6 text-muted" id="qty"></div>

                            </div>
                            <!-- Product Form of the Page -->

                            <div class="product-form">
                                <fieldset>
                                    <div class="row-val">
                                        <label for="qty">qty</label>
                                        <input type="number" name="qty" required id="qty" placeholder="1">
                                    </div>
                                    <div class="row-val">
                                        <button type="submit">ADD TO CART</button>
                                    </div>
                                </fieldset>
                            </div>
                            <!-- Product Form of the Page end -->
                        </div>
                    </form>
                    <!-- Detail Holder of the Page end -->
                </div>
            </div>
        </div>
    </section><!-- Mt Product Detial of the Page end -->
    <div class="product-detail-tab wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="mt-tabs text-center text-uppercase">
                        <li><a href="#tab1" class="active">DESCRIPTION</a></li>
                        <li><a href="#tab2">INFORMATION</a></li>
                        <li><a href="#tab3">REVIEWS (12)</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab1">
                            {!!$model->product_description!!}
                        </div>
                        <div id="tab2">
                            {{$model->information}}
                        </div>
                        <div id="tab3">
                            <div class="product-comment">
                                <div class="mt-box">
                                    <div class="mt-hold">
                                        <ul class="mt-star">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <span class="name">John Wick</span>
                                        <time datetime="2016-01-01">09:10 Nov, 19 2016</time>
                                    </div>
                                    <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur.
                                        Excepteur sint occaecat cupidatat non</p>
                                </div>
                                <div class="mt-box">
                                    <div class="mt-hold">
                                        <ul class="mt-star">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <span class="name">John Wick</span>
                                        <time datetime="2016-01-01">09:10 Nov, 19 2016</time>
                                    </div>
                                    <p>Usmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum
                                        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>
                                </div>
                                <form action="#" class="p-commentform">
                                    <fieldset>
                                        <h2>Add Comment</h2>
                                        <div class="mt-row">
                                            <label>Rating</label>
                                            <ul class="mt-star">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                        </div>
                                        <div class="mt-row">
                                            <label>Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="mt-row">
                                            <label>E-Mail</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="mt-row">
                                            <label>Review</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                        <button type="submit" class="btn-type4">ADD REVIEW</button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- related products start here -->
    <div class="related-products wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h2>RELATED PRODUCTS</h2>
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="http://placehold.it/215x215"
                                                    alt="image description"></a>
                                            <span class="caption">
                                                <span class="new">NEW</span>
                                            </span>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a>
                                                </li>
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
                            </div><!-- mt product1 center end here -->
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="http://placehold.it/215x215"
                                                    alt="image description"></a>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a>
                                                </li>
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
                            </div><!-- mt product1 center end here -->
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="http://placehold.it/215x215"
                                                    alt="image description"></a>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a>
                                                </li>
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
                            </div><!-- mt product1 center end here -->
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="http://placehold.it/215x215"
                                                    alt="image description"></a>
                                            <span class="caption">
                                                <span class="off">15% Off</span>
                                                <span class="new">NEW</span>
                                            </span>
                                            <ul class="mt-stars">
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star-o"></i></li>
                                            </ul>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a>
                                                </li>
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
                            </div><!-- mt product1 center end here -->
                            <!-- mt product1 center start here -->
                            <div class="mt-product1 mt-paddingbottom20">
                                <div class="box">
                                    <div class="b1">
                                        <div class="b2">
                                            <a href="product-detail.html"><img src="http://placehold.it/215x215"
                                                    alt="image description"></a>
                                            <ul class="links">
                                                <li><a href="#"><i class="icon-handbag"></i><span>Add to Cart</span></a>
                                                </li>
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
                            </div><!-- mt product1 center end here -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- related products end here -->
    </div>
</main><!-- mt main end here -->
<!-- footer of the Page -->
@endpush
@push('scripts')
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('backend/js/parsley.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ asset('js/eCommerce/product_details.js') }}"></script>
<script>
	_formValidation();
</script>

@endpush
