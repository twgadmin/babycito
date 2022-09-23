@extends('front.app') @section('page-title', 'Gifts') @section('content')
<section class=" cover">
	<div class="container mt-5">
		<h1 class="text-center">Gifts</h1>
		@if($records)

		<table class="table mt-3">
  <thead class="thead-primary">
    <tr>
      <th scope="col">Giver</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($records as $record)
    <tr>
      <td>{{$record->giver}}</td>
      <td>{{$record->email}}</td>
      <td>{{$record->phone}}</td>
      <td>{{$record->message}}</td>
    </tr>
    @endforeach
   
  </tbody>
</table>

			<p style="text-align:center" class="text-center mt-5">
				{{$records->links()}}
			</p>		
		@else
			<h4 class="text-center">No gifts receive yet.</h4>
			<br>
		@endif
	</div>
</section> @endsection