@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')

<h1>Welcome, {{ Auth::guard('admin')->user()->name }}</h1>

@auth
    @if(Auth::guard('admin'))
        <div class="scraping-controls">
            <button id="start-scraping" class="btn btn-success">Start Scraping</button>
            <button id="stop-scraping" class="btn btn-danger">Stop Scraping</button>
            <p id="scraping-status" style="margin-top: 10px;"></p>
            <span class="loader_start hide"></span>
            <span class="loader_stop hide"></span>
        </div>
    @endif
@endauth

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

@endsection