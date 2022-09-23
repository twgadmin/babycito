@extends('front.app')

@section('page-title', 'Update Service')

@section('content')

<section class="secPagetemp3 cover" style="background-image: url( {!! asset('assets/frontend/images/bgcheckout.jpg') !!} );">
	<div class="container">

		<div class="wrapPt3A">
			<div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/service.jpg') !!} );">
			</div>
			<div class="textWrap photoBlock">
				<h2>Update Custom Service</h2>
			</div>
		</div>
		<div class="wrapPt3B">


			<form method="POST" action="{{ route('custom-services.update',$custom_service->id) }}" class="signin-form" enctype="multipart/form-data">
				@csrf
				@method('PUT') 
				<div class="form-group mb-3">
					<input type="text" name="services_title" class="form-control" value="{{ old('services_title',$custom_service->services_title) }}" placeholder="service title" required>
					@error('services_title')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>
				
				<div class="row">
					<div class="col-12 col-lg-6">
						<div class="form-group mb-3">
							<select name="category[]" class="form-control js-example-basic-single" placeholder="category" multiple>
								<option>Select all options that apply</option>
								@foreach($categories as $key=>$category)
								<option  value="{!! $category->id !!}" {!! in_array($category->id,$selected_category) ? 'selected' : '' !!}>{!! $category->name !!}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-12 col-lg-6">
						<div class="form-group mb-3">
							<input type="text" name="amount" class="form-control" value="{{ old('amount',$custom_service->amount) }}" placeholder="amount requested"> <?php /*  readonly */ ?>
							@error('amount')
								<span class="error text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</div>
				@if($userdetail->user_type=='2')
				<div class="form-group mb-3">
					<label class="checkbox-wrap checkbox-primary mb-0">Click here to show pricing for this service on your page.
					<input type="checkbox" {{ (old('show_amount',$custom_service->show_amount)=='1'? 'checked' : "") }} name="show_amount" id="show_amount">
					<span class="checkmark"></span>
					</label>					
				</div>
				@endif
				<div class="form-group mb-3">
					<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="8" placeholder="message">{!! old('description',$custom_service->description) !!}</textarea>
				</div>

				<div class="col-sm-8">
					<div class="form-group mb-3">
						<label for="filename">Media </label>
						<input type="file" name="filename" value="{{ old('filename') }}" class="form-control">
						<div class="mediaUploads">
						<input type="hidden" name="previous_filename" value="{!! $custom_service->filename !!}" />
							@if (!empty($custom_service->filename) && $custom_service->filename != '' && file_exists(uploadsDir('front/custom_services/registry_images') . $custom_service->filename))
							<input type="hidden" name="previous_filename" value="{!! $custom_service->filename !!}" class="form-control">
							<img src="{!! asset(uploadsDir('front/custom_services/registry_images') . $custom_service->filename) !!}" height="150" width="150">
							@endif
					</div>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="form-control submit w-100">update service</button>
				</div>
			</form>
			
		</div>

	</div>
</section>

@endsection

@section('js')
<script type="text/javascript" src="{!! URL::to('assets/admin/app-assets/plugins/ckeditor/ckeditor.js') !!}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
	
	$('.js-example-basic-single').select2({
  placeholder: 'Select all options that apply'
});
</script>
@endsection