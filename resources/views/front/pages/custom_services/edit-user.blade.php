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
			<form method="POST" action="{{ route('update-user',$user->id) }}" class="signin-form" enctype="multipart/form-data">
				@csrf
				@method('PUT') 
				<div class="form-group mb-3">
					<input type="text" name="title" class="form-control" value="{{ old('title',$user->services_title) }}" placeholder="business name" required>
					@error('services_title')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group mb-3">
					<input type="text" name="first_name" class="form-control" value="{{ old('first_name',$user->first_name) }}" placeholder="first name" required>
					@error('fist_name')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group mb-3">
					<input type="text" name="last_name" class="form-control" value="{{ old('last_name',$user->last_name) }}" placeholder="last name" required>
					@error('last_name')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>


				<div class="form-group mb-3">
					<input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" placeholder="email" disabled>
					@error('email')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>


				<div class="form-group mb-3">
					<input type="text" name="phone" class="form-control" value="{{ old('phone',$user->phone) }}" placeholder="phone">
					@error('phone')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>
				
				<div class="form-group mb-3">
					<textarea class="form-control" name="services_body" id="" cols="30" rows="8" placeholder="Registry Tagline (this will be the short text displayed below your registry title)">{!! old('services_body',$user->services_body) !!}</textarea>
				</div>

				<div class="form-group mb-3">
					<textarea class="form-control ckeditor" name="meta_description" id="" cols="30" rows="8" placeholder="description">{!! old('meta_description',$user->meta_description) !!}</textarea>
				</div>

				<div class="form-group mb-3">
					<label for="services_image">Banner Image *</label>
					<input type="file" name="services_image" class="form-control" />
					<div class="mediaUploads">
						<input type="hidden" name="previous_image" value="{!! $user->services_image !!}" />
							@if (!empty($user->services_image) && $user->services_image != '' && file_exists(uploadsDir('front/user_services_images') . $user->services_image))
							<input type="hidden" name="previous_image" value="{!! $user->services_image !!}" class="form-control">
							<img src="{!! asset(uploadsDir('front/user_services_images') . $user->services_image) !!}" height="150" width="150">
							@endif
					</div>
				</div>

				<div class="form-group mb-3">
					<label for="services_image">Profile Image *</label>
					<input type="file" name="profile_image" class="form-control" />
					<div class="mediaUploads">
						<input type="hidden" name="previous_profile_image" value="{!! $user->profile_image !!}" />
							@if (!empty($user->profile_image) && $user->profile_image != '' && file_exists(uploadsDir('front/users_profile') . $user->profile_image))
							<input type="hidden" name="previous_profile_image" value="{!! $user->profile_image !!}" class="form-control">
							<img src="{!! asset(uploadsDir('front/users_profile') . $user->profile_image) !!}" height="150" width="150">
							@endif
					</div>
				</div>
				@if(auth()->user()->user_type ==2)
				<div class="form-group mb-3">
					<label for="media_images">Media Gallery Images *</label>
					<input type="file" name="media_images[]" class="form-control" multiple />
					<span class="note">Want to add multiple images to your gallery?  No problem!  When you click “Choose Files” a window will appear where you can select images from your computer.  Use the ‘ctrl’ or ‘shift’ keys on your keyboard to select multiple images to add.  You will need to add all your desired images <strong>at the same time</strong>.</span>
					<div class="mediaUploads">
					@foreach($user->mediaImages as $key=>$image)
						<div class="img-wrap" id="removeImage{!! $image->id !!}">						    
						    <input type="hidden" name="previous_media_image[]" value="{!! $image->filename !!}" />
							@if ($image->filename != '' && file_exists(uploadsDir('front/user_media_images') . $image->filename))
								<input type="hidden" name="previous_media_image" value="{!! $image->filename !!}" class="form-control">
								<span class="close">&times;</span>
								<img src="{!! asset(uploadsDir('front/user_media_images') . $image->filename) !!}" height="50" width="50" data-id="{!! $image->id !!}" data-userid="{!! auth()->user()->id !!}">
							@endif
						</div>
					@endforeach
					</div>
				</div>



				<!-- contact info field down below -->

				<div class="form-group mb-3">
					<input type="text" name="contact_email" class="form-control" value="{{ old('website',$user->contact_email) }}" placeholder="Contact Email">
					@error('contact_email')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>


				<div class="form-group mb-3">
					<input type="text" name="website" class="form-control" value="{{ old('website',$user->website) }}" placeholder="website" required>
					@error('website')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>


				
				
				<div class="form-group mb-3">
					<textarea class="form-control" name="location" id="" cols="30" rows="8" placeholder="Address">{!! old('location',$user->location) !!}</textarea>
				</div>
				@endif
					
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
