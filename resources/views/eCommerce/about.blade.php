@extends('eCommerce.layouts.app')         
	@push('main')
	  <!-- Main of the Page -->
      <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{$model->header_image?asset('storage/eCommerce/about/'.$model->header_image):'http://placehold.it/1920x205'}});">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 text-center">
                <h1>ABOUT US</h1>
                <nav class="breadcrumbs">
                  <ul class="list-unstyled">
                    <li><a href="index.html">home <i class="fa fa-angle-right"></i></a></li>
                    <li>About Us</li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Content Banner of the Page end -->
        <!-- Mt About Section of the Page -->
        <section class="mt-about-sec wow fadeInUp" data-wow-delay="0.4s">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <div class="txt">
                  <h2>{{$model->name}}</h2>
                  <p>{!!$model->description!!}</p>
                </div>
                <div class="mt-follow-holder">
                  <span class="title">Follow Us</span>
                  <!-- Social Network of the Page -->
                  <ul class="list-unstyled social-network">
                    <li><a target="_blank" href="{{get_option('twiter')}}"><i class="fa fa-twitter"></i></a></li>
                    <li><a target="_blank" href="{{get_option('fb')}}"><i class="fa fa-facebook"></i></a></li>
                    <li><a target="_blank" href="{{get_option('youtube')}}"><i class="fa fa-youtube"></i></a></li>
                    <li><a target="_blank" href="{{get_option('linkedin')}}"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
                  <!-- Social Network of the Page end -->
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt About Section of the Page -->
        <!-- Mt Team Section of the Page -->
        <section class="mt-team-sec">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <h3>OUR TEAM</h3>
                <div class="holder">
                  <!-- col of the Page -->
                  <div class="col wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="img-holder">
                      <a href="#">
                        <img src="http://placehold.it/280x290" alt="CLARA WOODEN">
                        <ul class="list-unstyled social-icon">
                          <li><i class="fa fa-twitter"></i></li>
                          <li><i class="fa fa-facebook"></i></li>
                          <li><i class="fa fa-linkedin"></i></li>
                        </ul>
                      </a>
                    </div>
                    <div class="mt-txt">
                      <h4><a href="#">CLARA WOODEN</a></h4>
                      <span class="sub-title">DESIGNER</span>
                    </div>
                  </div>
                  <!-- col of the Page end -->
                  <!-- col of the Page -->
                  <div class="col wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="img-holder">
                      <a href="#">
                        <img src="http://placehold.it/280x290" alt="JOHN WICK">
                        <ul class="list-unstyled social-icon">
                          <li><i class="fa fa-twitter"></i></li>
                          <li><i class="fa fa-facebook"></i></li>
                          <li><i class="fa fa-linkedin"></i></li>
                        </ul>
                      </a>
                    </div>
                    <div class="mt-txt">
                      <h4><a href="#">JOHN WICK</a></h4>
                      <span class="sub-title">FOUNDER</span>
                    </div>
                  </div>
                  <!-- col of the Page end -->
                  <!-- col of the Page -->
                  <div class="col wow fadeInRight" data-wow-delay="0.4s">
                    <div class="img-holder">
                      <a href="#">
                        <img src="http://placehold.it/280x290" alt="HARRY KANE">
                        <ul class="list-unstyled social-icon">
                          <li><i class="fa fa-twitter"></i></li>
                          <li><i class="fa fa-facebook"></i></li>
                          <li><i class="fa fa-linkedin"></i></li>
                        </ul>
                      </a>
                    </div>
                    <div class="mt-txt">
                      <h4><a href="#">HARRY KANE</a></h4>
                      <span class="sub-title">DESIGNER</span>
                    </div>
                  </div>
                  <!-- col of the Page end -->
                  <!-- col of the Page -->
                  <div class="col wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="img-holder">
                      <a href="#">
                        <img src="http://placehold.it/280x290" alt="CLARA WOODEN">
                      </a>
                    </div>
                  </div>
                  <!-- col of the Page end -->
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt About Section of the Page -->
        <!-- Mt Workspace Section of the Page -->
        <section class="mt-workspace-sec wow fadeInUp" data-wow-delay="0.4s">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <h2>OUR WORKSPACE</h2>
              </div>
            </div>
          </div>
          <!-- Work Slider of the Page -->
          <ul class="list-unstyled work-slider">
            <li>
              <div class="img-holder">
                <img src="http://placehold.it/545x545" alt="image description">
              </div>
              <div class="img-holder">
                <div class="coll1">
                  <img src="http://placehold.it/245x310" alt="image description">
                </div>
                <div class="coll2">
                  <img src="http://placehold.it/385x310" alt="image description">
                </div>
                <div class="coll3">
                  <img src="http://placehold.it/640x220" alt="image description">
                </div>
              </div>
            </li>
            <li>
              <div class="img-holder">
                <img src="http://placehold.it/545x545" alt="image description">
              </div>
              <div class="img-holder">
                <div class="coll1">
                  <img src="http://placehold.it/245x310" alt="image description">
                </div>
                <div class="coll2">
                  <img src="http://placehold.it/385x310" alt="image description">
                </div>
                <div class="coll3">
                  <img src="http://placehold.it/640x220" alt="image description">
                </div>
              </div>
            </li>
            <li>
              <div class="img-holder">
                <img src="http://placehold.it/545x545" alt="image description">
              </div>
              <div class="img-holder">
                <div class="coll1">
                  <img src="http://placehold.it/245x310" alt="image description">
                </div>
                <div class="coll2">
                  <img src="http://placehold.it/385x310" alt="image description">
                </div>
                <div class="coll3">
                  <img src="http://placehold.it/640x220" alt="image description">
                </div>
              </div>
            </li>
          </ul>
          <!-- Work Slider of the Page end -->
        </section>
        <!-- Mt Workspace Section of the Page -->
      </main><!-- Main of the Page end -->
	<!-- footer of the Page -->
@endpush