@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form class="projectForm" method="POST" action="/projects">

                    {{ csrf_field() }}

                        <input type="text" name="title" placeholder="Project name" required>
                    
                        <input type="number" name="credits" placeholder="Credits you need" required>
                    
                        <textarea class='introduction' type="text" name="intro" placeholder="Introduction" required></textarea>
                    
                        <textarea type="text" name="description" placeholder="Description" required></textarea>
                    
                        <button type="submit">Create</button>  

                </form>
            </div>
        </div>
    </div>
</main>
@endsection
