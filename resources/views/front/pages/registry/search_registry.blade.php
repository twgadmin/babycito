@extends('front.app')

@section('page-title', 'Registries')

@section('content')
{{--@if(!empty( $banner->filename ) &&  $banner->filename  != '' && file_exists(uploadsDir('admin/banner') .  $banner->filename ))
<section class="secBanner themedark overlay" style="background-image: url(' {!! asset(uploadsDir('admin/banner') . $banner->filename) !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
                <h2>{!! $banner->title !!}</h2>
				<p>{!! $banner->description !!}</p>
			</div>
		</div>
	</div>
</section>
@else--}}
<section class="secBanner themedark overlay" style="background-image: url(' {!! asset('assets/frontend/images/banner-provider-one.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
                <h2>Registry Users</h2>
				<p>{!! @$banner->description !!}</p>
			</div>
		</div>
	</div>
</section>
{{--@endif--}}

<section class="secProviders">
	<div class="container">
        <div class="row">

            <div class="col-12">  
                @if(count($users) > 0)
                <div class="rowProviders">
                    @foreach($users as $key=>$registry)
                    <div class="colProviders">
                        @if(!empty( $registry->services_image ) &&  $registry->services_image  != '' && file_exists(uploadsDir('front/user_services_images') .  $registry->services_image ))
                            <div class="imgProviders cover" style="background-image: url(' {!! asset(uploadsDir('front/user_services_images'). $registry->services_image ) !!} ');"></div>
                        @else
                            <div class="imgProviders cover" style="background-image: url(' {!! asset('assets/frontend/images/provider01.jpg') !!} ');"></div>
                        @endif
                        <div class="contProviders">
                            <h3>{!! $registry->first_name . " " . $registry->last_name !!}</h3>
                            <p>{!! limit_char(strip_tags($registry->services_body),70) !!}</p>
                            @php
                                $hash_email = base64_encode($registry->email);
                            @endphp
                            <a href="{!! route('share-registry',$hash_email) !!}" class="moreProvider">View Registry</a>
                        </div>
                    </div>
                    @endforeach
                </div>  
                @else
                <div class="divNotfound">
                    <h2>Sorry, we don’t have a registry under that name.</h2>
                    <img src="{!! asset('assets/frontend/images/baby-sleep.png') !!}" alt="" />
                </div>
                @endif
                
            </div>
        </div>
    </div>
</section>


@endsection