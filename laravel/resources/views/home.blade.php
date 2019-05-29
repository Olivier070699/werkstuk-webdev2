@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">News Overview</div>

                <div class="card-body">
                    @foreach ($overViews as $overView)
                        <h2>{{ $overView->title}}</h2>
                        <p>{{ $overView->intro}}</p>
                        <a href="/projects/{{ $overView->project_id }}">View project</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
