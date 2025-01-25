@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
@if(session('warning'))
    <div class="alert warning">
        <p>{{ session('warning') }}</p>
        <button type="button" class="btn-close">X</button>
    </div>
    @endif

    
    @if(!$errors->isEmpty())
    <div class="alert error" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close">X</button>
    </div>                
@endif    
 <!-- Home Page -->
 <main class="home">
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