@extends('front.app')

@section('page-title', 'Contact Us')

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
					@if( $pages)
					<div class="img" style="background-image: url({!! asset('uploads/front/'.$pages->mediaFiles->filename) !!});"></div>
						@else 
						<div class="img" style="background-image: url({!! asset('assets/frontend/images/bgcontact.jpg') !!});"></div>

						@endif
				<div class="login-wrap">
					<div class="login-inner">
						<div class="d-flex">
							<div class="w-100">
								@if( $pages)
									<h3>{{ $pages->page_title}}</h3>
									<p>{!! $pages->content !!}</p>
								@endif
							</div>
						</div>

						@if (Session::get('status'))
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
										{!! Session::get('status') !!}
									</div>
								@endif
						<form method="POST" action="" class="signin-form">
							@csrf
							@method('POST') 
							<div class="form-group mb-3">
								<input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Name" required>
								@error('name')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" required>
								@error('email')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Contact number" required>
								@error('phone')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>

							<div class="form-group mb-3">
								<textarea placeholder="Message" name="message" class="form-control" min="10" max="500">{{ old('message') }}</textarea>
								@error('message')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">Send Now</button>
							</div>
						</form>
					</div>
	          		<div class="footerText">back to <a href="{!! route('public.index') !!}">home</a></div>
	        	</div>
	      	</div>
		</div>

	</div>
</section>

@endsection