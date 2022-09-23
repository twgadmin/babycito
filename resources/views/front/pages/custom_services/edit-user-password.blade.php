@extends('front.app')

@section('page-title', 'Update User')

@section('content')
<style type="text/css">
.img-wrap {
    position: relative;
    display: inline-block;
    font-size: 0;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap:hover .close {
    opacity: 1;
    color: #000;
}
</style>
<section class="secPagetemp3 cover" style="background-image: url( {!! asset('assets/frontend/images/bgcheckout.jpg') !!} );">
	<div class="container">

		<!-- <h2 class="photoTitle">Update User</h2> -->
        <div class="wrapPt3A">
            @if(!empty($user->services_image) && $user->services_image != '' && file_exists(uploadsDir('front/user_services_images') . $user->services_image))
                <div class="imgWrap cover" style="background-image: url( {!! asset(uploadsDir('front/user_services_images').$user->services_image) !!} );">
			    </div>
            @else
            <div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/provider01.jpg') !!} );">
			</div>
            @endif
            
			<div class="textWrap photoBlock">
				<h2>{!! $user->first_name . ' ' . $user->last_name !!}</h2>
				<p>{!! $user->services_body !!}</p>
			</div>
		</div>
       
		<div class="wrapPt3B">
			<form method="POST" action="{{ route('update-user-password',$user->id) }}" class="signin-form" enctype="multipart/form-data">
				@csrf
				@method('PUT') 
				<div class="form-group mb-3">
					<input type="password" name="current_password" class="form-control" value="" placeholder="Current Password" required>
					@error('current_password')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group mb-3">
					<input type="password" name="password" class="form-control" value="" placeholder="New Password" required>
					@error('password')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
					<span class="note">the password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.</span>
				</div>

				<div class="form-group mb-3">
					<input type="password" name="password_confirmation" class="form-control" value="" placeholder="Confirm New Password" required>
					@error('password_confirmation')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<button type="submit" class="form-control submit w-100">update</button>
				</div>
			</form>
			
		</div>

	</div>
</section>
@endsection
<script type="text/javascript" src="{!! URL::to('assets/admin/app-assets/plugins/ckeditor/ckeditor.js') !!}"></script>
<script type="text/javascript">
function uploadclick(){
    $("#uploadFile").click();
    $("#uploadFile").change(function(event) {
          readURL(this);
        $("#uploadTrigger").html($("#uploadFile").val());
    });
}
</script>
