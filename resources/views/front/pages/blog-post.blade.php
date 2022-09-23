@extends('front.app')

@section('page-title', 'Single Post')

@section('content')

<section class="secCatg themelight">
	<div class="container">
		<ul>
			@foreach ($blog_categories as $key=>$blog_category)
			<li><form method="POST" action="{{ route('blog-category') }}" class="signin-form" enctype="multipart/form-data">
				@csrf
			<input type="submit" name = "search_keyword" class = "btn btn-primary" value="{!! $blog_category->name !!}">
			</form></li>
			@endforeach
		</ul>
	</div>
</section>

<section class="secBlog themelight">
	<div class="container">

		<div class="listBlog">

			<h3>{!! $data->title !!}</h3>
			<div class="metaBlog">
				<ul>
					<li><i class="fas fa-calendar"></i><span>{!! date('M d, Y', strtotime($data->created_at)); !!}</span></li>
					<li><form method="POST" action="{{ route('blog-category') }}" class="signin-form" enctype="multipart/form-data">
				@csrf
				<i class="fas fa-tag"></i><span>category :<input type="submit" name = "search_keyword" value="{!! $data->blog_category_name !!}"></span>
					</form></li>
					<li><i class="fas fa-user"></i><span>admin</span></li>
				</ul>
			</div>
			@php 
				$b_image = null;
			@endphp
			@if($data->blog_media != '' && file_exists(uploadsDir('admin/blogs') . $data->blog_media))
			@php 
				$b_image = asset(uploadsDir('admin/blogs').$data->blog_media);
			@endphp
				<div class="banner-blog cover" style="background-image: url( {!! asset(uploadsDir('admin/blogs').$data->blog_media) !!} );">
					<ul class="metaCatg">
					@php
					$tags = explode(",",$data->tags);
					@endphp
					@foreach($tags as $tag)						
						<li><a href="#">{!! $tag !!}</a></li>
					@endforeach
					</ul>
				</div>
			@endif

			<div class="content">
				{!! $data->content !!}

			</div>
			
		</div>

	</div>
</section>

<section class="secBlogshare">
	<div class="container">

		<div class="rowBshare">
			<div class="colBshare">
				<ul> 
					@php
						$b_url  = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

					@endphp
					<li><a onClick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $data->title;?>&amp;p[url]=<?php echo $b_url;?>&amp;&p[images][0]=<?php echo $b_image;?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)" href="javascript:;"><i class="fab fa-facebook-f"></i></a></li>
					<li><a onClick="window.open('https://twitter.com/intent/tweet?text=<?php echo $data->title;?>&url=<?php echo $b_url;?>', 'toolbar=0,status=0,width=548,height=325');"  href="javascript:;"><i class="fab fa-twitter"></i></a></li>

				
					<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $b_url;?>&amp;title=<?php echo $data->title;?>&amp;source=babycito" target="_blank" href="javascript:;"><i class="fab fa-linkedin-in"></i></a></li>
					<!-- <li><a onClick="navigator.clipboard.writeText(window.location.href)" href="javascript:;"><i class="fas fa-link"></i></a></li> -->
				</ul>
			</div>

			<div class="colBshare">
				<div class="views">
					<!-- <span>3</span> Views -->
				</div>
			</div>
		</div>

	</div>
</section>

<section class="secRecentBlog">
	<div class="container">

		<div class="wrapPostArea">
			<h2>Recent Posts</h2>
			<div class="rowPost">
				@foreach($recent_blogs as $key=>$recent_blog)
				<div class="colPost">
					<div class="imgPost cover" style="background-image: url( {!! asset(uploadsDir('admin/blogs').$recent_blog->blog_media) !!} );"></div>
					<h3><a href="{{ route('blog-post', ['id' => $recent_blog->id]) }}">{!! $recent_blog->title !!}</a></h3>
					<p>{!! limit_char(strip_tags($recent_blog->content),100) !!} <a href="{{ route('blog-post', ['id' => $recent_blog->id]) }}">read more</a></p>
				</div>
				@endforeach
				
			</div>
		</div>
		
		
	</div>
</section>


@endsection

