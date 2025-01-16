@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')
    
        <div class="structure">
          
            <header class="filter-wrapper">
                <form action="{{ route('bottle.index') }}" method="GET" class="search-container" id="search-form">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search..." 
                        class="search-input"
                        value="{{ old('search', $query ?? '')}}"
                        id="search-input"
                    >
                    <button type="submit" class="search-btn" id="search-btn">
                        <i class="fas fa-search" id="search-icon"></i>
                    </button>
                   
                </form>
            </header>

             @if (empty($query))
                <div class="results">
                    <h2>Tous les résultats:</h2>
                    <p><span>{{ $bottles->total() }}</span> résultats trouvés</p>
                </div>
            @endif

            @if (!empty($query))
                <div class="results">
                    <h2>Recherche de : "{{ $query }}"</h2>
                    <p><span>{{ $bottles->total() }}</span> résultats trouvés</p>
                    <a href="{{ route('bottle.index') }}" class="btn-border">Tous les résultats</a>
                </div>
            @endif
            <section class="grid">
                @if ($bottles->isEmpty())

                    <div class="results">
                        @if (!empty($query))
                            <h2>Recherche de : "{{ $query }}"</h2>
                        @endif
                        <p><span>0</span> résultats trouvés</p>
                        <ul>Désolé, aucun résultat trouvé.
                            <li>Essayez une autre recherche</li>
                            <li>Ou retourner à la page de la liste des bouteilles</li>
                        </ul>
                        <a href="{{ route('bottle.index') }}" class="btn-border">Tous les résultats</a>

                    </div>
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
            <!-- <div class="pagination-wrapper">
                <ul class="pagination">
                    <li><a href="?page=1">1</a></li>
                    <li><a href="?page=2">2</a></li>
                    <li class="active"><span>3</span></li>
                    <li><a href="?page=4">4</a></li>
                    <li><a href="?page=5">5</a></li>
                </ul>
            </div> -->

            <div class="pagination-wrapper">{{ $bottles->links('pagination::bootstrap-4') }}</div>
            <!-- {{ $bottles }}   -->
        </div>

@endsection