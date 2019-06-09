@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="card">
            <div class="card-body">
                    @if(Auth::user())
                            @if(\Auth::user()->id == $project->user || Auth::user()->id == 2)

                    <form class="projectForm" method="POST" action="/projects/{{ $project->id }}">

                    @method('PATCH')
                    @csrf

                        <input type="text" name="title" placeholder="title" value="{{ $project->title }}">

                        <input type="number" name="credits" placeholder="credits" value="{{ $project->credits }}">

                        <textarea class="introduction" name="intro">{{ $project->intro }}</textarea>

                        <textarea name="description">{{ $project->description }}</textarea>

                        <button type="submit">Update project</button> 
                    </form>

                    <form class="projectForm delete" method="POST" action="/projects/{{ $project->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Delete project</button>
                    </form>
                            @else
                                <p>U heeft geen toegang tot deze pagina.</b></p>
                            @endif
                        @else
                            <p>U heeft geen toegang tot deze pagina.</p>  
                        @endif
            </div>
        </div>
    </div>
</main>
@endsection
