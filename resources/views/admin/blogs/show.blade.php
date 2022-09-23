@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Blog Details <i class="feather icon-rss"></i></h4>
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
                                    @if($data->blog_by != '')
                                	<div class="col-6">
                                		<p><h5><strong>Blog by:</strong>  </h5>{{ $data->blog_by }}</p>
                                	</div>
                                    @endif

                                    <div class="col-6">
                                        <p><h5><strong>Title:</strong> </h5>{{ $data->title }}</p>
                                    </div>

                                    <div class="col-6">
                                        <p><h5><strong>Content:</strong> </h5>{!! $data->content !!}</p>
                                    </div>

                                    <div class="col-6">
                                        <p><h5><strong>Category:</strong> </h5>{!! $data->blog_category_name !!}</p>
                                    </div>

                                    <div class="col-6">
                                        <p><h5><strong>Tags:</strong> </h5>{!! $data->tags !!}</p>
                                    </div>

                                    <div class="col-6">
                                        <p><h5><strong>Meta Robots:</strong> </h5>
                                            <?php
                                            $metaRobots   = []; // declaring empty array
                                            $metaRobots[] = $data->is_index == 1 ? '<font color="blue"><b>Index</b></font>' : '<font color="red"><b>Noindex</b></font>';
                                            $metaRobots[] = $data->is_follow == 1 ? '<font color="blue"><b>Follow</b></font>' : '<font color="red"><b>Nofollow</b></font>';
                                            ?>
                                            {!! implode(', ', $metaRobots) !!}
                                        </p>
                                    </div>

                                    <div class="col-6">
                                        <p><h5><strong>Is Featured:</strong> </h5>{{ ($data->is_featured) == 1 ? 'Yes':'No' }}</p>
                                    </div>

                                    @if($data->blog_media != '' && file_exists(uploadsDir('admin/blogs') . $data->blog_media))
                                    <div class="col-6">
                                        <p><h5>Media: </h5>
                                            <img src="{!! asset(uploadsDir('admin/blogs') . $data->blog_media) !!}" height="150" width="150">
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