@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-12 text-right">
        <a href="{{ route('books.create') }}" class="btn btn-primary">Create Book</a>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
    
        @if ($errors->any())
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>Title</th>


                <th>Release Date</th>
                <th>ISBN</th>
                <th>Format</th>
                <th>Number of Pages</th>
                <th>Actions</th>
            </tr>
            @foreach ($books as $book)

                <tr>
                    <td>{{ $book['title'] }}</td>
                    <td>{{ $book['release_date'] }}</td>
                    <td>{{ $book['isbn'] }}</td>
                    <td>{{ $book['format'] }}</td>
                    <td>{{ $book['number_of_pages'] }}</td>
                    <td>
                        <form method="POST" action="{{ route('books.destroy', $book['id']) }}">
                            @csrf

                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
</table>
</div>
@endsection
