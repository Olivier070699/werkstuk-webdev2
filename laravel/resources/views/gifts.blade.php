@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if(Auth::user())
                <div class="card-header">Your gifts</div>
                    @foreach ($gifts as $gift)
                        @if(\Auth::user()->id == $gift->user_id)
                            <li>{{ $gift->gift }}</li>
                            <li>Date: <b>{{ $gift->created_at }}</b></li>
                        @endif
                    @endforeach
            </div>
            @else
            <p>You don't have acces to this page</p>
            @endif
        </div>
    </div>
</div>
@endsection
