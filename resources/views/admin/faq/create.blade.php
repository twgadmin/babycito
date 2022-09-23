@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Faq <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.faq.store') }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            
                           
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="content">Question *</label>
                                            <textarea name="question" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('question') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_description">Answer *</label>
                                            <textarea name="answer" maxlength="65000" rows="5" class="form-control ckeditor">{{ old('answer') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Is Active?</label>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch4" name="is_active" value="1">
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                           

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="user_type">User Type *</label>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                            <select class="form-control" name="user_type" id="user_type">
                                                <option value="">Select</option>
                                                <option value="1">Registry</option>
                                                <option value="2">Provider</option>
                                                <option value="3">About babycito</option>
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
                                                <input type="number" class="form-control" name="ordering" placeholder="Ordering">
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

@endsection