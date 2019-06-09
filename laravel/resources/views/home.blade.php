@extends('layouts.app')

@section('content')
    <div class="projectContainer">
        @foreach ($overViews as $overView)
            @if($overView->created_at < $tomorrow && $overView->created_at > $yesterday)
            <div class="project">
                <div>
                    <h2>{{ $overView->title}}</h2>
                    <p>{{ $overView->intro}}</p>
                    <a href="/projects/{{ $overView->project_id }}">View project</a>
                </div>
            </div>
            @endif
        @endforeach

        <!-- if groter dan yesterday & kleiner dan today -->
    </div>
@endsection
