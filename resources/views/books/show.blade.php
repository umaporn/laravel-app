@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">Book Details</div>

                <div class="card-body">
                    <div class="form-group">
                        <label>Title:</label>
                        <p>{{ $book->title }}</p>
                    </div>

                    <div class="form-group">
                        <label>Author:</label>
                        <p>{{ $book->author }}</p>
                    </div>

                    <div class="form-group">
                        <label>ISBN:</label>
                        <p>{{ $book->isbn }}</p>
                    </div>

                    <div class="form-group">
                        <label>Published Date:</label>
                        <p>{{ $book->published_date }}</p>
                    </div>

                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
