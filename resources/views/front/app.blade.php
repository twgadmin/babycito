<!doctype html>
<html lang="en">
<head>

@if(env('GoogleAnalyticsObject'))
<script async src="https://www.googletagmanager.com/gtag/js?id=G-D57V3H55C4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-D57V3H55C4');
</script>

@endif

<title>@yield('page-title')</title>
<link rel="icon" type="image/png" href="{!! asset('assets/frontend/images/favicon.png') !!}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta property="og:title" content="Baby Cito - Help is here!" />
<meta property="og:description" content="We believe that all constellations of families should be empowered with knowledge and resources to access the services they need." />
<meta property="og:image" content="{!! asset('assets/frontend/images/babycito.jpg') !!}" />
<link rel="stylesheet" href="{!! asset('assets/frontend/css/style.css') !!}">
<!-- BEGIN: Toastr CSS-->
<link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/vendors/css/extensions/toastr.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/css/plugins/extensions/toastr.css') !!}">
<!-- END: Toastr CSS-->

@yield('css')
</head>
<body>
<!-- @if(Request::segment(1) != "login" && Request::segment(1) != "register" && Request::segment(1) != "password" && Request::segment(1) != "contact-us" && Request::segment(1) != "find-registry")
@endif -->
@include('front/layouts/header')
<!-- Logout -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
@method('POST')
</form>
<!-- page-content -->
@yield('content')
<!-- Footer -->
@include('front/layouts/footer')
<script src="{!! asset('assets/frontend/js/main.js') !!}"></script>
<script src="{!! asset('assets/admin/app-assets/vendors/js/extensions/toastr.min.js') !!}"></script>
<script src="{!! asset('assets/admin/app-assets/js/scripts/extensions/toastr.js') !!}"></script>
<script>
	$('.blog_search').click(function(){

		if(jQuery('.searchDesktop').css("visibility") == "visible"){
			$('.searchDesktop').css({
			"visibility" : "hidden",
			"opacity" : 0,
			"z-index" :0,
		});
		}else{
			$('.searchDesktop').css({
			"visibility" : "visible",
			"opacity" : 1,
			"z-index" : 100,
		});
		}
		
	});

	$('.img-wrap .close').on('click', function() {
	    var id = $(this).closest('.img-wrap').find('img').data('id');
	    var userid = $(this).closest('.img-wrap').find('img').data('userid');
	    var conf = confirm("Are you sure you want to delete this image from media gallery!");
	    alert(conf+' '+userid+' '+id);
			if (conf===true) {
					formData = new FormData();
					formData.append('id', id);
					formData.append('_token', $('input[name=_token]').val());
					formData.append('_method', 'POST');
					debugger;
					$.ajax({
						type: "POST",
		        url: "{{ route('delete.media.images') }}",
		        data: formData,
		        processData: false,
		        contentType: false,
		        success: function(data) {

		        		debugger;
		        }
		      });
					//$("#removeImage"+id).remove();
			}			
			ret
			location.href = "{!! url('editUser') !!}/"+userid;
			return false;
	});
</script>
@include('admin.partials.errors')
@yield('js')
</body>
</html>