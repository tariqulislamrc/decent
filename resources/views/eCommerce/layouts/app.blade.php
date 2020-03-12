<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<!-- set the viewport width and initial-scale on mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Schön. | eCommerce HTML5 Template</title>
	<!-- include the site stylesheet -->
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset(get_option('favicon')?'storage/logo/'.get_option('favicon'):'favicon.png')}}">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.css">
  <!-- include the site stylesheet -->
  <link rel="stylesheet" href="{{asset('frontend')}}/css/animate.css">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{asset('frontend')}}/css/icon-fonts.css">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{asset('frontend')}}/css/main.css">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{asset('frontend')}}/css/responsive.css">
</head>
<body>
	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="{{asset('frontend')}}/images/svg/rings.svg" alt="loader">
      </div>
    </div>
		<!-- W1 start here -->
		<div class="w1">
			<!-- mt header style5 start here -->
			<header class="style5" id="mt-header">
				<!-- mt bottom bar start here -->
					@include('eCommerce.inc.navbar')
				<!-- mt bottom bar end here -->
            </header><!-- mt header style5 end here -->
            <!-- mt search popup start here -->
			<div class="mt-search-popup">
				<div class="mt-holder">
					<a href="#" class="search-close"><span></span><span></span></a>
					<div class="mt-frame">
						<form action="#">
							<fieldset>
								<input type="text" placeholder="Search...">
								<span class="icon-microphone"></span>
								<button class="icon-magnifier" type="submit"></button>
							</fieldset>
						</form>
					</div>
				</div>
			</div><!-- mt search popup end here -->

            @stack('main')

            <footer id="mt-footer" class="style1 wow fadeInUp" data-wow-delay="0.4s">
				@include('eCommerce.inc.footer')
			</footer><!-- footer of the Page end -->
		</div>
		<!-- W1 end here -->
		<span id="back-top" class="fa fa-arrow-up"></span>
	</div>
	<!-- include jQuery -->
	<script src="{{asset('frontend')}}/js/jquery.js"></script>
	<!-- include jQuery -->
	<script src="{{asset('frontend')}}/js/plugins.js"></script>
	<!-- include jQuery -->
	<script src="{{asset('frontend')}}/js/jquery.main.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
</body>
</html>