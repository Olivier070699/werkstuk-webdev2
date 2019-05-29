@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your gifts</div>
                    @foreach ($gifts as $gift)
                        @if(\Auth::user()->id == $gift->user_id)
                            <li>{{ $gift->gift }}</li>
                            <li>Date: <b>{{ $gift->created_at }}</b></li>
                        @endif
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
