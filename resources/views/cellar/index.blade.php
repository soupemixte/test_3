@extends('layouts.app')
@section('title', 'Cellars')
@section('content')
<!-- this should be the home page -->
<main class="cellars"> 
    <section class="collection">
        <div class="section-title">
            <h2>@lang('lang.collection')</h2>
        </div>
        <div class="stuff">
            @if ($cellars->isEmpty())
            <div class="">
                <p>Aucun cellier disponibles.</p>
            </div>
            @else
            <div class="cellar-boxes">
            @foreach ($cellars as $cellar)
                <a href="{{ route('cellar.show', $cellar->id) }}" class="current-cellar">
                    <article class="card_cellar">
                        <div class="card-body"> 
                            <h2 class="card-title">
                                {{ $cellar->title }}
                            </h2>
                            <!-- <p class="card_description">{{ $cellar->description }}</p>
                            <div class="card-bottles">

                            </div> -->
                        </div> 
                    </article>
                </a>
            @endforeach
                <a href="{{ route('cellar.create') }}" class="new-cellar-box">
                    <article class="new-card_cellar">
                        <div class="card-body"> 
                            <h2 class="new-cellar">
                            @lang('lang.cellar_create')
                            </h2>
                        </div> 
                    </article>
                </a>

            </div>
            @endif
            <div class="cellar-buttons">
            <button class="button-cellar-add">
                <a class="nav-link" href="#">@lang('lang.add_cellar')</a>
            </button>
            <button class="button-cellar-drink">
                <a class="nav-link" href="#">@lang('lang.drink_cellar')</a>
            </button>
            </div>
        </div>
    </section>
</main>

@endsection