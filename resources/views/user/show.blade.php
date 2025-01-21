@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<h1>Here we will implement the user Profile</h1>
<!--Scrape buttons--->
<!--TODO: UX/UI--->
@auth
    @if(Auth::user()->isAdmin)
        <div class="scraping-controls">
            <button id="start-scraping" class="btn btn-success">Start Scraping</button>
            <button id="stop-scraping" class="btn btn-danger">Stop Scraping</button>
            <p id="scraping-status" style="margin-top: 10px;"></p>
            <span class="loader_start hide"></span>
            <span class="loader_stop hide"></span>
        </div>
    @endif
@endauth
@endsection