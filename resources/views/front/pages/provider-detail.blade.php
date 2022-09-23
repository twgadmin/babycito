@extends('front.app')

@section('page-title', 'Provider Detail')

@section('content')

@if(!empty(  $user->services_image  ) &&   $user->services_image   != '' && file_exists(uploadsDir('front/user_services_images') .  $user->services_image  ))
<section class="secBanner themedark overlay" style="background-image: url(' {!! asset(uploadsDir('front/user_services_images'). $user->services_image ) !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>{!! $user->services_title!!}</h2>
				<p>{!! $user->services_body !!}</p>
			</div>
		</div>
	</div>
</section>
@else
<section class="secBanner themedark overlay" style="background-image: url(' {!! asset('assets/frontend/images/banner-provider-one.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>{!! $user->first_name . " " . $user->last_name !!}</h2>
				<p>{!! $user->services_body !!}</p>
			</div>
		</div>
	</div>
</section>
@endif

<section class="secProviderSingle">
	<div class="container">

        <h2>{!! $user->services_title !!}  info:</h2>
        <ul class="info">
            <li><b>Email:</b><a href="mailto:{!!  $user->contact_email ?  $user->contact_email : $user->email !!}">{!!  $user->contact_email ?  $user->contact_email : $user->email !!}</a></li>
            <li><b>Contact Name:</b><span>{!! $user->first_name . " " . $user->last_name !!}</span></li>
            <li><b>Website:</b><a target="_blank" href="{!! $user->website !!}">{{$user->website}}</a></li>
            <li><b>Contact Phone:</b><a href="tel:{!! $user->phone !!}">{!! $user->phone !!}</a></li>
            <li><b>Address:</b><span>{!! $user->location !!}</span></li>
        </ul>

        <h2>Media Gallery</h2>
        <div class="carouselMedia">
        @if(count($userMediaFiles)>0)
            @foreach($userMediaFiles as $key=>$userMedia)
            <div class="itemMedia">
                <div class="divMedia cover" style="background-image: url(' {!! asset(uploadsDir('front/user_media_images'). $userMedia->filename ) !!} ');"></div>
            </div>
            @endforeach
            @else
            <h4>No images found!!!!</h4>
            @endif
        </div>

        <h2>Description</h2>
        <p>
        <p>{!! $user->meta_description ? $user->meta_description : "N/A" !!}</p>


        <h2>Services and Pricing:</h2>

        <table>
            <thead>
                <tr>
                    <th scope="col">Services</th>
                    <th scope="col">Cost</th>
                    <th scope="col" class="tableDesc">Description</th>
                    @if(empty(auth()->user()) || auth()->user()->user_type != 2 )
                    <th scope="col">Add Now</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                
            @foreach($custom_services as $key=>$custom_service)
                <tr>
                    <td data-label="Services"><b>{!! $custom_service->services_title !!}</b></td>
                    <td data-label="Cost"><b>{!! (($custom_service->show_amount=='1')? "$" .$custom_service->amount : "-") !!}</b></td>
                    <td data-label="Description" class="tableDesc convert_url">
                        {!! $custom_service->description !!}
                    </td>
                    @if(empty(auth()->user()) || auth()->user()->user_type != 2 )
                    <td data-label="Add Now" class="tdButton">
                        @if($custom_service->show_amount=='1')
                            <form method="POST" action="{{ route('add-to-registry') }}" class="signin-form" enctype="multipart/form-data">
                                @csrf
                                @method('POST') 
                                <input type="hidden" name="services_id" value="{{$custom_service->id}}">
                                <select name="qty" placeholder="Quantity" class="form-control" required="">
                                    <option value="">Select Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>                                    
                                </select>
                                <button type="submit" class="form-control submit w-60">add to registry</button>
                            </form>
                        @else 
                            <?php /*   
                            <form method="POST" action="{{ route('request-for-pricing') }}" class="signin-form" enctype="multipart/form-data">
                                @csrf
                                @method('POST') 
                                <input type="hidden" name="services_id" value="{{$custom_service->id}}">
                                <button type="submit" class="form-control submit w-60">Please request pricing</button>
                            </form>
                            */ ?>
                            <a href="{{ route('add-new-service',$custom_service->id) }}" class="form-control submit w-60">create custom service</a>
                        @endif
                    </td>
                    @endif
                        
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</section>


@endsection
