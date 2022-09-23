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
                    <h4 class="card-title">Edit Blog <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blogs.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="title">Title *</label>
                                            <input type="text" name="title" value="{!! old('title', $data->title) !!}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="content">Content *</label>
                                            <textarea type="text" name="content" class="form-control ckeditor">{{ old('content', $data->content) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="blog_media">Media *</label>
                                            <input type="file" name="blog_media" class="form-control" />
                                            <input type="hidden" name="previous_image" value="{!! $data->blog_media !!}" />
                                             @if ($data->blog_media != '' && file_exists(uploadsDir('blogs') . $data->blog_media))
                                                <input type="hidden" name="previous_image" value="{!! $data->blog_media !!}" class="form-control">
                                                <img src="{!! asset(uploadsDir('blogs') . $data->blog_media) !!}" height="150" width="150">
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="blog_category_id">Category *</label>
                                            <select class="form-control" name="blog_category_id" id="blog_category_id">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option value="{!! $category->id !!}" {!! matchSelected($category->id, $data->blog_category_id) !!}>{!! $category->name !!}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="tags">Tags *</label>
                                            <input type="tags" maxlength="50" name="tags" value="{!! old('tags', $data->tags) !!}" class="form-control">
                                        </div>
                                    </div>

                                    <h4>&nbsp;</h4>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_index" >Meta Index </label>
                                            <select class="form-control" name="is_index">
                                                <option value="1" {!! matchSelected(old('is_index', $data->is_index), 1) !!}>Index</option>
                                                <option value="0" {!! matchSelected(old('is_index', $data->is_index), 0) !!}>Noindex</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_follow">Meta Follow </label>
                                            <select class="form-control" name="is_follow">
                                                <option value="1" {!! matchSelected(old('is_follow', $data->is_index), 1) !!}>Follow</option>
                                                <option value="0" {!! matchSelected(old('is_follow', $data->is_index), 0) !!}>Nofollow</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="is_featured">Is Featured</label>
                                            <div class="col-md-2">
                                            <input type="checkbox" id="is_featured" name="is_featured" data-toggle="toggle" data-style="ios slow" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
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

<script>

// jQuery
$('[name=tags]').tagify();
$(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@stop
