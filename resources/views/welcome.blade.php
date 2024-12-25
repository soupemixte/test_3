@extends('layouts.app')
@section('title', 'Projet - Vino - Index')
@section('content')
<header class="home_header">
        <div>
            <h1>Header</h1>
            <a href="{{ route('scrape') }}">Scrape Bottles to the Database</a>
        </div>
    </header>
    <main>
        <section class="collection">
            <h3>Collection</h3>
            <div class="flex_collection">

                <div class="home_gallery">
                    <a href="#" class="home_cellar_button"><button>In My Cellar<br><p>0 Bottles</p></button></a>
                </div>
                <div class="flex_button">
                    <a href="#" class="home_button"><button>Add Bottles</button></a>
                    <a href="#" class="home_button"><button>Consume</button></a>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer_nav">
            <a href="#home" class="active">Home</a>
            <a href="#collection">Collection</a>
            <a href="{{ route('bottle.index') }}">Search</a>
            <a href="#profile">Profile</a>
        </div>
    </footer>
@endsection