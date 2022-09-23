@extends('front.app')

@section('page-title', 'Provider Detail')

@section('content')

@if(!empty( auth()->user()->services_image ) &&  auth()->user()->services_image  != '' && file_exists(uploadsDir('front/user_services_images') .  auth()->user()->services_image ))
<section class="secBanner themedark overlay" style="background-image: url(' {!! asset(uploadsDir('front/user_services_images'). auth()->user()->services_image ) !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>{!! isset(auth()->user()->services_title) ? auth()->user()->services_title : ""  !!}</h2>
				<p>{!! isset(auth()->user()->services_body) ? auth()->user()->services_body : ""  !!}</p>
			</div>
		</div>
	</div>
</section>
@else
<section class="secBanner themedark overlay" style="background-image: url(' {!! isset(auth()->user()->services_image) ? asset(uploadsDir('front/user_services_images'). auth()->user()->services_image ) :asset('assets/frontend/images/banner-provider-one.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>{!! auth()->user()->first_name . ' ' . auth()->user()->last_name !!}</h2>
				<p>{!! auth()->user()->services_body !!}</p>
			</div>
		</div>
	</div>
</section>
@endif


<section class="secProviderSingle">
	<div class="container">
        
        <h2>{!! auth()->user()->services_title !!}  info:</h2>
        <ul class="info">
            <li><b>Email:</b><a href="mailto:{!! auth()->user()->email !!}">{!! auth()->user()->email !!}</a></li>
            <li><b>Contact Name:</b><span>{!! auth()->user()->first_name . " " . auth()->user()->last_name !!}</span></li>
            <li><b>Website:</b><a target="_blank" href="{!! auth()->user()->website !!}">{!! auth()->user()->website !!}</a></li>
            <li><b>Contact Phone:</b>@if(isset(auth()->user()->phone))<a href="tel:{!! auth()->user()->phone !!}">{!! auth()->user()->phone !!}</a>@else <span>N/A</span>@endif</li>
            <li><b>Address:</b>@if(isset(auth()->user()->location))<span>{!! auth()->user()->location !!}</span>@else <span>N/A</span>@endif</li>
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
        <p>{!! isset(auth()->user()->meta_description) ? auth()->user()->meta_description : "N/A" !!}</p>

        <div class="rowScv">
            <h2>Services Detail:</h2>
            <a href="{!! route('add-new-service') !!}" class="button">
                <i class="feather icon-add"></i>
                Add Service
            </a>
        </div>
        
        <table >
            <thead>
                <tr>
                    <th scope="col">Services</th>
                    <th scope="col">Cost</th>
                    <th scope="col" class="tableDesc">Description</th>
                    {{--<th scope="col">Status</th>--}}
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if(count($custom_services)>0)
            <tbody>
                @foreach($custom_services as $key=>$custom_service)
                <tr>
                    <td data-label="Plans"><b>{{$custom_service->services_title}}</b></td>
                    <td data-label="Cost"><b>{{ isset($custom_service->show_amount)&&$custom_service->show_amount=='1'? (isset($custom_service->amount) ? "$".$custom_service->amount : "-" ) : "-" }}</b></td>
                    <td data-label="Description" class="tableDesc">
                        <p>{!! $custom_service->description !!}</p>
                    </td>
                    {{--<td data-label="Status"><b>{{$custom_service->status == 1 ? "Approved" : "Pending"}}</b></td>--}}
                    <td data-label="">
                        <a href="{!! route('custom-services.edit', $custom_service->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                            Edit
                        </a>

                        {{-- <button type="button" onclick="deleteConfirmation({!! $custom_service->id !!})" class="btn btn-danger btn-sm waves-effect waves-light">
                            Del
                        </button>

                        <form action="{!! URL::route('custom-services.destroy', $custom_service->id) !!}" method="POST" id="deleteForm{!! $custom_service->id !!}">
                            @csrf
                            @method('DELETE')
                        </form> --}}
                    </td>
                </tr>
                @endforeach
                
            </tbody>
            @else
                <tbody>
                    <tr>
                        <td class="text-center">
                            No Data Available
                        </td>
                    </tr>
                </tbody>
            @endif
        </table>

    </div>
</section>


@endsection