@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if($bidder)
                        <h5>Bidder Information</h5>
                        <p><strong>Full Name:</strong> {{ $bidder->Full_name }}</p>
                        <p><strong>Phone:</strong> {{ $bidder->telp }}</p>
                    @endif

                    @if($data->count() > 0)
                        <h5>Your Bids</h5>
                        <ul>
                            @foreach($data as $bid)
                                <li>{{ $bid->name_product }} - Bid: @currency($bid->bid)</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
