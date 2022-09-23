@extends('front.app')

@section('page-title', 'Find Registry')

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
					<div class="img" style="background-image: url({!! asset('assets/frontend/images/bgregistry.jpg') !!});">
		    	</div>
				<div class="login-wrap">
					<div class="login-inner">
						<div class="d-flex">
							<div class="w-100">
								<p>With babycito's Service Registry, families can lean on their friends and family networks to access a variety of support services provided by our trusted, local providers. These services span a wide array of support and care and can make all the difference with helping growing families thrive.</p>
								<p>Use the links below to find a friend or family member's registry or to create your own!</p>
								<p>Need help creating your registry? Visit our <a href="{!! route('help-center') !!}">Help Center</a> for answers to some frequently asked questions about our babycito Service Registry or <a href="https://calendly.com/babycito/serviceconsultation" target="_blank">click here</a> to set up a FREE service consultation with our founder, Lindsay.</p>
							</div>
						</div>

						@if(@auth()->user()->user_type == 1)
						<div class="d-flex">
							<div class="w-100">
								<h3>view registry</h3>
								<p>Click here to see your babycito Service Registry!</p>
							</div>
						</div>
						<a href="{{route('view-registry')}}" class="form-control submit">view registry</a>
						@elseif(@auth()->user()->user_type == 2)

						@else
						<div class="d-flex">
							<div class="w-100">
								<h3>create a registry</h3>
								<p>Click here to set up your babycito Service Registry!</p>
							</div>
						</div>
						<a href="{!! route('register') !!}" class="form-control submit">create a registry</a>
						
						@endif

						<form method="GET" action="{{ route('search-registry') }}" class="signin-form">
							<div class="d-flex">
								<div class="w-100">
									@if(@auth()->user()->user_type != 2)
										<h4><span>or</span></h4>
									@endif
										<h3>find a registry</h3>
										<p>Find a registered friend or family member by typing their name here.</p>
								</div>
							</div>
						
							<div class="form-group mb-3">
								<input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="enter" required>
								@error('name')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">search</button>
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