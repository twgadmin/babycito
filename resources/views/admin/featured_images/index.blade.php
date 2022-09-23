@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Featured Image List <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Heading 1</th>
                                        <th>Heading 2</th>
                                        <th>Description</th>
                                        <th>Read More Link</th>
                                        <th>Media Image</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $image)
                                    <tr>
                                        <td>{!! $image->id !!}</td>
                                        <td>{!! $image->heading1 !!}</td>
                                        <td>{!! $image->heading2 !!}</td>
                                        <td>{!! Str::words(strip_tags($image->description), 7) !!}</td>
                                        <td>{!! $image->read_more_link !!}</td>

                                        <td>
                                            @if($image->media_image != '' && file_exists(uploadsDir('admin/featured-images') . $image->media_image))
                                            <img height="75" width="75" src="{!! asset(uploadsDir('admin/featured-images').$image->media_image) !!}">
                                            @endif
                                        </td>
                                        <td>{!! ($image->is_active) ? 'Yes' : 'No' !!}</td>
                                        <td>
                                            <a href="{!! route('admin.featured-images.show', $image->id) !!}" class="btn btn-info btn-sm waves-effect waves-light"><i class="feather icon-search"></i></a>

                                            <a href="{!! route('admin.featured-images.edit', $image->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="feather icon-edit"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deleteConfirmation({!! $image->id !!})"><i class="feather icon-trash"></i></button>

                                            <form action="{!! URL::route('admin.featured-images.destroy', $image->id) !!}" method="POST" id="deleteForm{!! $image->id !!}">
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