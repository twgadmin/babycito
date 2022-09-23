@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Page <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pages.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="page_title">Page Title *</label>
                                            <input type="text" id="page_title" name="page_title" maxlength="190" value="{{ old('page_title', $data->page_title) }}" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="slug">Slug *</label>
                                            <input type="text" id="slug" name="slug" maxlength="190" value="{{ old('slug', $data->slug) }}"  class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title *</label>
                                            <input type="text" name="meta_title" maxlength="190" value="{{ old('meta_title', $data->meta_title) }}"  class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Is System Page ?</label>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch4" name="is_system_page" value="1" {{ matchChecked(1, $data->is_system_page) }}>
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <a href="{!! URL::route('admin.media-files.create') !!}" target="blank">Add New Media</a>

                                             @if (isset($mediaFiles) && count($mediaFiles) > 0)
                                                @foreach ($mediaFiles as $media)
                                                <label>
                                                    <input type="radio" name="media_file_id" value="{!! $media->id !!}" data='{!! asset(uploadsDir('front') . $media->filename) !!}' {{ matchChecked($data->media_file_id, $media->id) }}>
                                                    <img height="50" width="150" src="{!! asset(uploadsDir('front') . $media->filename) !!}">
                                                </label>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="content">Content *</label>
                                            <textarea name="content" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('content', $data->content) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description *</label>
                                            <textarea name="meta_description" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('meta_description', $data->meta_description) }}</textarea>
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
    $( "#page_title" ).blur(function() {
        var value = $( this ).val();
        $('#slug').val(slugify(value));
    }).blur();

    function slugify(text)
    {
      return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           // Replace spaces with -
        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')             // Trim - from start of text
        .replace(/-+$/, '');            // Trim - from end of text
    }
</script>
@endsection