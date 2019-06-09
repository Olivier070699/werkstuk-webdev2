@extends('layouts.app')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="stripe-token" content="{{ env('STRIPE_KEY') }}">
    <link rel="stylesheet" href="{{ asset('css/stripe-demo.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const creditRatio = {{env('CREDIT_RATIO')}};
    </script>
@endsection


@section('content')
<section class="buyCredits">
    <div class="row display-tr" >
        <h3 class="panel-title display-td" >Buy credits!</h3>
        <div class="display-td" >
            <img class="img-responsive pull-right paymentImage" src="http://i76.imgup.net/accepted_c22e0.png">
        </div>
    </div>
    </div>
    <div class="panel-body">

    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
</section>

<form class="buyCredits" action="{{ route('stripe.post') }}" method="post" id="payment-form">
    <div class="form-group">
        <label class="control-label" for="inpCredits">How many credits do you want?</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-gem"></i></span>
            <input min="1000" type="number" class="form-control" name="credits" id="inpCredits">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label" for="inpCost">Price</label>
        <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-euro-sign"></i></span>
            <input type="text" class="form-control" name="cost" disabled id="inpCost">
        </div>
    </div>

    @csrf
    <div class="form-group">
        <label for="card-element">
            Card number
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>

    <button class="btn btn-primary">
        Add credits
    </button>
</form>



@endsection
@section('footer')
    <script>
        let convertUrl = '{{ route('api.convert')}}';
    </script>
    <script src="{{ asset('js/stripe-demo.js') }}"></script>
@endsection

