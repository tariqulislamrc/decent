@extends('eCommerce.layouts.app')         
	@push('main')
	 <!-- Main of the Page -->
      <main id="mt-main">
        <section class="mt-contact-banner" style="background-image: url(http://placehold.it/1920x205);">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 text-center">
                <h1>SIGN IN or register</h1>
                <nav class="breadcrumbs">
                  <ul class="list-unstyled">
                    <li><a href="index.html">home <i class="fa fa-angle-right"></i></a></li>
                    <li>register</li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Detail Section of the Page -->
        <section class="mt-detail-sec toppadding-zero" style="padding-bottom:20px; padding-top:10px;">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-10 col-sm-push-1">
                <div class="holder" style="margin: 0;">
                    <div class="mt-side-widget">
                      <header>
                        <h2 style="margin: 0 0 5px;">SIGN IN</h2>
                        <p>Welcome back! Sign in to Your Account</p>
                      </header>
                      <form action="#">
                        <fieldset>
                          <input type="text" placeholder="Username or email address" class="input">
                          <input type="password" placeholder="Password" class="input">
                          <div class="box">
                            <span class="left"><input class="checkbox" type="checkbox" id="check1"><label for="check1">Remember Me</label></span>
                            <a href="#" class="help">Help?</a>
                          </div>
                          <button type="submit" class="btn-type1">Login</button>
                        </fieldset>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
        <!-- mt side widget end here -->
        <div class="container">
					<div class="or-divider" style="padding-bottom:20px;"><span class="txt">or</span></div>
        </div>
					<!-- mt side widget start here -->
        <!-- Mt Detail Section of the Page -->
        <section class="mt-detail-sec toppadding-zero" style="padding-bottom:20px;">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 col-sm-10 col-sm-push-1">
                <div class="holder" style="margin: 0;">
                    <div class="mt-side-widget">
                      <header>
                        <h2 style="margin: 0 0 5px;">register</h2>
                        <p>Don’t have an account?</p>
                      </header>
                      <form action="#" style="margin: 0 0 80px;">
                        <fieldset>
                          <div class="row">
                            <div class="col-xs-12 col-sm-6">
                              <input type="text" placeholder="First Name" class="input">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                              <input type="text" placeholder="Last Name" class="input">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 col-sm-6">
                              <input type="text" placeholder="Username" class="input">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                              <input type="text" placeholder="Your Email" class="input">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 col-sm-6">
                              <input type="text" placeholder="Your Phone" class="input">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                              <textarea placeholder="Address" class="input"></textarea>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-xs-12 col-sm-6">
                              <input type="password" placeholder="Re-type Password" class="input">
                            </div>
                            <div class="col-xs-12 col-sm-6">
                              <input type="password" placeholder="Password" class="input">
                            </div>
                          </div>
                          <div class="box">
                            <a href="#" class="help">Help?</a>
                          </div>
                          <button type="submit" class="btn-type1">Register Me</button>
                        </fieldset>
                      </form>
                      <header>
                        <h2 style="margin: 0 0 5px;">register with social</h2>
                        <p>Create an account using social</p>
                      </header>
                      <ul class="mt-socialicons">
                        <li class="mt-facebook"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                        <li class="mt-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="mt-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="mt-dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li class="mt-pinterest"><a href="#"><i class="fa fa-openid"></i></a></li>
                        <li class="mt-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                      </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Mt Detail Section of the Page end -->
        
      </main>
	<!-- footer of the Page -->
@endpush