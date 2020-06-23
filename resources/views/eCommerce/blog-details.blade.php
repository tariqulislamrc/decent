@extends('eCommerce.layouts.app')
@push('css')
<title>{{ $model->title}}</title>
<meta name="description" content="{{\Illuminate\Support\Str::limit($model->details,100)}}">
<meta name="keywords" content="">
<meta name="title" content="{{$model->title }}">
<meta property="og:title" content="{{ $model->title != '' ? $model->title : 'Blog Title' }}">
<meta property="og:description" content="{{ \Illuminate\Support\Str::limit($model->details,100) }} ">
<meta property="og:image" content="{{isset($model->image)?asset('storage/blog/'.$model->image):'http://placehold.it/1920x205'}}">
<meta property="og:url" content="{{ route('post-details', $model->post_slug) }}">

<meta name="twitter:title" content="{{ $model->title != '' ? $model->title : 'Blog Title' }} ">
<meta name="twitter:description" content=" {{ \Illuminate\Support\Str::limit($model->details,100) }} .">
<meta name="twitter:image" content="{{isset($model->image)?asset('storage/blog/'.$model->image):'http://placehold.it/1920x205'}}">
<meta name="twitter:card" content="summary_large_image">
@endpush
@push('main')
<!-- Main of the Page -->
<main id="mt-main">
    <!-- Mt Contact Banner of the Page -->
    <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s"
        style="background-image: url({{isset($model->image)?asset('storage/blog/'.$model->image):'http://placehold.it/1920x205'}});">

        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h1>{!!$model->title!!}</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Mt Contact Banner of the Page end -->
    <!-- Mt Blog Detail of the Page -->
    <div class="mt-blog-detail fullwidth wow fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 header">
                    <!-- Breadcrumbs of the Page -->
                    <nav class="breadcrumbs">
                        <ul class="list-unstyled">
                            <li><a href="{{ url('/') }}">Home <i class="fa fa-angle-right"></i></a></li>
                            <li><a href="{{route('blog')}}">Blog <i class="fa fa-angle-right"></i></a></li>
                            <li><a>{!!$model->title!!}</a></li>
                        </ul>
                    </nav>
                    <!-- Breadcrumbs of the Page end -->
                    {{-- <ul class="list-unstyled align-right">
                        <li>
                            Categories <a href="#"><i class="fa fa-bars"></i></a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Blog Post of the Page -->
                    <article class="blog-post style3">
                        <div class="img-holder">
                            <a><img style="max-height: 575px;" src="{{isset($model->image)?asset('storage/blog/'.$model->image):'http://placehold.it/1200x575'}}"
                                    alt="image description"></a>
                            <time
                                class="time"><strong>{{formatDate2($model->date)}}</strong>{{formatMonth($model->date)}}</time>
                    <ul class="list-unstyled comment-nav">
                      <li><div class="addthis_inline_share_toolbox"></div></li>
                      <!--<li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>-->
                    </ul>
                        </div>
                        <div class="blog-txt">
                            <h2><a style="text-transform: uppercase">{!!$model->title!!}</a></h2>
                            <ul class="list-unstyled blog-nav">
                                <li> <a><i class="fa fa-clock-o"></i>{{formatDate1($model->date)}}</a></li>
                                <li> <a href="{{route('category-details',$model->category->category_slug)}}"><i
                                            class="fa fa-list"></i>{{$model->category?$model->category->name:''}}</a>
                                </li>
                            </ul>
                            <p>{!!$model->details!!}</p>
                        </div>
                    </article>

                </div>
            </div>
        </div>
    </div>
    <!-- Mt Blog Detail of the Page end -->
</main>
<!-- footer of the Page -->
@endpush

@push('scripts')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e6f1c98ea2e3519"></script>
@endpush
