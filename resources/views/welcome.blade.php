@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<!-- <article class="intro-box flex-col-center gap20 height100">
    <header>
    {{ session('user') }}
        <h1>Bienvenue sur l'application Vino</h1>
    </header>
    <p>Application de gestion de votre cellier</p>
    <div class="btn-container">
        <a href="{{ route('bottle.index') }}" class="btn btn-border">Afficher la liste des vins</a>
    </div>
</article> -->
 <!-- Home Page -->
 <main class="home">
 {{ session('user') }}
    <section class="collection">
      <h2 class="section-title">Collection</h2>
      <div class="collection-info">
        <div class="cellars">

        <!-- @lang('lang.cellars') -->
          <a class="my_cellar" href="{{ route('cellar.index') }}">
            <span class="info-title">In My Cellar</span>
            <span class="info-count">0 Bottles</span>
          </a>

        </div>
        <div class="stuff hidden">
          <a class="add_bottles" href="#" target="_blank">
            <span class="info-title">Add Bottles</span>
          </a>
        </div>
      </div>
    </section>

  </main>
</article>
@endsection