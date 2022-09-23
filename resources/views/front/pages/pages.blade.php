@extends('front.app')

@section('page-title', $pages->page_title)

@section('content')

@if ( request()->segment(2) == 'anticipation' ) 
<section class="secBanner themedark" style="background-image: url('{!! asset('assets/frontend/images/banner-anticipation.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>Anticipation</h2>
				<p>Exciting months leading up to welcoming your newest addition!</p>
			</div>
		</div>
	</div>
</section>
@endif

@if ( request()->segment(2) == 'birth' )
<section class="secBanner themedark" style="background-image: url('{!! asset('assets/frontend/images/banner-birth.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>Birth</h2>
				<p>Arrival of your newest addition!</p>
			</div>
		</div>
	</div>
</section>
@endif

@if ( request()->segment(2) == 'continued-care' ) 
<section class="secBanner themedark" style="background-image: url('{!! asset('assets/frontend/images/banner-continued-care-new.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>Continued Care</h2>
				<p>Services and fun for 3 months and beyond!</p>
			</div>
		</div>
	</div>
</section>
@endif

@if ( request()->segment(2) == 'education' ) 
<section class="secBanner themedark" style="background-image: url('{!! asset('assets/frontend/images/banner-education.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>Education</h2>
				<p>You’re ready to learn more and we’re excited to share our knowledge!</p>
			</div>
		</div>
	</div>
</section>
@endif

@if ( request()->segment(2) == 'how-providers-can-join' ) 
<section class="secBanner themedark" style="background-image: url('{!! asset('assets/frontend/images/banner-join-new.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>Providers: How to Join</h2>
				<p>Join our growing community of families and trusted providers!</p>
				<a class="button" href="https://calendly.com/babycito/babycito-provider-chat" target="_blank">Get Started NOW!</a>
			</div>
		</div>
	</div>
</section>
@endif

@if ( request()->segment(2) == 'one-time-gifts' ) 
<section class="secBanner themedark" style="background-image: url('{!! asset('assets/frontend/images/banner-gifts.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>One-Time Gifts</h2>
				<p>Give a one-time service gift with babycito!</p>
				<a class="button" href="{!! route('one.time.gift') !!}">Give NOW!</a>
			</div>
		</div>
	</div>
</section>
@endif

<section class="secAbout">
	<div class="container">
	
		<!-- @if (!empty($pages->mediaFiles->filename) && $pages->mediaFiles->filename != '' && file_exists(uploadsDir('front') . $pages->mediaFiles->filename))
			<img class="imgfull" src="{!! asset(uploadsDir('front') . $pages->mediaFiles->filename) !!}" alt="" />
		@endif

		@if(!empty($pages->page_title))
			<h2 class="page-title">{!! $pages->page_title!!}</h2>
		@endif -->

		<!-- {{ request()->segment(2) }} -->

		@if(!empty($pages->content))
			{!! $pages->content !!}
		@endif

	</div>
</section>

@endsection