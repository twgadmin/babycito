@extends('front.app')

@section('page-title', 'Create A Registry')

@section('content')

<section class="secPagetemp2 cover" style="background-image: url( {!! asset('assets/frontend/images/bgregistry2.jpg') !!} );">
	<div class="container">
		<div class="wrapPt2">
			<h2>create a registry</h2>
			<form method="POST" action="{!! route('create-registry') !!}" class="signin-form">
							@csrf
							@method('POST') 
							<div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group mb-3">
										<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" placeholder="First Name" required>
										@error('first_name')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group mb-3">
										<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" placeholder="Last Name" required>
										@error('last_name')
											<span class="error text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>
							</div>
							<div class="form-group mb-3">
								<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address" required>
								@error('email')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Phone Number" required>
								@error('phone')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							

							<input type="hidden" value="1" name="user_type">
							
							<div class="form-group mb-3">
								<input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password" required>
								<span class="note">the password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.</span>
								@error('password')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required>
								@error('password_confirmation')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">Next</button>
							</div>
						</form>
						
		</div>
	</div>
</section>

@endsection