@extends('front.app')

@section('page-title', 'Registry Checkout')

@section('content')

<section class="secPagetemp3 cover" style="background-image: url( {!! asset('assets/frontend/images/bgcheckout.jpg') !!} );">
	<div class="container">

		<div class="wrapPt3A">
			@if($service->custom_service->filename != '' && file_exists(uploadsDir('front/custom_services/registry_images') . $service->custom_service->filename))
						<div class="imgWrap cover" style="background-image: url( {!! asset(uploadsDir('front/custom_services/registry_images').$service->custom_service->filename) !!} );">
						</div>
					@else
						<div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/checkout.jpg') !!} );">
						</div>
					@endif
			<div class="textWrap">
				<h2>{{$user->first_name}} {{$user->last_name}}</h2>
				<p>{!! $user->meta_description !!}</p>
			</div>
		</div>
		<div class="wrapPt3B">
			<h2>{{$service->custom_service->services_title}}</h2>
			<p>
			@foreach($service->custom_service->categoryCustomService as $cat)
				{{$cat->name}},
			@endforeach
			</p>

				@php
			    $price = 0;
				$am = \DB::table('registries_payment')->where('registry_service_id', $service->id)->groupBy('registry_service_id')->selectRaw('sum(price) as sum')->pluck("sum");

				if(isset($am) && isset($am[0])){
					$price = $am[0];
				}

				$percentage = 0;
				$percentage = cal_percentage($price,$service->custom_service->amount);


				@endphp

			<p class="price"><span>@if(isset($serviceExistInRegistry[$service->custom_service->id])&&$serviceExistInRegistry[$service->custom_service->id]>0)							
					{{ (isset($serviceExistInRegistry[$service->custom_service->id]) ? "$" . (($serviceExistInRegistry[$service->custom_service->id]*$service->custom_service->amount)-$price) : "$" . ($service->custom_service->amount-$price)) . " " }}

				@else
					{{"$" . (((isset($service->custom_service->qty)&&$service->custom_service->qty>0) ? $service->custom_service->amount*$service->custom_service->qty : $service->custom_service->amount)-$price) . " " }}
				@endif</span> remaining</p>

			<form method="POST" action="{{route('registry-add-cart',[base64_encode($user->email),$service->id])}}" class="signin-form">
				@csrf
				@method('POST') 

			

				<div class="slidecontainer">
						<input type="range" disabled min="0" max="100" value="{{$percentage}}" class="slider" id="myRange">
					<p><span id="demo"></span>%</p>
				</div>
				@php 
				$active_val = 0;
				@endphp

				<div class="rowPrice ">
					<ul class="selectPrice d-none">
						<!-- @for($x = 10; $x >= 2; $x--)
							<li class="{{$x == 4 ? 'active' : ''}}">$<span>{{ceil($service->custom_service->amount/$x)}}</span></li>
							@if($x == 4)
							@php
								$active_val = ceil($service->custom_service->amount/$x);
							@endphp
							@endif
							@php 
							$x--;
							@endphp
						@endfor -->
					</ul>
					<p>Input the amount you would like to contribute towards this service</p>
					<div class="priceField">
						<span>$</span>
						<input name="amount" placeholder="" value="" required />
					</div>
				</div>
			
				<div class="buttonWrap">
					<button type="submit" value="1" name="buy_now" class="form-control submit d-none">buy now</button>
					<button type="submit" class="form-control submit">add to cart</button>
				</div>
			</form>
			
		</div>

	</div>
</section>

@endsection