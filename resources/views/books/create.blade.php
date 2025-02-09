@extends('layouts.main')
@section('content')
<form action="{{ route('books.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="author_id">Author</label>
        <select name="author_id" class="form-control" required>
            @foreach ($authors as $author)
                <option value="{{ $author['id'] }}">{{ $author['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" placeholder="Title" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="release_date">Release Date</label>

        <input type="date" name="release_date" placeholder="Release Date" class="form-control" required>
    </div>      
    <div class="form-group">
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" placeholder="ISBN" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="format">Format</label>
        <input type="text" name="format" placeholder="Format" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="number_of_pages">Number of Pages</label>
        <input type="number" name="number_of_pages" placeholder="Number of Pages" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" placeholder="Description" class="form-control" required></textarea>
    </div>



    <button type="submit" class="btn btn-primary">Create</button>


</form>
@endsection

