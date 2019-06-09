@extends('layouts.app')

@section('content')
<div class="projectContainer">
    @if(Auth::user())

    <div class="project">
        <div>
            <h2>Your Projects</h2>
            @foreach ($projects as $project)
                @if(\Auth::user()->id == $project->user)
                    <li>
                        <a href="/projects/{{ $project->id }}">{{ $project->title }}</a><br>
                    </li>
                @endif
            @endforeach
        </div>
    </div>

    <div class="project">
        <div>
            <h2>Your credits</h2>
            <p>You have <b>{{ \Auth::user()->credits }}</b> credits</p>
        </div>
    </div>

    <div class="project">
        <div>
            <h2>You sponserd</h2>
            <a href="/generate-sponsor-pdf">Download PDF</a>
        </div>
    </div>

    @else
        <div class="card-body">
            <p>You don't have acces to enter this page</p>
        </div>
    @endif
</div>
@endsection
