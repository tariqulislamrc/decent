@extends('eCommerce.layouts.app')         
@push('main')
<!-- mt main start here -->
    <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(http://placehold.it/1920x205);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <h1>CHAIRS</h1>
                        <!-- Breadcrumbs of the Page -->
                        <nav class="breadcrumbs">
                            <ul class="list-unstyled">
                                <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                                <li><a href="product-detail.html">Products <i class="fa fa-angle-right"></i></a></li>
                                <li>Chairs</li>
                            </ul>
                        </nav><!-- Breadcrumbs of the Page end -->
                    </div>
                </div>
            </div>
        </section><!-- Mt Contact Banner of the Page end -->
        <div class="container">
            <div class="row">
                <!-- sidebar of the Page start here -->
                <aside id="sidebar" class="col-xs-12 col-sm-4 col-md-3 wow fadeInLeft" data-wow-delay="0.4s">
                    <!-- shop-widget filter-widget of the Page start here -->
                    <section class="shop-widget filter-widget bg-grey">
                        <h2>FILTER</h2>
                        <span class="sub-title">Filter by Brands</span>
                        <!-- nice-form start here -->
                        <ul class="list-unstyled nice-form">
                            <li>
                                <label for="check-1">
                                    <input id="check-1" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Casali</span>
                                </label>
                                <span class="num">2</span>
                            </li>
                            <li>
                                <label for="check-2">
                                    <input id="check-2" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Decar</span>
                                </label>
                                <span class="num">12</span>
                            </li>
                            <li>
                                <label for="check-3">
                                    <input id="check-3" checked="checked" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Fantini</span>
                                </label>
                                <span class="num">4</span>
                            </li>
                            <li>
                                <label for="check-4">
                                    <input id="check-4" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Flamentstyle</span>
                                </label>
                                <span class="num">4</span>
                            </li>
                            <li>
                                <label for="check-5">
                                    <input id="check-5" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Heerenhuis</span>
                                </label>
                                <span class="num">6</span>
                            </li>
                            <li>
                                <label for="check-6">
                                    <input id="check-6" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Hoffmann</span>
                                </label>
                                <span class="num">10</span>
                            </li>
                            <li>
                                <label for="check-7">
                                    <input id="check-7" type="checkbox">
                                    <span class="fake-input"></span>
                                    <span class="fake-label">Italfloor</span>
                                </label>
                                <span class="num">3</span>
                            </li>
                        </ul><!-- nice-form end here -->
                        <span class="sub-title">Filter by Price</span>
                        <div class="price-range">
                            <div class="range-slider">
                                <span class="dot"></span>
                                <span class="dot dot2"></span>
                            </div>
                            <span class="price">Price &nbsp;   $ 10  &nbsp;  -  &nbsp;   $ 599</span>
                            <a href="#" class="filter-btn">Filter</a>
                        </div>
                    </section><!-- shop-widget filter-widget of the Page end here -->
                    <!-- shop-widget of the Page start here -->
                    <section class="shop-widget">
                        <h2>CATEGORIES</h2>
                        <!-- category list start here -->
                        <ul class="list-unstyled category-list">
                            <li>
                                <a href="#">
                                    <span class="name">CHAIRS</span>
                                    <span class="num">12</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="name">SOFAS</span>
                                    <span class="num">24</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="name">ARMCHAIRS</span>
                                    <span class="num">9</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="name">BEDROOM</span>
                                    <span class="num">2</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="name">LIGHTING</span>
                                    <span class="num">17</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="name">KITCHEN</span>
                                    <span class="num">10</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="name">ACCESSORIES</span>
                                    <span class="num">23</span>
                                </a>
                            </li>
                        </ul><!-- category list end here -->
                    </section><!-- shop-widget of the Page end here -->
                    <!-- shop-widget of the Page start here -->
                    <section class="shop-widget">
                        <h2>HOT SALE</h2>
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
                    </section><!-- shop-widget of the Page end here -->
                </aside><!-- sidebar of the Page end here -->
                <div class="col-xs-12 col-sm-8 col-md-9 wow fadeInRight" data-wow-delay="0.4s">
                    <!-- mt shoplist header start here -->
                    <header class="mt-shoplist-header">
                        <!-- btn-box start here -->
                        <div class="btn-box">
                            <ul class="list-inline">
                                <li>
                                    <a href="#" class="drop-link">
                                        Default Sorting <i aria-hidden="true" class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="drop">
                                        <ul class="list-unstyled">
                                            <li><a href="#">ASC</a></li>
                                            <li><a href="#">DSC</a></li>
                                            <li><a href="#">Price</a></li>
                                            <li><a href="#">Relevance</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="mt-viewswitcher" href="{{route('product')}}"><i class="fa fa-th-large" aria-hidden="true"></i></a></li>
                                <li><a class="mt-viewswitcher" href="{{route('product-list')}}"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
                            </ul>
                        </div><!-- btn-box end here -->
                        <!-- mt-textbox start here -->
                        <div class="mt-textbox">
                            <p>Showing  <strong>1–9</strong> of  <strong>65</strong> results</p>
                            <p>View   <a href="#">9</a> / <a href="#">18</a> / <a href="#">27</a> / <a href="#">All</a></p>
                        </div><!-- mt-textbox end here -->
                    </header><!-- mt shoplist header end here -->
                    <!-- product post start here -->
                    <div class="product-post">
                        <!-- img holder start here -->
                        <div class="img-holder">
                            <img src="http://placehold.it/225x275" alt="image description">
                        </div><!-- img holder end here -->
                        <!-- txt holder start here -->
                        <div class="txt-holder">
                            <!-- align left start here -->
                            <div class="align-left">
                                <strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
                                <span class="price"><i class="fa fa-eur"></i>  399,00</span>
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair.</p>
                            </div><!-- align left end here -->
                            <!-- align right start here -->
                            <div class="align-right">
                                <ul class="list-unstyled rating-list">
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li>Reviews (12)</li>
                                </ul>
                                <a href="#" class="btn-cart">ADD TO CART</a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                </ul>
                            </div><!-- align right end here -->
                        </div><!-- txt holder end here -->
                    </div><!-- product post end here -->
                    <!-- product post start here -->
                    <div class="product-post">
                        <!-- img holder start here -->
                        <div class="img-holder">
                            <img src="http://placehold.it/225x275" alt="image description">
                        </div><!-- img holder end here -->
                        <!-- txt holder start here -->
                        <div class="txt-holder">
                            <!-- align left start here -->
                            <div class="align-left">
                                <strong class="title"><a href="product-detail.html">Marvelous Modern 3 Seater</a></strong>
                                <span class="price"><i class="fa fa-eur"></i>  399,00</span>
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair.</p>
                            </div><!-- align left end here -->
                            <!-- align right start here -->
                            <div class="align-right">
                                <ul class="list-unstyled rating-list">
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li>Reviews (12)</li>
                                </ul>
                                <a href="#" class="btn-cart">ADD TO CART</a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                </ul>
                            </div><!-- align right end here -->
                        </div><!-- txt holder end here -->
                    </div><!-- product post end here -->
                    <!-- product post start here -->
                    <div class="product-post">
                        <!-- img holder start here -->
                        <div class="img-holder">
                            <img src="http://placehold.it/225x275" alt="image description">
                        </div><!-- img holder end here -->
                        <!-- txt holder start here -->
                        <div class="txt-holder">
                            <!-- align left start here -->
                            <div class="align-left">
                                <strong class="title"><a href="product-detail.html">Chair with armrests</a></strong>
                                <span class="price"><i class="fa fa-eur"></i>  200,00</span>
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair.</p>
                            </div><!-- align left end here -->
                            <!-- align right start here -->
                            <div class="align-right">
                                <ul class="list-unstyled rating-list">
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li>Reviews (12)</li>
                                </ul>
                                <a href="#" class="btn-cart">ADD TO CART</a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                </ul>
                            </div><!-- align right end here -->
                        </div><!-- txt holder end here -->
                    </div><!-- product post end here -->
                    <!-- product post start here -->
                    <div class="product-post">
                        <!-- img holder start here -->
                        <div class="img-holder">
                            <img src="http://placehold.it/225x275" alt="image description">
                        </div><!-- img holder end here -->
                        <!-- txt holder start here -->
                        <div class="txt-holder">
                            <!-- align left start here -->
                            <div class="align-left">
                                <strong class="title"><a href="product-detail.html">Pouf Chair</a></strong>
                                <span class="price"><i class="fa fa-eur"></i>  247,00</span>
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair.</p>
                            </div><!-- align left end here -->
                            <!-- align right start here -->
                            <div class="align-right">
                                <ul class="list-unstyled rating-list">
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li>Reviews (12)</li>
                                </ul>
                                <a href="#" class="btn-cart">ADD TO CART</a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                </ul>
                            </div><!-- align right end here -->
                        </div><!-- txt holder end here -->
                    </div><!-- product post end here -->
                    <!-- product post start here -->
                    <div class="product-post">
                        <!-- img holder start here -->
                        <div class="img-holder">
                            <img src="http://placehold.it/225x275" alt="image description">
                        </div><!-- img holder end here -->
                        <!-- txt holder start here -->
                        <div class="txt-holder">
                            <!-- align left start here -->
                            <div class="align-left">
                                <strong class="title"><a href="product-detail.html">Jalis Counter Stool</a></strong>
                                <span class="price"><i class="fa fa-eur"></i>  369,00</span>
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair.</p>
                            </div><!-- align left end here -->
                            <!-- align right start here -->
                            <div class="align-right">
                                <ul class="list-unstyled rating-list">
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li>Reviews (12)</li>
                                </ul>
                                <a href="#" class="btn-cart">ADD TO CART</a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                </ul>
                            </div><!-- align right end here -->
                        </div><!-- txt holder end here -->
                    </div><!-- product post end here -->
                    <!-- product post start here -->
                    <div class="product-post">
                        <!-- img holder start here -->
                        <div class="img-holder">
                            <img src="http://placehold.it/225x275" alt="image description">
                        </div><!-- img holder end here -->
                        <!-- txt holder start here -->
                        <div class="txt-holder">
                            <!-- align left start here -->
                            <div class="align-left">
                                <strong class="title"><a href="product-detail.html">Yard SeChair</a></strong>
                                <span class="price"><i class="fa fa-eur"></i>  139,00</span>
                                <p>Koila is a chair designed for restaurants and food lovers in general. Designed in collaboration with restaurant professionals, it ensures comfort and an ideal posture, as there are armrests on both sides of the chair.</p>
                            </div><!-- align left end here -->
                            <!-- align right start here -->
                            <div class="align-right">
                                <ul class="list-unstyled rating-list">
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li class="active"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star-o"></i></a></li>
                                    <li>Reviews (12)</li>
                                </ul>
                                <a href="#" class="btn-cart">ADD TO CART</a>
                                <ul class="list-unstyled nav">
                                    <li><a href="#"><i class="fa fa-heart"></i> ADD TO WISHLIST</a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i> COMPARE</a></li>
                                </ul>
                            </div><!-- align right end here -->
                        </div><!-- txt holder end here -->
                    </div><!-- product post end here -->
                    <!-- mt pagination start here -->
                    <nav class="mt-pagination">
                        <ul class="list-inline">
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                        </ul>
                    </nav><!-- mt pagination end here -->
                </div>
            </div>
        </div>
    </main><!-- mt main end here -->
@endpush