@extends('layouts.app')

@section('content')
    
        <div class="projectContainer">
            @foreach ($projects as $project)
                <div class="project">
                    <div>
                        <h1><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h1>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
