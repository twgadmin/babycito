@extends('admin.layouts.app')

@section('content')
<style>
     .imgWrap {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    margin: 0 15px 0 0;
}
.cover {
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
}
    </style>
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Blog Category <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.testimonials.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="media_image">Avatar *</label>
                                            <input type="file" name="media_image" />
                                            <input type="hidden" name="previous_image" value="{!! $data->media_image !!}" />
                                             @if ($data->media_image != '' && file_exists(uploadsDir('admin/testimonials') . $data->media_image))
                                                <input type="hidden" name="previous_image" value="{!! $data->media_image !!}" class="form-control">
                                                <img class="imgWrap cover" src="{!! asset(uploadsDir('admin/testimonials') . $data->media_image) !!}" >
                                            @endif
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Full Name *</label>
                                            <input type="text" name="full_name" value="{{ old('full_name', $data->full_name) }}" class="form-control">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Designation *</label>
                                            <input type="text" name="designation" value="{{ old('designation', $data->designation) }}" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="content">Content *</label>
                                            <input type="text" name="content" value="{{ old('content', $data->content) }}" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="is_featured">Is Featured</label>
                                            <div class="col-md-8">
                                                <input type="checkbox" id="is_featured" name="is_featured" data-toggle="toggle" data-style="ios slow" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" {{$data->is_featured == 1 ? "checked" : ""}}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection