@extends('admin.layouts.app')
@section('css')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem !important; }
  .toggle.ios .toggle-handle { border-radius: 20rem !important; }
  .slow  .toggle-group { transition: left 0.7s !important; -webkit-transition: left 0.7s !important; }
</style>
@stop
@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Featured Image <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.featured-images.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="heading1">Heading 1 *</label>
                                            <input type="text" name="heading1" value="{!! old('heading1', $data->heading1) !!}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="heading1">Heading 2 *</label>
                                            <input type="text" name="heading2" value="{!! old('heading@', $data->heading2) !!}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="heading1">Description *</label>
                                            <input type="text" name="description" value="{!! old('description', $data->description) !!}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="heading1">Read More Link *</label>
                                            <input type="text" name="read_more_link" value="{!! old('read_more_link', $data->read_more_link) !!}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="media_image">Media *</label>
                                            <input type="file" name="media_image" class="form-control" />
                                            <input type="hidden" name="previous_image" value="{!! $data->media_image !!}" />
                                             @if ($data->media_image != '' && file_exists(uploadsDir('admin/featured-images') . $data->media_image))
                                                <input type="hidden" name="previous_image" value="{!! $data->media_image !!}" class="form-control">
                                                <img src="{!! asset(uploadsDir('admin/featured-images') . $data->media_image) !!}" height="150" width="150">
                                            @endif
                                        </div>
                                    </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="is_active">Is Active</label>
                                            <div class="col-md-2">
                                            <input type="checkbox" id="is_active" name="is_active" {!! $data->is_active ? 'checked' : ''!!} data-toggle="toggle" data-style="ios slow" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                                        </div>
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

@section('footer-js')
<script type="text/javascript" src="{!! URL::to('assets/admin/app-assets/plugins/ckeditor/ckeditor.js') !!}"></script>
<script src="{!! URL::to('assets/admin/app-assets/js/core/app.js') !!}"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@stop
