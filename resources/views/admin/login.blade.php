@extends('layouts.app')
@section('title', 'Login')
@section('content')

<h1 class="page-title">Login administrateur</h1> 
<form action="{{ route('admin.login.submit') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
    </div>
<button type="submit">Login</button>

@endsection