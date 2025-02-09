@extends('layouts.main')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>Profile</h1>
    </div>
    <div class="col-md-12">
        <h3>Name: {{ $user['first_name'] }} {{ $user['last_name'] }}</h3>
    </div>
    <div class="col-md-12">
        <h3>Email: {{ $user['email'] }}</h3>

    </div>
    <div class="col-md-12">
        <h3>Gender: {{ $user['gender'] }}</h3>

    </div>
    <div class="col-md-12">
        <h3>Active: {{ $user['active'] ? 'Yes' : 'No' }}</h3>
    </div>
    <div class="col-md-12">
        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit</a>
    </div>

</div>



@endsection

