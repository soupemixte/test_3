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
<<<<<<< HEAD
 <main class="home">
        <section class="collection">
=======
 <main class="flex-center height80">
        <section class="structure">
>>>>>>> 5288649b793006c8942a45a0852e1cf431a52307
        <div class="btn-container">
          <a href="{{ route('cellar.create') }}" class="btn btn-icon">Ajouter un cellier<i class="fa-solid fa-plus"></i></a>
          <!-- <a href="{{ route('cellar.index') }}" class="btn btn-icon">@lang('lang.cellars')<i class="fa-solid"></i></a> -->

        </div>
        <div class="btn-container">
          <a href="{{ route('logout') }}" class="btn btn-icon">@lang('lang.logout')<i class="fa-solid"></i></a>
        </div> 
        </section>
    </div>
  </main>
</article>
@endsection