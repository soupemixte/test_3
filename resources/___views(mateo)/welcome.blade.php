@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
 <!-- Home Page -->
 <main class="home">
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
@endsection