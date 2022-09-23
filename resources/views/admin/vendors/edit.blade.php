@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Vendor <i class="feather icon-user"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.vendors.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name *</label>
                                            <input type="text" name="first_name" value="{{ old('first_name', $data->first_name) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name *</label>
                                            <input type="text" name="last_name" value="{{ old('last_name', $data->last_name) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">Email *</label>
                                            <input readonly type="email" name="email" value="{{ old('email', $data->email) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="phone">Contact Number *</label>
                                            <input type="text" name="phone" value="{{ old('phone', $data->phone) }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">New Password </label>
                                            <input type="password" name="password" value="" class="form-control">
                                        </div>
                                    </div>

                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="meta_title">Status</label>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <input type="checkbox"  class="custom-control-input" id="customSwitch4" name="approved"  {{$data->approved == 1 ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="customSwitch4"></label>
                                                {{$data->approved == 1 ? 'Approved' : 'Not approved'}}
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