@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')

<main class="flex-center">
    <section class="structure">
        <h1 class="page-title">Bonjour, {{ Auth::guard('admin')->user()->name }}</h1>
      
        <div class="scraping-controls results">
            <div class="btn-container">
                <button id="start-scraping" class="btn bg-success">Start Scraping</button>
                <button id="stop-scraping" class="btn bg-danger">Stop Scraping</button>
            </div>
            <div class="scraping-process">
                <span class="loader_start hide"></span>
                <span class="loader_stop hide"></span>
                <p id="scraping-status" style="margin-top: 10px;"></p>
            </div>
        </div>
           
        
        <div class="results">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-border">Logout</button>
            </form>
        </div>
    </section>
</main>

@endsection