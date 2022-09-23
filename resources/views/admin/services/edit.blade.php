@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$data->title}} <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.services.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="page_title">Title *</label>
                                            <input type="text" id="title" name="title" maxlength="190" value="{{ old('title', $data->title) }}" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                            
                            
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="content">Content *</label>
                                            <textarea name="body" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('body', $data->body) }}</textarea>
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

                    @if(count($data->serviceSection) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data->serviceSection as $key => $service)
	                                    <tr>
	                                        <td>{!! $service->title !!}</td>
	                                        <td>{!! $service->body !!}</td>
	                                        <td>
	                                        	<a href="{!! route('admin.service_sections.show', $service->id) !!}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-search"></i>
                                                </a>

	                                        	<a href="{!! route('admin.service_sections.edit', $service->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light">
                                                    <i class="feather icon-edit"></i>
                                                </a>

	                                        </td>
	                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       	</div>

                        @endif
                   
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