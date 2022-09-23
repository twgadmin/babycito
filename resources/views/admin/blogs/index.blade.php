@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Blog List <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Admin Name</th>
                                        <th>Meta Robots</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Media</th>
                                        <th>Category</th>
                                        <th>Is Featured</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $record)
	                                    <tr>
                                            <td>{!! $record->id !!}</td>
                                            <td>{!! $record->admin_name !!}</td>
                                            <td>
                                                <?php
                                                    $metaRobots   = []; // declaring empty array
                                                    $metaRobots[] = $record->is_index == 1 ? '<font color="blue"><b>Index</b></font>' : '<font color="red"><b>Noindex</b></font>';
                                                    $metaRobots[] = $record->is_follow == 1 ? '<font color="blue"><b>Follow</b></font>' : '<font color="red"><b>Nofollow</b></font>';
                                                ?>
                                                {!! implode(', ', $metaRobots) !!}
                                            </td>
                                            <td>{!! $record->title !!}</td>
                                            <td>
                                                {!! Str::words(strip_tags($record->content), 7) !!}
                                            <td>
                                                @if($record->blog_media != '' && file_exists(uploadsDir('admin/blogs') . $record->blog_media))
                                                    <img height="75" width="75" src="{!! asset(uploadsDir('admin/blogs').$record->blog_media) !!}" >
                                                @endif
                                            </td>
                                            <td>{!! $record->blog_category_name !!}</td>
                                            <td>{!! ($record->is_featured) == 1 ? 'Yes':'No' !!}</td>
	                                        <td>
	                                        	<a href="{!! route('admin.blogs.show', $record->id) !!}" class="btn btn-info btn-sm waves-effect waves-light"><i class="feather icon-search"></i></a>

	                                        	<a href="{!! route('admin.blogs.edit', $record->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="feather icon-edit"></i></a>

	                                        	<button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deleteConfirmation({!! $record->id !!})"><i class="feather icon-trash"></i></button>

	                                        	<form action="{!! URL::route('admin.blogs.destroy', $record->id) !!}" method="POST" id="deleteForm{!! $record->id !!}">
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