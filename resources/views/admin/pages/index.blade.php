@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pages <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Page Title</th>
                                        <th>Content</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $page)
	                                    <tr>
	                                        <td>{!! $page->page_title !!}</td>
	                                        <td>{!! Str::words(strip_tags($page->content), 40) !!} <a href="{!! route('admin.pages.show', $page->id) !!}">read more</a></td>
	                                        <td>
	                                        	<a href="{!! route('admin.pages.show', $page->id) !!}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-search"></i>
                                                </a>

	                                        	<a href="{!! route('admin.pages.edit', $page->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="feather icon-edit"></i>
                                                </a>

	                                        	<button type="button" onclick="deleteConfirmation({!! $page->id !!})" class="btn btn-danger btn-sm waves-effect waves-light">
                                                    <i class="feather icon-trash"></i>
                                                </button>

                                                <form action="{!! URL::route('admin.pages.destroy', $page->id) !!}" method="POST" id="deleteForm{!! $page->id !!}">
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