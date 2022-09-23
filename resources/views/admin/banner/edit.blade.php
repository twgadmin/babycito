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
                    <h4 class="card-title">Edit Banner <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.banner.update', $banner->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="title">Title *</label>
                                            <input type="text" name="title" value="{!! old('title', $banner->title) !!}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="description">Content *</label>
                                            <textarea type="text" name="description" class="form-control ckeditor">{{ old('description', $banner->description) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="filename">Media *</label>
                                            <input type="file" name="filename" class="form-control" />
                                            <input type="hidden" name="previous_image" value="{!! $banner->filename !!}" />
                                             @if ($banner->filename != '' && file_exists(uploadsDir('admin/banner') . $banner->filename))
                                                <input type="hidden" name="previous_image" value="{!! $banner->filename !!}" class="form-control">
                                                <img src="{!! asset(uploadsDir('admin/banner') . $banner->filename) !!}" height="150" width="150">
                                            @else
                                            <img src="{!! asset('assets/frontend/images/banner-provider-one.jpg') !!}" height="100" width="100">
                                            @endif
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

<script>

// jQuery
$('[name=tags]').tagify();
$(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@stop
