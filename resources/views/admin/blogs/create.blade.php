@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{!! asset('assets/admin/app-assets/css/jquery.datetimepicker.css') !!}"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem !important; }
  .toggle.ios .toggle-handle { border-radius: 20rem !important; }
  .slow  .toggle-group { transition: left 0.7s !important; -webkit-transition: left 0.7s !important; }
</style>
</style>
@stop

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Blog <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blogs.store') }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="title">Title *</label>
                                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="content">Content *</label>
                                            <textarea type="text" name="content" class="form-control ckeditor">{{ old('content') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="blog_media">Media </label>
                                            <input type="file" name="blog_media" value="{{ old('blog_media') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="blog_category_id">Category *</label>
                                            <select class="form-control" name="blog_category_id" id="blog_category_id">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option {!! ($category->id==old('blog_category_id')) ? 'selected' : '' !!} value="{!! $category->id !!}">{!! $category->name !!}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="tags">Tags *</label>
                                            <input type="tags" maxlength="50" name="tags" value="{!! old('tags') !!}" class="form-control">
                                        </div>
                                    </div>

                                    <h4>&nbsp;</h4>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="is_index" >Meta Index </label>
                                            <select class="form-control" name="is_index">
                                                <option value="1">Index</option>
                                                <option value="0">Noindex</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="is_follow">Meta Follow </label>
                                        <select class="form-control" name="is_follow">
                                            <option value="1">Follow</option>
                                            <option value="0">Nofollow</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="is_featured">Is Featured</label>
                                            <div class="col-md-8">
                                            <input type="checkbox" id="is_featured" name="is_featured" data-toggle="toggle" data-style="ios slow" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                                        </div>
                                        </div>
                                    </div>

                                </div>
                                    
                                </div>
                            </fieldset>
                            
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add</button>
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
