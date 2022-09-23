<footer class="footerMain">
   <div class="container">
      <div class="row justify-content-between">
         <!-- <div class="col-12 col-sm-6 col-md-3 col-lg-2"> -->
         <div class="col-12 col-sm-3 col-lg-2">
            <h3>quick links</h3>
            <ul>
               <li><a href="{!! route('public.index') !!}">home</a></li>
               <li><a href="{!! route('providers') !!}">providers</a></li>
               <li><a href="{!! route('find-registry') !!}">registry</a></li>
               <li><a href="{!! route('about-us') !!}">about us</a></li>
               <li><a href="{!! route('blog') !!}">blog</a></li>
            </ul>
         </div>
         <!-- <div class="col-12 col-sm-6 col-md-3 col-lg-2">
            <h3>services</h3>
            <ul>
               <li><a href="#our_service">all services</a></li>
               <li><a href="#anticipation">anticipation</a></li>
               <li><a href="#birth">birth</a></li>
               <li><a href="#continued_care">continued care</a></li>
            </ul>
         </div> -->
         <!-- <div class="col-12 col-sm-6 col-md-3 col-lg-2"> -->
         <div class="col-12 col-sm-3 col-lg-2">
            <h3>support</h3>
            <ul>
               <li><a href="{!! route('contact-us') !!}">contact us</a></li>
               <li><a href="{!! route('terms-and-conditions') !!}">terms & conditions</a></li>
               <li><a href="{!! route('privacy-policy') !!}">privacy policy</a></li>
               <li><a href="{!! route('cookie-policy') !!}">cookie policy</a></li>
               <li><a href="{!! route('help-center') !!}">help center</a></li>
            </ul>
         </div>
         <!-- <div class="col-12 col-sm-6 col-md-3 col-lg-2"> -->
         <div class="col-12 col-sm-3 col-lg-2">
            <h3>account</h3>
            <ul>
            @if (!auth()->user())
               <li><a href="{!! route('login') !!}">login</a></li>
               <li><a href="{!! route('register') !!}">sign up</a></li>
            @else
               <li><a href="javascript:;" onclick="logout()">Logout</a></li>
            @endif
            </ul>
         </div>
         <div class="col-12 col-lg-4">
            <div class="newsletter">
               <h3>mailing list</h3>
               <p>Stay in the loop with the latest from babycito and our local providers. Share your email here!</p>
               <form action="{{route('subscribe-newsletter')}}" method="POST">
                  @csrf
                  <div class="fieldsWrap">
                     <input class="form-control" name="user_email" type="email" placeholder="email address">
                     <input class="button" type="submit" value="submit">
                  </div>
               </form>
            </div>
         </div>
      </div>
      <div class="copyrights">
         <img class="logo" src="{!! asset('assets/frontend/images/logo-footer.png') !!}" alt="BabyCito" />
         <div class="copytext">
            &copy; copyrights 2022, <a href="{!! route('public.index') !!}">babycito</a>. all rights reserved. 
         </div>
         <div class="social">
            <span>let’s connect!</span>
            <div>
               <a href="https://www.facebook.com/co.babycito/" target="_blank"><i class="fab fa-facebook-f"></i></a>
               <a href="https://www.instagram.com/babycito.co/" target="_blank"><i class="fab fa-instagram"></i></a>
               <a href="https://www.linkedin.com/company/babycito/" target="_blank"><i class="fab fa-linkedin"></i></a>
            </div>
         </div>
      </div>
   </div>
</footer>

<div class="divSticky hide">
	<div class="contentSticky">
		<div class="clickButton"></div>
		<i class="fas fa-times closeButton"></i>
		<h3>Download our free service guide</h3>
		<p>Enter your email address and we’ll send you a link to download our FREE Service Guide.</p]>
		<form method="POST" action="{{ route('download.free.0service.guide') }}">
         @csrf
         @method('POST') 
			<div class="fieldWrap">
				<input class="form-control" type="text" name="fullname" value="{{ old('fullname') }}" placeholder="Full Name" required />
			</div>
			<div class="fieldWrap">
				<input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Email Address" required />
			</div>
			<div class="fieldWrap">
				<button class="button" type="submit">Download</button>
			</div>
		</form>
	</div>
</div>