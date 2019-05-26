@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div class="card">
                @if(Auth::user())
                
                <div class="card-body">
                    <h2>Your Projects</h2>
                        @foreach ($projects as $project)
                            @if(\Auth::user()->id == $project->user)
                                <li>
                                    <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
                                </li>
                            @endif
                        @endforeach
                </div>

                <div class="card-body">
                    <h2>Your credits</h2>
                    <p>You have <b>{{ \Auth::user()->credits }}</b> credits</p>
                </div>

                <div class="card-body">
                    <h2>You sponserd</h2>
                    @foreach($sponsors as $sponsor)
                        @if(\Auth::user()->id == $sponsor->user_id)
                        <ul>
                            <li>name: <a href="/projects/{{ $sponsor->project_id }}">{{ $sponsor->project_id }}</a></li>
                            <li>amount: {{ $sponsor->credits }}</li>
                            <li>date: {{ $sponsor->created_at }}</li>
                        </ul>
                        @endif
                    @endforeach
                </div>

                @else
                <div class="card-body">
                    <p>You don't have acces to enter this page</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
