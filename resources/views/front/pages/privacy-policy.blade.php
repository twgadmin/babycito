@extends('front.app')

@section('page-title', 'Legal/Privacy Policy')

@section('content')

<section class="secTitleinner">
	<div class="container">
		@if(!empty($pages->page_title))
			<h2>{!! $pages->page_title !!}</h2>
		@else
		    <h2>Legal/Privacy Policy</h2>
		@endif
	</div>
</section>
	@if (!empty($pages->mediaFiles->filename) && $pages->mediaFiles->filename != '' && file_exists(uploadsDir('front') . $pages->mediaFiles->filename))
		<section class="secPagetemp1 cover" style="background-image: url( {!! asset(uploadsDir('front') . $pages->mediaFiles->filename) !!} );">
			<div class="container">
			@if(!empty($pages->content))
				<p>{!! $pages->content !!}</p>
				@else
				<p> Need to add content for this !!! </p>
				@endif
			</div>
		</section>
	@else
		<section class="secPagetemp1 cover" style="background-image: url( {!! asset('assets/frontend/images/bglegal.jpg') !!} );">
			<div class="container">
				@if(!empty($pages->content))
				<p>{!! $pages->content !!}</p>
				@else
				<p> Need to add content for this !!! </p>
				@endif
			</div>
		</section>
	@endif


@endsection