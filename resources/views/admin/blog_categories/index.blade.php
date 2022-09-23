@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog Category List <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Meta Robots</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $category)
	                                    <tr>
                                            <td>{!! $category->id !!}</td>
                                            <td>{!! $category->name !!}</td>
                                            <td>
                                                <?php
                                                    $metaRobots   = []; // declaring empty array
                                                    $metaRobots[] = $category->is_index == 1 ? '<font color="blue"><b>Index</b></font>' : '<font color="red"><b>Noindex</b></font>';
                                                    $metaRobots[] = $category->is_follow == 1 ? '<font color="blue"><b>Follow</b></font>' : '<font color="red"><b>Nofollow</b></font>';
                                                ?>
                                                {!! implode(', ', $metaRobots) !!}
                                            </td>
	                                        <td>
	                                        	<a href="{!! route('admin.blog-categories.show', $category->id) !!}" class="btn btn-info btn-sm waves-effect waves-light"><i class="feather icon-search"></i></a>

	                                        	<a href="{!! route('admin.blog-categories.edit', $category->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="feather icon-edit"></i></a>

	                                        	<button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deleteConfirmation({!! $category->id !!})"><i class="feather icon-trash"></i></button>

	                                        	<form action="{!! URL::route('admin.blog-categories.destroy', $category->id) !!}" method="POST" id="deleteForm{!! $category->id !!}">
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