@extends('admin.layouts.app')

@section('content')
<section id="column-selectors">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Payout <i class="feather icon-globe"></i></h4>

                    <h3>Stripe Avilable Balance: $ {{number_format($stripe_balance->available[0]->amount/100)}}</h3>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table table-striped dataex-html5-selectors">
                                <thead>
                                    <tr>
                                        <th>Giver Name</th>
                                        <th>Receiver Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Received at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach ($gifts as $gift)
                                        @php
                                            $username = null;
                                            $amount = 0;
                                            foreach($gift->payment as $k => $pay){
                                                if(isset($pay->user->first_name))
                                                    $username = $pay->user->first_name .' '. $pay->user->last_name;
                                                $amount = ($amount + $gift->payment[$k]->price);
                                            }
                                        @endphp
	                                    <tr>
	                                        <td>{!! $gift->giver !!}</td>
	                                        <td>{!! $username  !!}</td>
                                            <td>{!! $amount  !!}</td>
                                            <td>{{ $gift->status }}</td>
                                            <td>{!! date("M, d Y", strtotime($gift->created_at)) !!}</td>
	                                        <td>
                                             @if( $gift->status <> "paid")   
                                             <a  href="{{route('admin.payout', $gift->id)}}" class="btn btn-success btn-sm waves-effect waves-light">
                                                   Send Money
                                                </a>
                                            @else
                                            <a  href="javascript:void(0)" class="btn btn-info btn-sm waves-effect waves-light">
                                                   Sent
                                                </a>

                                            @endif

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
<!-- Column selectors with Export Options and print table -->
@endsection