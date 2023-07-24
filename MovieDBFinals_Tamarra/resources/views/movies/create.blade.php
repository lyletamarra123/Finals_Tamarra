@extends('layout')
  
@section('content')
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Movie</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('movies.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Movie ID:</strong>
                        <input type="text" name="mov_id" class="form-control" placeholder="Title of the Movie">
                        @error('mov_id')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div> --}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Movie Title:</strong>
                        <input type="text" name="mov_title" class="form-control" placeholder="Title of the Movie">
                        @error('mov_title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Year Made:</strong>
                        <input type="text" name="mov_year" class="form-control" placeholder="Year made">
                        @error('mov_year')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Length:</strong>
                        <input type="text" name="mov_time" class="form-control" placeholder="Movie running time">
                        @error('mov_time')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Language:</strong>
                        <input type="text" name="mov_lang" class="form-control" placeholder="Movie Language">
                        @error('mov_lang')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Release Date:</strong>
                        <input type="text" name="mov_dt_rel" class="form-control" placeholder="Movie release date">
                        @error('mov_dt_rel')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Country Released:</strong>
                        <input type="text" name="mov_rel_country" class="form-control" placeholder="Country released">
                        @error('mov_rel_country')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <hr style="width: 95%; color: #ccc; height: 5px; background-color: #ccc; margin-top: 1rem; margin-bottom: 1rem;">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h5>Additional Details</h5>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Director:</strong>
                        <select name="dir_id" class="form-control">
                            <option value="">Select a Director</option>
                            @foreach ($directors as $director)
                                <option value="{{ $director->dir_id }}">{{ $director->dir_fname }} {{ $director->dir_lname }}</option>
                            @endforeach
                        </select>
                        @error('dir_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Starring:</strong>
                        <select name="act_id" class="form-control">
                            <option value="">Select an Actor</option>
                            @foreach ($actors as $actor)
                                <option value="{{ $actor->act_id }}">{{ $actor->act_fname }} {{ $actor->act_lname }}</option>
                            @endforeach
                        </select>
                        @error('act_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Role:</strong>
                        <input type="text" name="role" class="form-control" placeholder="Actor Role in the Movie">
                        @error('role')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Genre:</strong>
                        <select name="gen_id" class="form-control">
                            <option value="">Select a Genre</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->gen_id }}">{{ $genre->gen_title }}</option>
                            @endforeach
                        </select>
                        @error('gen_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Reviewer:</strong>
                        <select name="rev_id" class="form-control">
                            <option value="">Select a Reviewer</option>
                            @foreach ($reviewers as $reviewer)
                                <option value="{{ $reviewer->rev_id }}">{{ $reviewer->rev_name }}</option>
                            @endforeach
                        </select>
                        @error('rev_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Score Rating:</strong>
                        <input type="text" name="rating" class="form-control" placeholder="Movie Rating">
                        @error('rating')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>
@endsection