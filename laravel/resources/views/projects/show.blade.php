@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
    @if (session('fail'))
        <div class="alert alert-danger col-lg-10">
            {{ session('fail') }}
        </div>
        @endif
        @if (session('succes'))
        <div class="alert alert-success col-lg-10">
            {{ session('succes') }}
        </div>
    @endif
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
                
                <div class="imageContainer">
                    @foreach ($images as $image)
                        <img src="{{ asset($image->filepath . '/' . $image->filename) }}">
                    @endforeach 
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

                <form action="{{ route('store', $project->id) }}" method="post" enctype="multipart/form-data" class="uploadImageForm">
                        @csrf
                        <div class="field">
                            <div class="control">
                                <input class="form-control" type="text" name="project_id"
                                    value="{{$project->id}}" hidden>
                            </div>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="file" name="file[]" id="file" multiple>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="button">
                            upload image
                        </button><br>
                    </form>

                    @else
                    </div>
                        @if($project->credits <= $sponsor)
                            <p>Het aantal credits werd reeds behaald</p>
                        @else
                            <form class="fundInput" method="POST" action="/projects/{{ $project->id }}/addCredits">
                                {{ csrf_field() }}
                                <input type="number" name="numberOfCredits" placeholder="credits" min="1">
                                <button>Sponsor credits</button>
                            </form>
                        @endif
                        <p>Project owner: <b>{{ $creator->name }}</b></p>
                    @endif
                @else
                    </div>
                    <p>Project owner: <b>{{ $creator->name }}</b></p>  
                @endif
                
                @if(Auth::user())
                    @if(\Auth::user()->id !== $project->user)
                    <form class="postComment" method="POST" action="/projects/{{ $project->id }}/addComment">
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
