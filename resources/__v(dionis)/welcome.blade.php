@extends('layouts.app')
@section('title', 'Welcome')
@section('content')
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