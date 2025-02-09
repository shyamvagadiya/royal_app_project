@extends('layouts.main')
@section('content')


@if ($errors->any())
<div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('profile.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $user['id'] }}">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" placeholder="First Name" class="form-control" value="{{ $user['first_name'] }}" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{ $user['last_name'] }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user['email'] }}" required>
    </div>  
    <div class="form-group">
        <label for="gender">Gender</label>
        <select name="gender" class="form-control" required>
            <option value="male" @if($user['gender'] == 'male') selected @endif>Male</option>
            <option value="female" @if($user['gender'] == 'female') selected @endif>Female</option>
        </select>

    </div>
    <div class="form-group">
        <label for="active">Active</label>
        <select name="active" class="form-control" required>
            <option value="1" @if($user['active']) selected @endif>Yes</option>
            <option value="0" @if(!$user['active']) selected @endif>No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>


</form>
@endsection

