@extends('layouts.app')

@section('content')
    
        <div class="projectContainer">
            @foreach ($projects as $project)
                <div class="project">
                    <div>
                        <h1><a href="/projects/{{ $project->id }}">{{ $project->title }}</a></h1>
                                @if($project->images->first()['filepath'] !== null)
                                    <img src="{{ $project->images->last()['filepath'] . '/' . $project->images->last()['filename'] }}">
                                @endif
                    </div>
                </div>
            @endforeach
        </div>
@endsection
