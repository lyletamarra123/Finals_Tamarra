@extends('layout')
  
@section('content')
<body>
    <div class="container">
        <h1 class="mt-5">Movie Information</h1>
        <ul class="list-group mt-4">
            <li class="list-group-item">
                <strong>Movie Title:</strong> {{ $movie->mov_title ?? 'Null'}}
            </li>
            <li class="list-group-item">
                <strong>Year:</strong> {{ $movie->mov_year ?? 'Null'}}
            </li>
            <li class="list-group-item">
                <strong>Running Time:</strong> {{ $movie->mov_time ?? 'Null'}} minutes
            </li>
            <li class="list-group-item">
                <strong>Directed by:</strong> {{ $directors->pluck('dir_fname')->implode(', ') ?? 'Null'}} {{ $directors->pluck('dir_lname')->implode(', ') ?? 'Null'}}
            </li>
            <li class="list-group-item">
                <strong>Starring:</strong> {{ $actors->act_fname ?? 'Null'}} {{ $actors->act_lname ?? 'Null'}} - {{ $actors->pivot->role ?? 'Null'}}
            </li>
            <li class="list-group-item">
                <strong>Genre:</strong> {{ $genres->gen_title ?? 'Null'}}
            </li>
            <li class="list-group-item">
                <strong>Reviewer:</strong> {{ $reviewer->rev_name ?? 'Null'}}
            </li>
            <li class="list-group-item">
                <strong>Score:</strong> {{ $rating->rev_stars ?? 'Null'}} stars
            </li>
            <!-- Include additional information here -->
        </ul>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('movies.index') }}" class="btn btn-primary mt-4">Go Back to List</a>
            </div>
            <div class="col-md-6 text-right">
                <form action="{{ route('movies.destroy',$movie->mov_id) }}" method="Post">
                <a href="{{ route('movies.index') }}" class="btn btn-success mt-4">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mt-4">Delete</button>
            </div>
        </div>
    </div>
</body>
@endsection