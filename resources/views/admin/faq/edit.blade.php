@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Faq <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.faq.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="question">Question *</label>
                                            <textarea name="question" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('question', $data->question) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="answer">Answer *</label>
                                            <textarea name="answer" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('answer', $data->answer) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Is Active ?</label>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch4" name="is_active" value="1" {{ matchChecked(1, $data->is_active) }}>
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                        <label for="user_type">User Type *</label>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                            <select class="form-control" name="user_type" id="user_type">
                                            <option value="1" {!! matchSelected(old('user_type', $data->user_type), 1) !!}>Registry</option>
                                            <option value="2" {!! matchSelected(old('user_type', $data->user_type), 2) !!}>Provider</option>
                                            <option value="2" {!! matchSelected(old('user_type', $data->user_type), 3) !!}>About babycito</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </fieldset>


                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Ordering</label>                                           
                                                <input type="number" class="form-control" name="ordering" placeholder="Ordering" value="{{ old('ordering', $data->ordering) }}">
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