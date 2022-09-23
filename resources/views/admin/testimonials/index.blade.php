@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Testimonial List <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Content</th>
                                        <th>Is Featured</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $testimonial)
	                                    <tr>
                                            <td>{!! $testimonial->id !!}</td>
                                            <td>{!! $testimonial->full_name !!}</td>
                                            <td>{!! Str::words(strip_tags($testimonial->content), 5) !!}</td>
                                            <td>{!! $testimonial->is_featured ? 'Yes' : 'No' !!}</td>
	                                        <td>
	                                        	<!-- <a href="{!! route('admin.testimonials.show', $testimonial->id) !!}" class="btn btn-info btn-sm waves-effect waves-light"><i class="feather icon-search"></i></a> -->

	                                        	<a href="{!! route('admin.testimonials.edit', $testimonial->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="feather icon-edit"></i></a>

	                                        	<button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deleteConfirmation({!! $testimonial->id !!})"><i class="feather icon-trash"></i></button>

	                                        	<form action="{!! URL::route('admin.testimonials.destroy', $testimonial->id) !!}" method="POST" id="deleteForm{!! $testimonial->id !!}">
			                                        @csrf
			                                        @method('DELETE')
			                                    </form>

	                                        </td>
	                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection