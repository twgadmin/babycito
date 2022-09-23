@extends('front.app')

@section('page-title', 'Home')

@section('content')

@if($featured_image)
<section class="secBanner themedark" style="background-image: url(' {!! asset(uploadsDir('admin/featured-images') . $featured_image->media_image) !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2><span>{{$featured_image->heading1}}</span>{{$featured_image->heading2}}</h2>
				<p>{{$featured_image->description}}</p>
				<!-- <a class="button" href="{{$featured_image->read_more_link}}">Search Providers</a> -->
			</div>
		</div>
	</div>
</section>
@endif

<section class="secButtons">
	<div class="container">
		<ul>
			<li><a href="{!! route('providers') !!}">Search providers</a></li>
			<li><a href="{!! route('find-registry') !!}">Create a registry</a></li>
			<li><a href="{!! route('find-registry') !!}">Find a registry</a></li>
			<li><a href="{{ asset('pages/'.$learnaboutservices->slug) }}">Learn about services</a></li>
			<li><a href="{!! asset('pages/one-time-gifts') !!}">One-time gifts</a></li>
		</ul>
	</div>
</section>

<section class="secServices themedark">
	<div class="container">
	<div class="row">
			<div class="col-12 col-lg-6" id="our_service">
				<div class="divServices" style="background-image: url( {!! asset('assets/frontend/images/bg-provider.jpg') !!} );">
					<div class="contServices" >
						<div class="wrapServices" >
							<h3>{{$service_sections[0]->title}}</h3>
							<p>{!! $service_sections[0]->body !!}</p>
							<div class="buttonWrap">
								<a class="button" href="{!! asset('pages/how-providers-can-join') !!}">join as a provider</a>
								<a class="button" href="{!! route('providers') !!}">search providers</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6">
				<div class="divServices" style="background-image: url( {!! asset('assets/frontend/images/bg-registry.jpg') !!} );">
					<div class="contServices">
						<div class="wrapServices">
							<h3>{{$service_sections[1]->title}}</h3>
							<p>{!! $service_sections[1]->body !!}</p>
							<div class="buttonWrap">
								<a class="button" href="{!! route('find-registry') !!}">create a registry</a>
								<a class="button" href="{!! route('find-registry') !!}">find a registry</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 leads">
				<h2>{{$services[0]->title}}</h2>
				<p>{!! $services[0]->body !!}</p>
			</div>
		</div>
		
	</div>
</section>

