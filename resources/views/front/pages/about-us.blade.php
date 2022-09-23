@extends('front.app')

@section('page-title', 'About Us')

@section('content')

<section class="secAbout">
	<div class="container">
		@if (!empty($pages->mediaFiles->filename) && $pages->mediaFiles->filename != '' && file_exists(uploadsDir('front') . $pages->mediaFiles->filename))
			<img class="imgfull" src="{!! asset(uploadsDir('front') . $pages->mediaFiles->filename) !!}" alt="" />
		@else
			<img class="imgfull" src="{!! asset('assets/frontend/images/aboutus.jpg') !!}" alt="" />
		@endif
		@if(!empty($pages->meta_title))
			<h2 class="page-title">{!! $pages->meta_title!!}</h2>
		@else
			<h2 class="page-title">building babycito</h2>
		@endif

		
		@if(!empty($pages->content))
			<p>{!! $pages->content !!}</p>
		@else
			<p>Need to add the content !!!</p>
		@endif

		<!-- <p class="author"><span>Lindsay Bermudez</span>Founder, babycito</p> -->

	</div>
</section>

@endsection