@extends('layouts.app')

@section('content')
@foreach ($projects as $project)
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div class="card">
                <div class="card-body">
                    <li>
                        <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
                    </li>
                </div>
            </div>
        </div>
    </div>
</main>
@endforeach
@endsection
