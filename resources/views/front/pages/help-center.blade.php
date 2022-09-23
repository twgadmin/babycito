@extends('front.app')

@section('page-title', 'Help Center')

@section('content')

	@if (!empty($pages->mediaFiles->filename) && $pages->mediaFiles->filename != '' && file_exists(uploadsDir('front') . $pages->mediaFiles->filename))
	<section class="secBanner themedark overlay" style="background-image: url( {!! asset(uploadsDir('front') . $pages->mediaFiles->filename) !!} );">
	@else
	<section class="secBanner themedark overlay" style="background-image: url( {!! asset('assets/frontend/images/bghelp.jpg') !!} );">
	@endif
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				@if(!empty($pages->page_title))
					<h2>{!! $pages->page_title !!}</h2>
				@else
					<h2>Help Center</h2>
				@endif
				@if(!empty($pages->content))
					<p>{!! $pages->content !!}</p>
				@else
					<p>Need to add content for this !!!</p>
				@endif
			</div>
		</div>
	</div>
</section>
		
<section class="secFAQ">
	<div class="container">
		<h3>Frequently Asked Questions</h3>

		@if(count($aboutbabycitos) > 0)
			@php
			$i = 0;
			@endphp
			<h4>About Babycito</h4>
			<div class="faqWrap">
			@foreach ($aboutbabycitos as $key => $aboutbabycito)		
			@if($i == 0)			
			@php
			$i++;
			@endphp
				<div class="faq active">
					<div class="quest">Q. {!! $aboutbabycito->question !!}</div>
					<div class="ans" style="display:block;">{!! $aboutbabycito->answer !!}</div>
				</div>
			@else
				<div class="faq">
					<div class="quest">Q. {!! $aboutbabycito->question !!}</div>
					<div class="ans">{!! $aboutbabycito->answer !!}</div>
				</div>			
			@endif
			@endforeach	
			</div>	
		@endif
		
		@if(count($registries) > 0)
			@php
			$i = 0;
			@endphp
			<h4>Registry Users</h4>
			<div class="faqWrap">
			@foreach ($registries as $key => $registry)		
			@if($i == 0)			
			@php
			$i++;
			@endphp
				<div class="faq active">
					<div class="quest">Q. {!! $registry->question !!}</div>
					<div class="ans" style="display:block;">{!! $registry->answer !!}</div>
				</div>
			@else
				<div class="faq">
					<div class="quest">Q. {!! $registry->question !!}</div>
					<div class="ans">{!! $registry->answer !!}</div>
				</div>			
			@endif
			@endforeach	
			</div>	
		@else
			<div class="faqWrap">
			<div class="faq active">
				<div class="quest">Q. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do?</div>
				<div class="ans" style="display:block;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
			<div class="faq">
				<div class="quest">Q. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do?</div>
				<div class="ans">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
			<div class="faq">
				<div class="quest">Q. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do?</div>
				<div class="ans">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
				
			</div>
		@endif

		@if(count($providers) > 0)
			@php
			$i = 0;
			@endphp
			<h4>Providers</h4>
			<div class="faqWrap">
			@foreach ($providers as $key => $provider)		
			@if($i == 0)			
			@php
			$i++;
			@endphp
				<div class="faq active">
					<div class="quest">Q. {!! $provider->question !!}</div>
					<div class="ans" style="display:block;">{!! $provider->answer !!}</div>
				</div>
			@else
				<div class="faq">
					<div class="quest">Q. {!! $provider->question !!}</div>
					<div class="ans">{!! $provider->answer !!}</div>
				</div>			
			@endif
			@endforeach	
			</div>	
		@else
			<div class="faqWrap">
			<div class="faq active">
				<div class="quest">Q. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do?</div>
				<div class="ans" style="display:block;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
			<div class="faq">
				<div class="quest">Q. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do?</div>
				<div class="ans">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
			<div class="faq">
				<div class="quest">Q. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do?</div>
				<div class="ans">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
			</div>
				
			</div>
		@endif					

	
	</div>
</section>

@endsection

