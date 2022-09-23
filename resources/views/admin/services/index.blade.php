@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Services <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($services as $key => $service)
	                                    <tr>
	                                        <td>{!! $service->title !!}</td>
	                                        <td>{!! Str::words(strip_tags($service->body), 40) !!} <a href="{!! route('admin.services.show', $service->id) !!}">read more</a></td>
	                                        <td>
	                                        	<a href="{!! route('admin.services.show', $service->id) !!}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-search"></i>
                                                </a>

	                                        	<a href="{!! route('admin.services.edit', $service->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="feather icon-edit"></i>
                                                </a>

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
<!-- Column selectors with Export Options and print table -->
@endsection