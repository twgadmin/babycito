@extends('front.app')
@section('page-title', 'Send One Time Gift')
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
								<h3>Send One Time Gift</h3>
							</div>
						</div>
							<form method="POST" action="{!! route('send.one.time.gift') !!}" class="signin-form">
							@csrf
							@method('POST') 
							<div class="form-group mb-3">
								<input type="text" name="sendername" class="form-control" value="{{ old('sendername') }}" placeholder="Sender name" required>
								@error('sendername')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="senderemail" class="form-control" value="{{ old('senderemail') }}" placeholder="Sender email" required>
								@error('senderemail')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<div class="amountDiv">
									<ul class="amountList">
										<li>25</li>
										<li>50</li>
										<li>100</li>
										<li>250</li>
										<li>500</li>
										<li>1000</li>
									</ul>
									<input type="text" name="amount" class="form-control amountSet" value="{{ old('amount') }}" placeholder="Other amount" required>
								</div>
								@error('amount')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<textarea name="message" id="message" rows="6" class="form-control" placeholder="Message for your recipient" required>{{ old('message') }}</textarea>
								@error('amount')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="provider" class="form-control suggestionField" value="{{ old('provider') }}" placeholder="Select provider" required readonly data-bs-toggle="modal" data-bs-target="#providerModal">
								@error('provider')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="gift_deliver_at" id="gift_deliver_at" class="form-control calendar" value="{{ old('gift_deliver_at') }}" placeholder="Delivery Options" required>
								@error('gift_deliver_at')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="receivername" class="form-control" value="{{ old('receivername') }}" placeholder="Recipient name" required>
								@error('receivername')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group mb-3">
								<input type="text" name="receiveremail" class="form-control" value="{{ old('receiveremail') }}" placeholder="Recipient email address" required>
								@error('receiveremail')
									<span class="error text-danger">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group">
								<button type="submit" class="form-control submit">Submit</button>
							</div>
								@if (session('error'))
							<div class="text-danger text-center mb-3">
								<small>
								    {{ session('error') }}
								</small>
							</div>
						@endif 							
						</form>
					</div>
	        	</div>
	      	</div>
		</div>

	</div>
</section>



<!-- Provider Modal -->
<div class="modal fade modalbaby" id="providerModal" tabindex="-1" aria-labelledby="providerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Select providers from list</h5>
                <p>After entering your own service or provider, close this text box to continue.</p>
                <div class="form-group mb-3">
	                <select class="form-control form-select dropBaby">
	                    <option selected>Choose...</option>
	                    <option value="Other">Other/Choose My Own Provider</option>
	                    @foreach($providers as $provider)
		                    <option value="{{ $provider->services_title }}">{{ $provider->services_title }}</option>
	                    @endforeach
	                </select>
				</div>
				<div class="form-group mb-3" id="otherProviderDiv" style="display:none;">
					<input type="text" id="other_provider" name="other_provider" class="form-control" value="{{ old('other_provider') }}" placeholder="Other Provider" required>
				</div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

@endsection

