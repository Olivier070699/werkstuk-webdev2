@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div class="card">
                <div class="card-body">
                    <form method="POST" action="/projects">

                        {{ csrf_field() }}

                        <div>
                            <input type="text" name="title" placeholder="Project name" required>
                        </div>

                        <div>
                            <input type="number" name="credits" placeholder="Credits you need" required>
                        </div>

                        <div>
                            <textarea type="text" name="intro" placeholder="Introduction" required></textarea>
                        </div>

                        <div>
                            <textarea type="text" name="description" placeholder="Description" required></textarea>
                        </div>

                        <div>
                            <button type="submit">Add new project</button>  
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
