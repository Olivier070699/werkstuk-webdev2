@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="card">
            <div class="card-body">  
                @if (Session::has('notif'))
                    <div class="alert alert-dismissible text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ session()->get('notif') }}</p>
                    </div>
                @endif
                
                <h1>{{ $project->title }}</h1>
                <p>{{ $project->intro }}</p>

                <p>{{ $project->description }}</p>

                <h2>Credits</h2>
                <p>{{ $project->credits }} credits</p>
                <p>Gesponsord bedrag: {{ $sponsor }} credits</p>

                <!-- DIAGRAM -->
                <div class="diagramBack">
                    <div class="diagramLoading" style="width: {{ $sponsor / $project->credits *100}}%;"></div>
                </div>
                

                <div class="downloadPdf">
                    <a href="{{route('generate-pdf',$project->id)}}">Download pdf</a>
                @if(Auth::user())
                    @if(\Auth::user()->id == $project->user || Auth::user()->id == 2)
                        /<a href="/projects/{{ $project->id }}/edit"> Edit </a>/
                        <a href="{{route('yoursponsors',$project->id)}}">Download sponsors list</a>
                        
                        <form method="POST" action="/projects/{{ $project->id }}/addNewsView">
                            {{ csrf_field() }}
                            <button>push to news overview</button>
                        </form>
                </div>

                    @else
                    </div>
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
</main>

@endsection
