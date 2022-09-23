@extends('front.app')

@section('page-title', 'View Registry')

@section('content')

<section class="secPagetemp3 cover bgGreen">
	<div class="container">

		<div class="wrapPt3A endradius mb-5">
			@if(!empty($user->services_image) && $user->services_image != '' && file_exists(uploadsDir('front/user_services_images') . $user->services_image))
				<div class="imgWrap cover" style="background-image: url( {!! asset(uploadsDir('front/user_services_images').$user->services_image) !!} );">
			@else
				<div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/provider01.jpg') !!} );">
			@endif
				{{--<div class="regButtons">
					<ul>
						<li><a href="{!! route('edit-user',auth()->user()->id) !!}"><i class="fas fa-edit"></i><span>edit profile</span></a></li>
					</ul>
				</div>--}}
			</div>

			<div class="textWrap textreg">
				@if (session('status'))
					<div class="alert alert-success">{{ session('status') }}</div>
				@endif 
				<h2>{{$user->services_title}}</h2>
				@if($user->registry_events)
					<table>
					@foreach($user->registry_events as $eve)
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
							{{--<td width="10%">
								<a class="delRegistry" href="{!! route('delete-registry-event',$eve->id) !!}"><i class="fas fa-trash"></i></a>
							</td>--}}
						</tr>
					@endforeach
					</table>
				@endif

				<!-- <p>{{$user->meta_description}}</p> -->
				<p>Thank you for supporting us as we grow our family!  Your contributions will help us to access the essential family support services we will need.</p>
				<p class="note">Feel free to use the feature below to share any exciting upcoming dates with your friends and family!  Consider sharing your due date, adoption date, baby shower/sprinkle, etc.</p>
				{{--<a href="javascript::void(0)" class="form-control submit registry_event_show">+ Add or edit date</a>--}}

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
							<p>{{route('share-registry',md5(auth()->user()->email))}}</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" id="closebuttonModal">Close</button>
						</div>
					</div>
				</div>
			</div>
		@endif	

		@foreach($user->custom_service as $key=>$r_event)
			@if($r_event->pivot->status == 1)
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
						<h2>{{$r_event->services_title}}</h2>
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
								<input type="range" disabled min="0" max="100" value="{{ $percentage }}" class="slider" id="myRange2">
								@if($percentage > 0)
								<p><span id="demo2"></span>{{ $percentage }}%</p>
								@endif
							</div>
							<a class="buttonReg" href="{{route('view-detail-registry',[base64_encode($user->email),$r_event->pivot->id])}}">View Detail</a>
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
</section>

@endsection

@section('js')
<script type="text/javascript">
	jQuery('.registry_event_show').click(function(e){
    jQuery(this).addClass('d-none');
    jQuery('.registry_event_form').removeClass('d-none');
});
</script>
@endsection