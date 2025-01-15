@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')
<main class="flex-center">    
        <div class="structure">
            <!-- <div class="search-box">
                <button class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" placeholder="Type to Search...">
            </div> -->
            <header class="filter-wrapper">
                <div class="search-container">
                    <input type="text" name="search" placeholder="Search..." class="search-input">
                    <a href="#" class="search-btn">
                        <i class="fas fa-search"></i>
                    </a>
                </div>
            </header>
            <section class="grid">
                @if ($bottles->isEmpty())
                    <p>Aucune bouteille disponible.</p>
                @else
                @foreach ($bottles as $bottle)
                    <article class="card_bottle">
                        <picture>
                            <img src="{{ $bottle->image_src ?? asset('img/gallery/bottle_1.webp') }}" alt="{{ $bottle->title }}">
                        </picture>
                        <div class="card-body">
                            <div class="card-title">
                                <h2>
                                    {{ $bottle->title }}
                                </h2>
                            </div>
                            <div class="card-category">
                                <p>{{ $bottle->color }}</p>
                                <div class="line"></div>
                                <p>{{ $bottle->size }}</p>
                                <div class="line"></div>
                                <p>{{ $bottle->country }}</p>
                            </div>
                            <div class="price">
                                {{ $bottle->price }}
                            </div>
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">Ajouter au cellier</a>
                        </div>
                    </article>
                @endforeach
            @endif
            </section>
        </div>
</main>

@endsection