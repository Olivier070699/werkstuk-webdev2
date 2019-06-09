@extends('layouts.app')

@section('content')
    <div class="projectContainer">
        @foreach ($overViews as $overView)
            <div class="project">
                <div>
                    <h2>{{ $overView->title}}</h2>
                    <p>{{ $overView->intro}}</p>
                    <a href="/projects/{{ $overView->project_id }}">View project</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
