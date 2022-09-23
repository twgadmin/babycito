@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pages <i class="feather icon-globe"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $page)
	                                    <tr>
	                                        <td>{!! $page->name !!}</td>
	                                        <td>{!! $page->email !!}</td>
                                            <td>{!! $page->phone !!}</td>
                                            <td>{!! $page->message !!}</td>
                                            <td>{!! date("M d, Y H:i:s", strtotime($page->created_at)) !!}</td>
	                                        
	                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                       	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Column selectors with Export Options and print table -->
@endsection