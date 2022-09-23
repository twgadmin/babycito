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
                    <h4 class="card-title">Update Service <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.custom_services.update', $custom_service->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')                            
                            <!-- ////////////////////////////////////////////////////////////// -->
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                        <label for="page_title">Title *</label>
                                            <input type="text" id="services_title" name="services_title" maxlength="190" value="{{ old('services_title',$custom_service->services_title) }}" class="form-control">
                                        </div>
                                    </div>                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="show_amount">Click here to show pricing for this service on your page. *</label>
                                            <div class="col-md-2">
                                                <input type="checkbox" id="show_amount" name="show_amount" {!! $custom_service->show_amount ? 'checked' : ''!!} data-toggle="toggle" data-style="ios slow" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="page_title">Amount *</label>
                                            <input type="text" id="amount" name="amount" maxlength="190" value="{{ old('amount',$custom_service->amount) }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                        <label for="page_title">Categories *</label>
                                            <select name="category[]" placeholder="Select Category" multiple>
                                                <option>Select all options that apply</option>
                                                @foreach($categories as $key=>$category)
                                                <option  value="{!! $category->id !!}" {!! in_array($category->id,$selected_category) ? 'selected' : '' !!}>{!! $category->name !!}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                        <label for="page_title">Providers *</label>
                                            <select name="vendor_id" class="form-control" placeholder="Select Provider">
                                                <option>Select Provider</option>
                                                @foreach($users as $key=>$user)
                                                <option  value="{!! $user->id !!}" {!! matchSelected($user->id, $custom_service->vendor_id) !!}>{!! $user->first_name !!} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                        <label for="page_title">Message *</label>
                                            <textarea class="form-control ckeditor" name="description" id="" cols="30" rows="8" placeholder="message">{{ old('description',$custom_service->description) }}</textarea>
                                        </div>
                                    </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="is_active">Is Active</label>
                                            <div class="col-md-2">
                                            <input type="checkbox" id="is_active" name="status" {!! $custom_service->status ? 'checked' : ''!!} data-toggle="toggle" data-style="ios slow" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
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