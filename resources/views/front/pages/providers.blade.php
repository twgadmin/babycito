@extends('front.app')

@section('page-title', 'Providers')

@section('content')
@if(!empty( $banner->filename ) &&  $banner->filename  != '' && file_exists(uploadsDir('admin/banner') .  $banner->filename ))
<section class="secBanner themedark overlay miniBanner" style="background-image: url(' {!! asset(uploadsDir('admin/banner') . $banner->filename) !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
                <h2>{!! $banner->title !!}</h2>
				<p>{!! $banner->description !!}</p>
			</div>
		</div>
	</div>
</section>
@else
<section class="secBanner themedark overlay" style="background-image: url(' {!! asset('assets/frontend/images/banner-provider-one.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
                <h2>{!! @$banner->title !!}</h2>
				<p>{!! @$banner->description !!}</p>
			</div>
		</div>
	</div>
</section>
@endif

<section class="secProviders">
	<div class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="sidebar">
                    <div class="widget">
                        <div class="widget-title">
                            <h3><span>All Categories</span><i class="fa fa-angle-down"></i></h3>
                        </div>
                        <div class="widget-content">
                            <ul>
                                <li><a class= "{{ request()->category  == '' ? 'active' : '' }}" href="{{route('providers')}}">All</a></li>
                                @foreach($categories as $key=>$category)
                                <li><a class= "{{ request()->category == $category->slug ? 'active' : '' }}" href="{{route('providers',['category' => $category->slug])}}">{!! $category->name !!}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                
                @if(count($custom_services) > 0)
                    <div class="rowProviders">
                        @foreach($custom_services as $key=>$provider)
                        <div class="colProviders">
                            @if(!empty( $provider->user->services_image ) &&  $provider->user->services_image  != '' && file_exists(uploadsDir('front/user_services_images') .  $provider->user->services_image ))
                                <div class="imgProviders cover" style="background-image: url(' {!! asset(uploadsDir('front/user_services_images'). $provider->user->services_image ) !!} ');"></div>
                            @else
                                <div class="imgProviders cover" style="background-image: url(' {!! asset('assets/frontend/images/provider01.jpg') !!} ');"></div>
                            @endif
                            <div class="contProviders">
                                <h3>{!! $provider->user->services_title !!}</h3>
                                <p>{!! limit_char(strip_tags($provider->user->services_body),70) !!}</p>
                                @if(request()->category)
                                <a href="{!! route('provider-detail',$provider->user->id) !!}?category={{request()->category}}" class="moreProvider">Learn More</a>
                                @else
                                <a href="{!! route('provider-detail',$provider->user->id) !!}" class="moreProvider">Learn More</a>
                                @endif
                                
                            </div>
                        </div>
                        @endforeach
                    </div> 
                    {{ $custom_services->links() }}
                @else
                <div class="divNotfound">
                    <h2>We’re in the process of screening these providers. Check back soon!</h2>
                    <img src="{!! asset('assets/frontend/images/baby-sleep.png') !!}" alt="" />
                </div>
                @endif
                
            </div>
        </div>
    </div>
</section>


@endsection