@extends('layouts.app')
@section('title', 'Bienvenue')
@section('content')
<article class="intro-box flex-col-center gap20 height100">
    <header>
        <h1>Bienvenue sur l'application Vino</h1>
    </header>
    <p>Application de gestion de votre cellier</p>
    <div class="btn-container">
        <a href="{{ route('bottle.index') }}" class="btn btn-border">Afficher la liste des vins</a>
    </div>
</article>
    <main>
        <section class="collection">
            <h3>Collection</h3>
            <div class="flex_collection">
                <div class="home_gallery">
                    <a href="#" class="home_cellar_button"><button>In My Cellar<br><p>{{ session('qte')}}  Bottles</p></button></a>
                </div>
                <div class="flex_button">
                    <a href="#" class="home_button"><button>Add Bottles</button></a>
                    <a href="#" class="home_button"><button>Consume</button></a>
                </div>
            </div>
        </section>
    </main>

@endsection