<section class="secFamily themelight text-center">
	<div class="container">
		<div class="row">
			<div class="col-12 leads">
				<h2>{{$services[1]->title}}</h2>
				<p>{!! $services[1]->body !!} </p>
			</div>
			<div class="col-12 col-lg-4" id="anticipation">
				<div class="contWrap">
					<div class="imgWrap green">
						<a href="{{ asset('pages/'.$anticipation->slug) }}"><img src="{!! asset('assets/frontend/images/icon-anticipation.png') !!}" alt="anticipation" /></a>
					</div>
					<h3><a href="{{ asset('pages/'.$anticipation->slug) }}">{{$service_sections[2]->title}}</a></h3>
					<p>{!! $service_sections[2]->body !!}</p>
				</div>
			</div>
			<div class="col-12 col-lg-4" id="birth">
				<div class="contWrap">
					<div class="imgWrap blue">
						<a href="{{ asset('pages/'.$birth->slug) }}"><img src="{!! asset('assets/frontend/images/icon-birth.png') !!}" alt="birth" /></a>
					</div>
					<h3><a href="{{ asset('pages/'.$birth->slug) }}">{{$service_sections[3]->title}}</a></h3>
					<p>{!! $service_sections[3]->body !!}</p>
				</div>
			</div>
			<div class="col-12 col-lg-4" id="continued_care">
				<div class="contWrap">
					<div class="imgWrap yellow">
						<a href="{{ asset('pages/'.$continuedcare->slug) }}"><img src="{!! asset('assets/frontend/images/icon-care.png') !!}" alt="continued care" /></a>
					</div>
					<h3><a href="{{ asset('pages/'.$continuedcare->slug) }}">{{$service_sections[4]->title}}</a></h3>
					<p>{!! $service_sections[4]->body !!}</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="secHow themelight cover" style="background-image: url( {!! asset('assets/frontend/images/bg-howitworks.jpg') !!} );">
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-12 col-lg-6">
				<div class="leads">
					<h2>{{$services[2]->title}}</h2>
					<p>{!! $services[2]->body !!}</p>
				</div>
				<ul>
					<li>
						<div class="imgWrap">
							<a href="{{ asset('pages/'.$learnaboutservices->slug) }}"><img src="{!! asset('assets/frontend/images/icon-notes.png') !!}" alt="notes.png" /></a>
						</div>
						<a href="{{ asset('pages/'.$learnaboutservices->slug) }}">{{$service_sections[5]->title}}: {!! $service_sections[5]->body !!}</a>
					</li>
					<li>
						<div class="imgWrap">
							<a href="{{ asset('providers') }}"><img src="{!! asset('assets/frontend/images/icon-link.png') !!}" alt="link" /></a>
						</div>
						<a href="{{ asset('providers') }}">{{$service_sections[6]->title}}: {!! $service_sections[6]->body !!}</a>
					</li>
					<li>
						<div class="imgWrap">
							<a href="{{ asset('find-registry') }}"><img src="{!! asset('assets/frontend/images/icon-baby.png') !!}" alt="baby" /></a>
						</div>
						<a href="{{ asset('find-registry') }}">{{$service_sections[7]->title}}: {!! $service_sections[7]->body !!}</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="secBlog themelight">
	<div class="container">
		<div class="row">
			<div class="col-12 leads leadFlex">
				<div class="contentWrap">
					<h2>{{$services[3]->title}}</h2>
					<p>{!! $services[3]->body !!}</p>
				</div>
				<div class="buttonWrap">
					<i class="fas fa-chevron-left prevButton"></i>
					<i class="fas fa-chevron-right nextButton"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="carouselBlog">
		@foreach ($blogs as $key => $record)
		<div class="boxBlog">
			<div class="imgBlog cover" style="background-image: url(' {!! asset(uploadsDir('admin/blogs') . $record->blog_media) !!} ');">
				<a href="{{ route('blog-post', ['id' => $record->id]) }}"></a>
				<ul class="metaCatg">
					<li><form method="POST" action="{{ route('blog-category') }}" class="signin-form" enctype="multipart/form-data">
					@csrf
					<input type="submit" name = "search_keyword" class="fas fa-tag btn btn-primary" value="{!! $record->blog_category_name !!}">
						</form></li>
				</ul>
			</div>

			<div class="contBlog">
				<h3>{!! $record->title !!}</h3>
				<p>{!! limit_char(strip_tags($record->content),70) !!} <a class="moreBlog" href="{{ route('blog-post', ['id' => $record->id]) }}">read more</a></p>
				<?php /*
					<div class="form-group">
						<a href="{{ route('blog-post', ['id' => $record->id]) }}" class="form-control submit">Read More</a>
					</div>
				*/ ?>
			</div>
		</div>
		@endforeach


	</div>
</section>

<section class="secTestimonials cover" style="background-image: url(' {!! asset('assets/frontend/images/bg-testimonials.jpg') !!} ');">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="leads themedark">
					<h2>{{$services[4]->title}}</h2>
					<p>{!! $services[4]->body !!} </p>
				</div>
				<div class="carouselTestimonial">
					@foreach($testimonials as $key => $testimonial)
					<div class="boxTestimonial">
						<div class="headTestimonial">
							<div class="authorInfo">
								@if($testimonial->media_image)
								<div class="imgWrap cover" style="background-image: url(' {!! asset(uploadsDir('admin/testimonials') . $testimonial->media_image) !!} ');"></div>
								@else

								<div class="imgWrap cover" style="background-image: url(' {!! asset('assets/frontend/images/avatar.png')!!}');"></div>

								@endif


								<h3>
									<b>{!! $testimonial->full_name !!}</b>
									<span>{!! $testimonial->designation ? $testimonial->designation : '--' !!}</span>
								</h3>
							</div>
							<div class="quote"></div>
						</div>
						<p>{!! $testimonial->content !!}</p>
					</div>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>

@endsection