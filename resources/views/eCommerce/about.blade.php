@extends('eCommerce.layouts.app')

@if ($model != null)
  @push('seo_section')
      <meta name="description" content="{{ isset($model->meta_description) && $model->meta_description != '' ? $model->meta_description:''}}">
      <meta name="keywords" content="{{ isset($model->meta_keyword) && $model->meta_keyword ?$model->meta_keyword:''}}">
      <meta name="title" content="{{ asset($model->seo_title) && $model->seo_title != '' ? $model->seo_title : ''}}">         
  @endpush  
@endif
    
	@push('main')
	  <!-- Main of the Page -->
      <main id="mt-main">
        <!-- Mt Content Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url({{isset($model->header_image)?asset('storage/eCommerce/about/'.$model->header_image):'http://placehold.it/1920x205'}});">
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
                  <h2>{{ isset($model) && $model != null ? $model->name : 'About Us Page'}}</h2>
                  <p>{!! isset($model) && $model != null ? $model->description : '' !!}</p>
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
                  @if (isset($our_team))
                  @foreach ($our_team as $our_team_item)
                  <!-- col of the Page -->
                  <div class="col wow fadeInLeft" data-wow-delay="0.4s">
                    <div class="img-holder">
                      <a href="#">
                        <img src="{{asset('storage/eCommerce/about/'.$our_team_item->image_one)}}" alt="{{$our_team_item->image_one_alt}}">
                        <ul class="list-unstyled social-icon">
                          <li><i class="fa fa-twitter"></i></li>
                          <li> <i class="fa fa-facebook"></i></li>
                          <li><i class="fa fa-linkedin"></i></li>
                        </ul>
                      </a>
                    </div>
                    <div class="mt-txt">
                      <h4><a href="#">{{$our_team_item->team_name}}</a></h4>
                      <span class="sub-title">{{$our_team_item->team_designation}}</span>
                    </div>
                  </div>
                  <!-- col of the Page end -->
                   @endforeach
                @else 
                  <p class="text-danger text-center">No Team Information Available</p>
                @endif
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
           @if (count($our_workspace) > 0)
            @foreach ($our_workspace as $our_workspace_item)
            <li>
              <div class="img-holder">
                <img src="{{$our_workspace_item->image_one?asset('storage/eCommerce/about/'.$our_workspace_item->image_one):'http://placehold.it/545x545'}}" alt="image description">
              </div>
              <div class="img-holder">
                <div class="coll1">
                  <img src="{{$our_workspace_item->image_two?asset('storage/eCommerce/about/'.$our_workspace_item->image_two):'http://placehold.it/545x545'}}" alt="image description">
                </div>
                <div class="coll2">
                   <img src="{{$our_workspace_item->image_three?asset('storage/eCommerce/about/'.$our_workspace_item->image_three):'http://placehold.it/545x545'}}" alt="image description">
                </div>
                <div class="coll3">
                   <img src="{{$our_workspace_item->image_four?asset('storage/eCommerce/about/'.$our_workspace_item->image_four):'http://placehold.it/545x545'}}" alt="image description">
                </div>
              </div>
            </li>            
            @endforeach
            @else 
                  <li class="text-danger text-center">No Workspace Information Available</li>
          @endif
          </ul>
          <!-- Work Slider of the Page end -->
        </section>
        <!-- Mt Workspace Section of the Page -->
      </main><!-- Main of the Page end -->
	<!-- footer of the Page -->
@endpush