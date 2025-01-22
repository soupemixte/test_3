@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')

<main class="flex-center">
    <section class="structure">
        <h1 class="page-title">Bonjour, {{ Auth::guard('admin')->user()->name }}</h1>
      
        <div class="scraping-controls results">
            <h2>Votre collection actuelle dans l'application : <span>{{ $totalBottles }}</span> bouteilles</h2>
            <p>Commencez à importer les bouteilles depuis <a class="link" href="https://www.saq.com/fr/produits/vin" target="_blank">
            SAQ</a></p>
            <div class="btn-container">
                <button id="start-scraping" class="btn btn-icon ">Start Scraping <i class="fa-solid fa-circle-play"></i></button>
                <button id="stop-scraping" class="btn btn-icon ">Stop Scraping <i class="fa-regular fa-circle-pause"></i></button>
            </div>
            <div class="scraping-process">
                <span class="loader_start hide"></span>
                <span class="loader_stop hide"></span>
                <p id="scraping-status" style="margin-top: 10px;"></p>
            </div>
        </div>
        <div>
            <a class="btn-border" href="{{ route('auth.connection') }}">@lang('lang.logout')</a>
        </div>  
        <!-- <div class="results">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-border">Logout</button>
            </form>
        </div> -->
    </section>
</main>

@endsection