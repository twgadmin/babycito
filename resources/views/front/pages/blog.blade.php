@extends('front.app')

@section('page-title', 'Blog')

@section('content')

<section class="secBanner themedark" style="background-image: url(' {!! asset('assets/frontend/images/hero-blog.jpg') !!} ');">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12">
				<h2>babycito blog</h2>
				<p>Check out our blogs for the latest on Northern Virginia services, parenting tips, provider spotlights, and more!</p>
				<!-- <a class="button" href="/blog">read more</a> -->
			</div>
		</div>
	</div>
</section>

<section class="secBlog themelight">
	<div class="container">
		<div class="row">
			<div class="col-12 leads leadFlex">
				<div class="contentWrap">
					<h2>@if(@isset($data_category)) blog in "<span>{{ request()->search_keyword}}</span>" category 
					@elseif(request()->q)
					Showing results for <span>{{ request()->q}}</span> in blogs
					@else recent <span>blogs</span> @endif</h2>
					<p>Check out our blogs for the latest on Northern Virginia services, parenting tips, provider spotlights, and more!</p>
				</div>
			</div>
		</div>

		@foreach ($data as $key => $record)
		<div class="listBlog">
			@if($record->blog_media != '' && file_exists(uploadsDir('admin/blogs') . $record->blog_media))
				<div class="banner-blog cover" style="background-image: url( {!! asset(uploadsDir('admin/blogs').$record->blog_media) !!} );">
					
					<ul class="metaCatg">
					@php
					$tags = explode(",",$record->tags);
					@endphp
					@foreach($tags as $tag)						
						<li><a href="#">{!! $tag !!}</a></li>
					@endforeach
					</ul>
				</div>
			@endif
			<h3><a href="{{ route('blog-post', ['id' => $record->id]) }}">{!! $record->title !!}</a></h3>
			<div class="metaBlog">
				<ul>
					<li><i class="fas fa-calendar"></i><span>{!! date('M d, Y', strtotime($record->created_at)); !!}</span></li>
					<li><form method="POST" action="{{ route('blog-category') }}" class="signin-form" enctype="multipart/form-data">
					@csrf
					<i class="fas fa-tag"></i><span><input type="submit" name="search_keyword" value="{!! $record->blog_category_name !!}"></span>
					</form></li>
					<li><i class="fas fa-user"></i><span>admin</span></li>
				</ul>
			</div>
			<p>{!! Str::words(strip_tags($record->content), 40) !!} <a href="{{ route('blog-post', ['id' => $record->id]) }}">read more</a></p>
		</div>
		@endforeach
		{{$data->links()}}
		<!-- <div class="pagination">
			<ul>
				<li><span>First</span></li>
				<li><span class="active">1</span></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">..</a></li>
				<li><a href="#">30</a></li>
				<li><a href="#">Last</a></li>
			</ul>
		</div> -->

	</div>
</section>

@endsection