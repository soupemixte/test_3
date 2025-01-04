@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
<!-- <article class="intro-box flex-col-center gap20 height100">
    <header>
        <h1>Bienvenue sur l'application Vino</h1>
    </header>
    <p>Application de gestion de votre cellier</p>
    <div class="btn-container">
        <a href="{{ route('bottle.index') }}" class="btn btn-border">Afficher la liste des vins</a>
    </div>
</article> -->
 <!-- Home Page -->
 <main class="home">
    <section class="collection">
      <h2 class="section-title">Collection</h2>
      <div class="collection-info">
        <div class="info-box">
          <span class="info-title">In My Cellar</span>
          <span class="info-count">0 Bottles</span>
        </div>
        <button class="btn btn-add">Add Bottles</button>
      </div>
    </section>

  </main>
@endsection