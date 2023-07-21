{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Movies 'R' Us Movie Database</title>
</head> --}}

@extends('layout')
  
@section('content')
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('movies.create') }}"> Add Movie</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Movie ID</th>
                    <th>Movie Title</th>
                    <th>Year Made</th>
                    <th>Length</th>
                    <th>Language</th>
                    <th>Date of Release</th>
                    <th>Country Released</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($movies as $movie)
                    <tr>
                        <td>{{ $movie->mov_id ?? 'Null'}}</td>
                        <td>{{ $movie->mov_title ?? 'Null'}}</td>
                        <td>{{ $movie->mov_year ?? 'Null'}}</td>
                        <td>{{ $movie->mov_time ?? 'Null'}}</td>
                        <td>{{ $movie->mov_lang ?? 'Null'}}</td>
                        <td>{{ $movie->mov_dt_rel ?? 'Null'}}</td>
                        <td>{{ $movie->mov_rel_country ?? 'Null'}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('movies.details',$movie->mov_id) }}"> Movie Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $movies->links('pagination::bootstrap-4') }}
        </div>
    </div>
</body>
@endsection
{{-- </html> --}}
