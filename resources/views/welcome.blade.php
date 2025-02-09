@extends('layouts.main')
@section('content')
@if(Session::has('access_token'))
    <p>Welcome, {{ Session::get('user_name') }}</p>
@endif
@endsection