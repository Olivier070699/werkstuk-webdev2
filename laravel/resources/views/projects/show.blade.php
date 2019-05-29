@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div class="card">
                <div class="card-body">
                   
                    @if (Session::has('notif'))
                        <div class="alert alert-dismissible text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ session()->get('notif') }}</p>
                        </div>
                    @endif
                   
                   <h1>{{ $project->title }}</h1>
                   
                   <h2>Intro</h2>
                   <p>{{ $project->intro }}</p>

                   <h2>Description</h2>
                   <p>{{ $project->description }}</p>

                   <h2>Credits</h2>
                   <p>{{ $project->credits }} credits</p>
                   <p>Gesponsord bedrag: {{ $sponsor }} credits</p>


                    @if(Auth::user())
                        @if(\Auth::user()->id == $project->user || Auth::user()->id == 2)
                            <a href="/projects/{{ $project->id }}/edit">Edit</a>
                            
                            <form method="POST" action="/projects/{{ $project->id }}/addNewsView">
                                {{ csrf_field() }}
                                <button>add to news overview</button>
                            </form>

                        @else
                            @if($project->credits <= $sponsor)
                                <p>Het aantal credits werd reeds behaald</p>
                            @else
                                <form method="POST" action="/projects/{{ $project->id }}/addCredits">
                                    {{ csrf_field() }}
                                    <input type="number" name="numberOfCredits" placeholder="credits" min="1">
                                    <button>Sponsor credits</button>
                                </form>
                            @endif
                            <p>Project owner: <b>{{ $creator->name }}</b></p>
                        @endif
                    @else
                        <p>Project owner: <b>{{ $creator->name }}</b></p>  
                    @endif

                    <a href="{{route('generate-pdf',$project->id)}}">Download pdf</a>
                    
                    @if(Auth::user())
                        @if(\Auth::user()->id !== $project->user)
                        <form method="POST" action="/projects/{{ $project->id }}/addComment">
                            {{ csrf_field() }}
                            <textarea name="comment" placeholder="Post a comment"></textarea>
                            <button>Post</button>
                        </form>
                        @endif
                    @endif

                    <ul>
                        @foreach ($comments as $comment)
                            <li>
                                <p>{{ $comment->comment }}</p>
                                <p>Writed by: {{ $comment->user }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
