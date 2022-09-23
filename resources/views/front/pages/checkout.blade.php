@extends('front.app') @section('page-title', 'Registry Checkout') @section('content')
<section class="secAbout">
	<div class="container">
		<h2 class="page-title">Cart</h2>

		@if($items->count())
		<table>
            <thead>
                <tr>
                    <th scope="col">Item(s)</th>
                    <th scope="col" class="cartTdTotal">Total</th>
                    <th scope="col" class="cartTdAction">Action</th>
                </tr>
            </thead>
            <tbody>
			@php
				$total = 0;
			@endphp
			@foreach($items as $item)
			<tr>
                <td data-label="Item(s)">
					<h5 class="mb-0">{{$item->name}}</h5>
					<p><strong>{{$item->attributes->registry_name}}</strong></p>
				</td>
				<td data-label="Total">
					<div id="line-item-1221-edit">${{$item->price}}</div>
					@php $total = $total + $item->price; @endphp
				</td>
				<td data-label="Action">
					<form class="edit_line_item" id="" method="POST" action="{{ route('delete-cart') }}">
						@csrf
						<input type="hidden" name="row_id" value="{{$item->id}}">
						<button name="button" type="submit" class="btn bg-transparent p-0"><i class="fa fa-trash delCart"></i></button>
					</form>
				</td>
			</tr>
			@endforeach
		
			<tr>
				<td>
					<h6 class="mb-0">Transaction Fee</h6>
					<p>Our 5% transaction fee is included to cover Stripe credit card processing fees (2.9%) and our babycito service fee (2.1%).  These fees help us to cover the costs of running our business and providing babycito services.</p>
				</td>
				<td colspan="2"> 
					@php
						$percentage = env('percentage_deduction',9);
						$t_fee =  ($percentage / 100) * $total;
					@endphp
					${{$t_fee}}
				</td>
			</tr>
			<tr>
				<td>
					<h5 class="mb-0">Total</h5>
				</td>
				<td colspan="2">
					<h5 class="mb-0">${{$total + $t_fee}}</h5>
				</td>
			</tr>
		</tbody>
		</table>
		
		<div class="row mt-4">
			<div class="col-12">
				<div class="d-flex justify-content-end">
					<a class="btn btn-primary btn-dark-pink mx-2 px-3" role="button" href="{{route('checkout-message')}}">Checkout</a> 
					<a class="btn btn-secondary px-3" role="button" href="{{route('cart-clear')}}" style="color:#fff">Clear Cart</a> 
				</div>
			</div>
		</div>

		@else

			<div class="divNotfound">
				<h2>Your cart is currently empty</h2>
				<img src="{!! asset('assets/frontend/images/baby-sleep.png') !!}" alt="" />
			</div>
			
		@endif

	</div>
</section>
@endsection