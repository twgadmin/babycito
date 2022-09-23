@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Featured Image Details <i class="feather icon-rss"></i></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                        <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                        <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <div class="row" style="width: 100%;">
                                    <div class="col-6">
                                        <p>
                                        <h5><strong>Heading 1:</strong> </h5>{{ $data->heading1 }}</p>
                                    </div>

                                    <div class="col-6">
                                        <p>
                                        <h5><strong>Heading 2:</strong> </h5>{!! $data->heading2 !!}</p>
                                    </div>

                                    <div class="col-6">
                                        <p>
                                        <h5><strong>Description:</strong> </h5>{!! $data->description !!}</p>
                                    </div>

                                    <div class="col-6">
                                        <p>
                                        <h5><strong>Read More Link:</strong> </h5>{!! $data->read_more_link !!}</p>
                                    </div>

                                    <div class="col-6">
                                        <p>
                                        <h5><strong>Is Active:</strong> </h5>{{ ($data->is_active) ? 'Yes':'No' }}</p>
                                    </div>

                                    @if($data->media_image != '' && file_exists(uploadsDir('admin/featured-images') . $data->media_image))
                                    <div class="col-6">
                                        <p>
                                        <h5>Media: </h5>
                                        <img src="{!! asset(uploadsDir('admin/featured-images') . $data->media_image) !!}" height="150" width="150">
                                        </p>
                                    </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection