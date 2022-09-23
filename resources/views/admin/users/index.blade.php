@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User List <i class="feather icon-users"></i></h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Number </th>
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($data as $key => $user)
	                                    <tr>
                                            <td>{!! $user->id !!}</td>
	                                        <td>{!! $user->first_name .'  '. $user->last_name !!}</td>
	                                        <td>{!! $user->email !!}</td>
	                                        <td>{!! $user->phone !!}</td>
                                            <td>{!! $user->approved == 1 ? 'Approved' : "Not Approved" !!}</td>
                                            
	                                        <td>
	                                        	<a href="{!! route('admin.users.show', $user->id) !!}" class="btn btn-info btn-sm waves-effect waves-light"><i class="feather icon-search"></i></a>
                                                <a href="{{ url('admin/user/'. $user->id.'/custom_services') }}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-eye"></i>
                                                </a>

                                                <a href="{{ url('admin/user/'. $user->id.'/registries') }}" class="btn btn-info btn-sm waves-effect waves-light">
                                                    <i class="feather icon-circle"></i>
                                                </a>
	                                        	<a href="{!! route('admin.users.edit', $user->id) !!}" class="btn btn-primary btn-sm waves-effect waves-light"><i class="feather icon-edit"></i></a>

	                                        	<button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="deleteConfirmation({!! $user->id !!})"><i class="feather icon-trash"></i></button>

	                                        	<form action="{!! URL::route('admin.users.destroy', $user->id) !!}" method="POST" id="deleteForm{!! $user->id !!}">
			                                        @csrf
			                                        @method('DELETE')
			                                    </form>

	                                        </td>
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
@endsection