@extends('front.app')
@section('page-title', 'Provider Sign Up')
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
					<div class="img" style="background-image: url({!! asset('assets/frontend/images/bg-login.jpg') !!});">
		      	</div>
				<div class="login-wrap">
					<div class="login-inner">
						<div class="d-flex">
							<div class="w-100">
								<h3>Provider sign up</h3>
							</div>
						</div>
						<form method="POST" action="{!! route('provider-register') !!}" class="signin-form">
							@csrf
							@method('POST') 
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group mb-3">
										<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="first name" required>
										@error('first_name')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group mb-3">
										<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="last name" required>
										@error('last_name')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group mb-3">
								<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="email address" required>
								@error('email')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="phone number" required>
								@error('phone')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							
							<?php /*
							<div class="form-group mb-3">
								<select value="{{ old('user_type') }}" name="user_type" placeholder="Type" class="form-control" required>
									<option value="1">registry user</option>
									<option value="2">vendor</option>
								</select>
								@error('user_type')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							*/ ?>

							<div class="form-group mb-3">
								<input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="password" required>
								@error('password')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
								<span class="note">the password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.</span>
							</div>
							<div class="form-group mb-3">
								<input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="confirm password" required>
								@error('password_confirmation')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">sign up</button>
							</div>
						</form>
							@if (session('status'))
				        <div class="text-success text-center mb-3">
				            <small>
				                {{ session('status') }}
				            </small>
				        </div>
				    @endif 
					</div>
					<div class="footerText">already a member? <a href="{!! route('providerlogin') !!}">login now</a></div>
	        	</div>
	      	</div>
		</div>

	</div>
</section> 

@endsection