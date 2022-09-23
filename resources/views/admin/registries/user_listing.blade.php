@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registries Listing <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Service Title</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($user->custom_service as $key => $custom_service)
	                                    <tr>
	                                        <td>{!! $custom_service->services_title !!}</td>
	                                        <td>{!! $custom_service->amount !!}</td>
                                            <td>{!! isset($custom_service->description) ? $custom_service->description : "N/A"!!}</td>
	                                        <td>{!! $custom_service->pivot->status == 1 ? 'Approved' : "Not Approved" !!}</td>
                                            <td>
	                                        	{{--<a href="{!! route('admin.registry.show', $custom_service->id) !!}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-search"></i>
                                                </a>--}}
                        
	                                        	<a href="{!! route('admin.registry.edit', $custom_service->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="feather icon-edit"></i>
                                                </a>

	                                        	<button type="button" onclick="deleteConfirmation({!! $custom_service->id !!})" class="btn btn-danger btn-sm waves-effect waves-light">
                                                    <i class="feather icon-trash"></i>
                                                </button>

                                                <form action="{!! URL::route('admin.registry.destroy', $custom_service->id) !!}" method="POST" id="deleteForm{!! $custom_service->id !!}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="user_id" value="{{$custom_service->pivot->user_id}}">
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
<!-- Column selectors with Export Options and print table -->
@endsection