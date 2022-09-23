@extends('admin.layouts.app')

@section('content')
<section id="number-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Blog Category <i class="feather icon-rss"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blog-categories.update', $data->id) }}" class="number-tab-steps wizard-circle" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <fieldset>
                                <div class="row">
                                     <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Category Name *</label>
                                            <input type="text" name="name" value="{!! old('name', $data->name) !!}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="is_index" >Meta Index </label>
                                            <select class="form-control" name="is_index">
                                                <option value="1" {!! matchSelected(old('is_index', $data->is_index), 1) !!}>Index</option>
                                                <option value="0" {!! matchSelected(old('is_index', $data->is_index), 0) !!}>Noindex</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                            <label for="is_follow">Meta Follow </label>
                                            <select class="form-control" name="is_follow">
                                                <option value="1" {!! matchSelected(old('is_follow', $data->is_index), 1) !!}>Follow</option>
                                                <option value="0" {!! matchSelected(old('is_follow', $data->is_index), 0) !!}>Nofollow</option>
                                            </select>
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