@extends('front.app')

@section('page-title', 'Add New Service')

@section('content')

<section class="secPagetemp3 cover" style="background-image: url( {!! asset('assets/frontend/images/bgcheckout.jpg') !!} );">
	<div class="container">

		<div class="wrapPt3A">
			<div class="imgWrap cover" style="background-image: url( {!! asset('assets/frontend/images/service.jpg')  !!} );">
			</div>
			<div class="textWrap photoBlock">
				<h2>Add Custom Service</h2>
			</div>
		</div>
		<div class="wrapPt3B">

			<form method="POST" action="{{ route('custom-services') }}" class="signin-form" enctype="multipart/form-data">
				@csrf
				@method('POST') 
				<div class="form-group mb-3">
					<input type="text" name="services_title" class="form-control" value="{{ old('services_title',(isset($custom_services->services_title)&&$custom_services->services_title!='' ? $custom_services->services_title : "")) }}" placeholder="service title" required>
					@error('services_title')
						<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>
				
				<div class="row">
					<div class="col-12 col-lg-6">
						<div class="form-group mb-3">
							<select name="category[]" class="form-control js-example-basic-single" placeholder="Select all options that apply" multiple>
								<option>Select all options that apply</option>
								@foreach($categories as $key=>$category)
								<option  value="{{$category->id}}" {{ (isset($custom_services_selected_categories[$category->id])&&$custom_services_selected_categories[$category->id]!='' ? "selected" : "" ) }} >{{$category->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-12 col-lg-6">
						<div class="form-group mb-3">
							<input type="text" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="amount requested">
							@error('amount')
								<span class="error text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
				</div>
				@if($user->user_type=='1')
				<div class="row">
					<div class="col-12 col-lg-6">
						<div class="form-group mb-3">
							    <select name="qty" placeholder="Quantity" class="form-control" required="">
                                    <option value="">Select Quantity</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>                                    
                                </select>
							@error('qty')
								<span class="error text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
					
				</div>
				@endif
				@if($user->user_type=='2')
					<div class="form-group mb-3">
						<label class="checkbox-wrap checkbox-primary mb-0">Click here to show pricing for this service on your page.
						<input type="checkbox" {{ (old('show_amount')=='1'? 'checked' : "") }} name="show_amount" id="show_amount">
						<span class="checkmark"></span>
						</label>					
					</div>
				@endif
				<div class="form-group mb-3">
					<textarea class="form-control ckeditor" name="description" id="" cols="30" rows="8" placeholder="message">{{ old('description',(isset($custom_services->description)&&$custom_services->description!='' ? $custom_services->description : "")) }}</textarea>
				</div>
				<div class="col-sm-8">
					<div class="form-group mb-3">
						<label for="filename">Media </label>
						<input type="file" name="filename" value="{{ old('filename') }}" class="form-control">
						@if(isset($custom_services->filename)&&$custom_services->filename!='')
						<div class="mediaUploads">
							<input type="hidden" name="previous_filename" value="{!! $custom_services->filename !!}">
							<img src="{!! asset(uploadsDir('front/custom_services/registry_images'). $custom_services->filename ) !!}" width="150" height="150">
						</div>
						@endif
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="form-control submit w-100">add new service</button>
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
