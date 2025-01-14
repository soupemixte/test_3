@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
    <main class="cellars">
        <section class="collection">
        <h2 class="section-title">{{ $cellar->title }}</h2>
        <article class="card_cellar">
            <div class="cellar-top">
                <div class="card-title">
                    <div>
                        <p>{{ $cellar->description }}</p>
                    </div>
                </div>
                <div class="links">
                    <a class="nav-link" href="{{ route('cellar.edit', $cellar->id) }}" class="">Edit</a>
                    <a class="nav-link" href="{{ route('cellar.delete', $cellar->id) }}" class="">Delete</a>
                </div>
            </div>
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
        </article>
        </section>
    </main>
@endsection
