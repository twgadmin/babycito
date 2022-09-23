@extends('front.app')

@section('page-title', 'Forgot Password')

@section('content')
<section class="ftco-section">
	<div class="container">
		
		<!-- <div class="row justify-content-center">
			<div class="col-md-6">
				<img class="logo" src="{!! asset('assets/frontend/images/logo-white.png') !!}" alt="BabyCito" />
			</div>
		</div> -->

		<div class="row justify-content-center">
			<div class="col-md-12">

				<div class="wrap d-md-flex">
					<div class="img" style="background-image: url({!! asset('assets/frontend/images/bg-password.jpg') !!});">
		      	</div>
				<div class="login-wrap">
					<div class="login-inner">
						<div class="d-flex">
							<div class="w-100">
								<h3>reset password</h3>
							</div>
						</div>
						<form method="POST" action="{{ route('password.request') }}" class="signin-form">
							@csrf
							@method('POST')
							<input type="hidden" name="token" value="{{ $token }}">
							<div class="form-group mb-3">
								<input type="text" name="email" class="form-control" placeholder="email address" value="{{$email}}" required>
							</div>
							<div class="form-group mb-3">
								<input type="password" name="password" class="form-control" placeholder="password" required>
								<span class="note">the password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.</span>
							</div>
							<div class="form-group mb-3">
								<input type="password" name="password_confirmation" class="form-control" placeholder="confirm password" required>
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">reset password</button>
							</div>
						</form>
					</div>
					<div class="footerText">back to <a href="{!! route('login') !!}">login</a></div>
	       		 </div>
	      	</div>

		</div>
	</div>
</section>
@endsection