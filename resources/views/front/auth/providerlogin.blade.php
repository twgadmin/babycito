@extends('front.app')
@section('page-title', 'Provider Login')
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
					<div class="img" style="background-image: url({!! asset('assets/frontend/images/bgsignup.jpg') !!});">
		      	</div>
				<div class="login-wrap">
					<div class="login-inner">
						<div class="d-flex">
							<div class="w-100">
								<h3>Provider log in</h3>
							</div>
						</div>
						
						<form method="POST" action="{!! route('provider-login') !!}" class="signin-form">
							@csrf
							@method('POST') 
							<div class="form-group mb-3">
								<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="email address" required>
								@error('email')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="password" required>
								@error('password')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">sign in</button>
							</div>

								@if (session('error'))
							<div class="text-danger text-center mb-3">
								<small>
								    {{ session('error') }}
								</small>
							</div>
						@endif 
							<div class="form-group rowRem">
								<div class="colRem">
									<label class="checkbox-wrap checkbox-primary mb-0">remember me
										<input type="checkbox" checked>
										<span class="checkmark"></span>
									</label>
								</div>
								<div class="colRem">
									<a href="{!! route('password.request') !!}">forgot password</a>
								</div>
							</div>
						</form>
					</div>
	          		<div class="footerText">not a member? <a href="{!! route('providerregister') !!}">sign up</a></div>
	        	</div>
	      	</div>
		</div>

	</div>
</section>
@endsection
