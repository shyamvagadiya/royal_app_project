

@extends('layouts.main')
@section('content')

@if ($errors->any())
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px;">
        <p>{{ session('success') }}</p>
    </div>
@endif
<table class="table table-bordered">
    <tr>
        <th>Name</th>

        <th>Actions</th>
    </tr>
    @foreach ($authors as $author)
        <tr>
            <td>{{ $author['name'] }}</td>
            <td>
                <a href="{{ route('authors.show', $author['id']) }}" class="btn btn-primary">View</a>
                <form method="POST" action="{{ route('authors.destroy', $author['id']) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection