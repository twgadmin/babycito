@extends('front.app')

@section('page-title', 'View Registry')

@section('content')

<section class="secPagetemp3 cover bgGreen">
	<div class="container">

		<div class="wrapPt3A endradius">

			@if(!empty(auth()->user()->services_image) && auth()->user()->services_image != '' && file_exists(uploadsDir('front/user_services_images') . auth()->user()->services_image))
                <div class="imgWrap cover" style="background-image: url( {!! asset(uploadsDir('front/user_services_images').auth()->user()->services_image) !!} );">
            @else
            	<div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/provider01.jpg') !!} );">
            @endif
					<div class="regButtons">
						<ul>
							<li><a href="{!! route('edit-user',auth()->user()->id) !!}"><i class="fas fa-edit"></i><span>edit profile</span></a></li>
						</ul>
					</div>
				</div>

				<div class="textWrap textreg">
					@if (session('status'))
						<div class="alert alert-success">{{ session('status') }}</div>
					@endif 
					<h2>{{auth()->user()->services_title}}</h2>
					@if(auth()->user()->registry_events)
						<table>
						@foreach(auth()->user()->registry_events as $eve)
							<tr>
								<td width="10%">
									<img class="iconRegistry" src="{!! asset('assets/frontend/images/').'/'.$eve->registry_event->icon_image !!}" alt="" /> 
								</td>
								<td width="25%">
									{{$eve->registry_event->name}}
								</td>
								<td width="20%">
									{{date("M, d Y", strtotime($eve->event_date))}}
								</td>
								<td width="10%">
									<a class="delRegistry" href="{!! route('delete-registry-event',$eve->id) !!}"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
						@endforeach
						</table>
					@endif

					<!-- <p>{{auth()->user()->meta_description}}</p> -->
					<p>Thank you for supporting us as we grow our family!  Your contributions will help us to access the essential family support services we will need.</p>
					<p class="note">Feel free to use the feature below to share any exciting upcoming dates with your friends and family!  Consider sharing your due date, adoption date, baby shower/sprinkle, etc.</p>
					<a href="javascript::void(0)" class="form-control submit registry_event_show">+ Add or edit date</a>

					<form method="POST" action="{{route('create-update-registry-event')}}" class="registry_event_form form-inline d-none">
						@csrf
						@method('POST') 
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group mb-3">
									<select  name="registry_event" class="form-control" required>
										@foreach($registry_event as $r)
										<option value="{{ $r->id}}">{{$r->name}}</option> @endforeach </select>
									</select>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group mb-3">
									<input type="date" name="event_date" class="form-control" min="{!! date('Y-m-d') !!}" required>
									@error('event_date')
										<span class="error text-danger">{{ $message }}</span>
									@enderror
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group mb-3">
									<button type="submit" class="form-control submit">+ add date</button> 
								</div>
							</div>
						</div>
					</form>

				</div>
		</div>
		
	</div>

	<div class="priceBar">
		<div class="container">
			<ul>
				<li>
					@if($user->stripe_code)
						<i class="fas fa-link"></i>
						<span>Account<br>Connected</span>
					@else
					<a href="{{route('connect-stripe')}}">
						<i class="fas fa-link"></i>
						<span>Connect Your<br>Bank Account</span>
					</a>
					@endif
				</li>

				<li>
					<a href="{{route('providers')}}" ><i class="fas fa-plus"></i>
					<span>Fill your registry with<br>support services</span>
					</a>
				</li>

				<li>
					<div class="formHide">
						<i class="fas fa-paper-plane"></i>
						<span>Share your registry<br>with friends and family</span>
						<form method="POST" action="{{route('save-share-registry',base64_encode(auth()->user()->email))}}" class="signin-form">
							@csrf
							@method('PUT')
							<input type="hidden" name="email" value="{{auth()->user()->email}}">
							<button type="submit" data-toggle="modal" data-target="#myModal">Submit</button>
						</form>
					</div>
				</li>
			</ul>
		</div>
	</div>

	<div class="container">
		<div class="row">

			<div class="col-12 col-lg-6 mb-4">
				<div class="widgetPrice">
					<a href="{{route('add-new-service')}}">
					<div class="upperPrice">
						<i class="fas fa-plus"></i>
						<h2>add your own</h2>
					</div>
					<div class="lowerPrice">
						Don’t see a service or provider you would like to use?<br/>Click here to create your own custom service to add to your registry.
					</div>
					</a>
				</div>
			</div>

			<div class="col-12 col-lg-6 mb-4">
				<div class="widgetPrice">
					<a href="https://calendly.com/babycito/serviceconsultation" target="_blank">
					<div class="upperPrice">
						<i class="fas fa-calendar-check"></i>
						<h2>book a session</h2>
					</div>
					<div class="lowerPrice">
						Not sure what to register for or where to begin?<br/>Click here to schedule a FREE 30 minute registry consultation with our founder!
					</div>
				</a>
				</div>
			</div>

			@if (session()->has('popup'))
				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Copy Link</h4>
								<button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
							</div>
							<div class="modal-body">
								@php
                                	$hash_email = base64_encode(auth()->user()->email);
                            	@endphp
								<p>{{route('share-registry',$hash_email)}}</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" id="closebuttonModal">Close</button>
							</div>
						</div>
					</div>
				</div>
			@endif
			@foreach($user->custom_service as $key=>$r_event)
			@if(($r_event->pivot->deleted_at=="")||($r_event->pivot->deleted_at==NULL)||($r_event->pivot->deleted_at=='0000-00-00 00:00:00'))
					<div class="col-12 mb-4">
						<div class="divSvcreg">
							@if($r_event->filename != '' && file_exists(uploadsDir('front/custom_services/registry_images') . $r_event->filename))
								<div class="imgWrap cover" style="background-image: url( {!! asset(uploadsDir('front/custom_services/registry_images').$r_event->filename) !!} );">
								</div>
							@else
								<div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/checkout.jpg') !!} );">
								</div>
							@endif
							<div class="textWrap">
								<h2>{{ $r_event->services_title }}</h2>
									{!! $r_event->description !!}
							</div>
								@php
									$price = 0;
									$am = \DB::table('registries_payment')->where('registry_service_id', $r_event->pivot->id)->groupBy('registry_service_id')->selectRaw('sum(price) as sum')->pluck("sum");
									if(isset($am) && isset($am[0])){
										$price = $am[0];
									}
									$percentage = 0;

									
									if(isset($serviceExistInRegistry[$r_event->id])&&$serviceExistInRegistry[$r_event->id]>0){						
										$percentage = isset($r_event->amount)&&$r_event->amount>0 ? cal_percentage($price,((isset($serviceExistInRegistry[$r_event->id])&&$serviceExistInRegistry[$r_event->id]>0) ? $serviceExistInRegistry[$r_event->id]*$r_event->amount : $r_event->amount)) : 0;
									}else{
										$percentage = isset($r_event->amount)&&$r_event->amount>0 ? cal_percentage($price,((isset($r_event->qty)&&$r_event->qty>0) ? $r_event->qty*$r_event->amount : $r_event->amount)) : 0;
									}

									$percentage = (int) $percentage;
								@endphp

							@if($percentage < 100)
							<div class="optionWrap">
								{{--<h2>Status</h2>
								<p>{{$r_event->pivot->status == 1 ? "Approved" : "Pending"}}</p>--}}
								<p class="price"><span>
									@if(isset($serviceExistInRegistry[$r_event->id])&&$serviceExistInRegistry[$r_event->id]>0)							
									{{ ((isset($serviceExistInRegistry[$r_event->id])&&$serviceExistInRegistry[$r_event->id]>0) ? $serviceExistInRegistry[$r_event->id]." at " : "" ) }}{{ (isset($serviceExistInRegistry[$r_event->id]) ? "$" . (($serviceExistInRegistry[$r_event->id]*$r_event->amount)-$price) : "$" . ($r_event->amount-$price)) . " " }}

									@else
										{{ ((isset($r_event->qty)&&$r_event->qty>0) ? $r_event->qty." at " : "" ) }}{{"$" . (((isset($r_event->qty)&&$r_event->qty>0) ? $r_event->qty*$r_event->amount : $r_event->amount)-$price) . " " }}
									@endif
								</span> remaining</p>
								<form method="POST" action="" class="signin-form">
									@csrf
									@method('POST') 
									<div class="slidecontainer">
										<input type="range" disabled min="0" max="100" value="{{$percentage}}" class="slider" id="myRange">
										<p><span id="demo">{{$percentage}}</span>%</p>
									</div>
									<div class="regOptions">
										@if(auth()->user()->id == $r_event->vendor_id)
											<a class="buttonReg" href="{{route('custom-services.edit',$r_event->id)}}">Edit</a>
										@endif
										@if($percentage==0)
											<a href="{{ route('delete.custom.service.from.registries',$r_event->pivot->id) }}" class="btn bg-transparent p-0"><i class="fa fa-trash delCart"></i></a>
										@endif
									</div>
									{{--<label class="switch">
										<input type="checkbox" value="{{ $r_event->pivot->id }}" id="is_visible" name="is_visible" {{$r_event->pivot->is_visible == 1 ? 'checked' : ''}}>
										<span>{{$r_event->pivot->is_visible == 1 ? 'Visible' : 'Not Visible'}}</span>
									</label>--}}
									<div class="rowPrice d-none">
										<div class="priceField">
											<span>$</span>
											<input type="text" placeholder="" value="700" />
										</div>
										<button type="submit" class="form-control submit ">save</button>
									</div>
								</form>
								
							</div>

							@else
							<div class="optionWrap">
								
								<p class="price">
									<span>Paid</span>
								</p>
							</div>

							@endif
						</div>
					</div>
			@endif
			@endforeach
		</div>
	</div>

</section>

@endsection
@section('js')
<script type="text/javascript">
	jQuery('.registry_event_show').click(function(e){

    jQuery(this).addClass('d-none');
    jQuery('.registry_event_form').removeClass('d-none');
});
$(function() {
	$('#myModal').modal('show');
	$('#closeModal').click(function(){
	$('#myModal').modal('hide');
	});
	$('#closebuttonModal').click(function(){
	$('#myModal').modal('hide');
	});
});
</script>
@endsection