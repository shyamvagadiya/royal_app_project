@extends('layouts.main')

@section('content')
<div>
    
    <h3>Name : {{ $author['first_name'] }} {{ $author['last_name'] }}</h3>
    <h3>Birthday : {{ date('d M Y', strtotime($author['birthday'])) }}</h3>
    <h3>Gender : {{ $author['gender'] }}</h3>

    <h3>Place of Birth : {{ $author['place_of_birth'] }}</h3>
    <h3>Place of Birth : {{ $author['place_of_birth'] }}</h3>

        @foreach ($author['books'] as $book)
            <h3>Books : {{ $book['title'] }}</h3>
            <ul>
                <li>Release Date : {{ date('d M Y', strtotime($book['release_date'])) }}</li>
                <li>Description : {{ $book['description'] }}</li>
                <li>ISBN : {{ $book['isbn'] }}</li>
                <li>Format : {{ $book['format'] }}</li>
                <li>Number of Pages : {{ $book['number_of_pages'] }}</li>
                <li><form method="POST" action="{{ route('books.destroy', $book['id']) }}">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form></li>
            </ul>

        @endforeach
</div>
@endsection