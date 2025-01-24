@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
 <!-- Home Page -->
 <main class="home">
        @else
        <section class="collection">
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
@endsection