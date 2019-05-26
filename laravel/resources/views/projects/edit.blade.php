@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div class="card">
                <div class="card-body">
                @if(Auth::user())
                        @if(\Auth::user()->id == $project->user || Auth::user()->id == 2)
                   <h1>Edit Project</h1>

                   <form method="POST" action="/projects/{{ $project->id }}">

                   @method('PATCH')
                   @csrf

                    <label for="title">Title</label>
                    <input type="text" name="title" placeholder="title" value="{{ $project->title }}">

                    <label for="credits">Credits</label>
                    <input type="number" name="credits" placeholder="credits" value="{{ $project->credits }}">

                    <label for="intro">intro</label>
                    <textarea name="intro">{{ $project->intro }}</textarea>

                    <label for="description">description</label>
                    <textarea name="description">{{ $project->description }}</textarea>

                    <button type="submit">Update project</button>  

                   </form>

                   <form method="POST" action="/projects/{{ $project->id }}">
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
    </div>
</main>
@endsection
