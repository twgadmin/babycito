@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Categories <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $category)
	                                    <tr>
	                                        <td>{!! $category->name !!}</td>
	                                        <td>{!! $category->slug !!}</td>
	                                        <td>
	                                        	<a href="{!! route('admin.category.show', $category->id) !!}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-search"></i>
                                                </a>


	                                        	<a href="{!! route('admin.category.edit', $category->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="feather icon-edit"></i>
                                                </a>

	                                        	<button type="button" onclick="deleteConfirmation({!! $category->id !!})" class="btn btn-danger btn-sm waves-effect waves-light">
                                                    <i class="feather icon-trash"></i>
                                                </button>

                                                <form action="{!! URL::route('admin.category.destroy', $category->id) !!}" method="POST" id="deleteForm{!! $category->id !!}">
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
<!-- Column selectors with Export Options and print table -->
@endsection