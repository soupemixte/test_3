@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')
<main class="flex-center">    
    <div class="structure">
        <header class="filters">
            <div class="filters_category">
                <div class="category_box">
                    <img src="{{asset('img/icons/rose-wine.png') }}" alt="rose wine">
                    <span>Rosé</span>
                </div>
                <div class="category_box">
                    <img src="{{asset('img/icons/red-wine.png') }}" alt="red wine">
                    <span>Rouge</span>
                </div>
                <div class="category_box">
                    <img src="{{asset('img/icons/white-wine.png') }}" alt="red wine">
                    <span>Blanc</span>
                </div>
                <div class="category_box">
                    <img src="{{asset('img/icons/all-wines.png') }}" alt="all wines">
                    <span>Tous</span>
                </div>
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
    {{ $bottles }}
</main>

@endsection