@extends('front.app') @section('page-title', 'Registry Checkout') @section('content')
@php
    $total = 0;
    $regitry_name
@endphp
@foreach($items as $item)
    @php 
        $total = $total + $item->price; 
        $regitry_name = $item->attributes->user_to;
    @endphp
@endforeach
@php
    $percentage = env('percentage_deduction',9);
    $t_fee =  ($percentage / 100) * $total;
@endphp

<section class="secAbout">
	<div class="container">
        <h2 class="page-title mb-0">${{$total + $t_fee}}</h2>
        <h5 class="text-center mb-4">Include a message to {{$regitry_name}} with your gift</h5>
        <div class="row justify-content-lg-center">
            <div class="col-12 col-lg-6">
                <form class="" id="" action="" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <input placeholder="Your name(s)" class="form-control" required="required" type="text" value="{{old('cart.message_name')}}" name="cart[message_name]" id="cart_message_name">
                    </div>
                    <div class="form-group mb-3">
                        <input placeholder="Email" class="form-control" required="required" type="text"  name="cart[message_email]" value="{{old('cart.message_email')}}" id="cart_message_email">
                    </div>
                    <div class="form-group mb-3">
                        <input placeholder="Phone" class="form-control" type="text"  name="cart[message_phone]"  value="{{old('cart.message_phone')}}"  id="cart_message_phone">
                    </div>
                    <div class="form-group mb-3">
                        <textarea placeholder="Message to gift recipient" rows="8" class="form-control" name="cart[message_text]" id="cart_message_text" required min="5" max="1000">{{old('cart.message_text')}}</textarea>
                    </div>
                    <p class="text-center w-100 mb-3">This information will be shared with the gift recipient when your gift is sent.</p>
                    <div class="form-group">
                        <input type="submit" value="Continue to Payment" class="form-control submit">
                    </div>            
                </form>
            </div>
        </div>
    </div>
</section>
@endsection