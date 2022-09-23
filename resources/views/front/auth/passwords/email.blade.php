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
								<h3>forgot password</h3>
								<p>you will receive instruction for reseting password</p>
								@if (Session::get('status'))
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										{!! Session::get('status') !!}
									</div>
								@endif
							</div>
						</div>
						<form method="POST" action="{!! route('password.email') !!}" class="signin-form">
							@csrf
							@method('POST')
							<div class="form-group mb-3">
								<input type="text" name="email" class="form-control" placeholder="email address" required>
								@if($errors->any())
									<span class="error text-danger">{{ implode('', $errors->all(':message')) }}</span>
								@endif
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