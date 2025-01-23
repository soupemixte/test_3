@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')


<main class="flex-center height80">    
        <section class="structure">
            <header class="filter-wrapper">
                <form action="{{ route('bottle.index') }}" method="GET" class="search-container {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Recherche..." 
                        class="search-input"
                        value="{{ old('search', $query ?? '')}}"
                        id="search-input"
                    >
                    <button type="submit" class="search-btn" id="search-btn">
                        <i class="fas fa-search" id="search-icon"></i>
                    </button>
                   
                </form>
            </header>
             <!-- Afficher la quantité trouvée par défaut -->
             @if (empty($query))
                <div class="results hidden">
                    <h2>@lang('lang.result_title')</h2>
                    <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
                </div>
            @endif
            <!--Afficher la quantité trouvée après la requête -->
            @if (!empty($query))
                <div class="results">
                    <h2>Recherche de : "{{ $query }}"</h2>
                    <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
                    <a href="{{ route('bottle.index') }}" class="btn-border">@lang('lang.bottles')</a>
                </div>
            @endif
            <div class="pagination-wrapper">{{ $bottles->links('pagination::bootstrap-4') }}</div>
            <section class="flex-col-center height60 gap20">
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
                                <div class="line"></div>
                                <p>{{ $bottle->price }}</p>
                            </div>
                            <div class="btn-container">
                                <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">@lang('lang.view')</a>
                                <a href="{{ route('cellar.add', ['id' => $bottle->id]) }}" class="btn-border btn-go">@lang('lang.add_cellar')</a>
                            </div>
                    </article>
                @endforeach
            
            </section>

            
        </section>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');
    const searchBtn = document.getElementById('search-btn');

   // Empêcher la soumission du formulaire si l'entrée est vide
    searchForm.addEventListener('submit', function (e) {
        if (searchInput.value.trim() === '') {
            // Arrêter la soumission du formulaire
            e.preventDefault(); 
        }
    });

    // Autoriser l'extension de la saisie en cliquant sur le bouton de recherche
    searchBtn.addEventListener('click', function (e) {
        if (searchInput.value.trim() === '') {
            // Empêcher la soumission du formulaire uniquement si l'entrée est vide
            e.preventDefault(); 
             // Focaliser l'entrée pour déclencher l'expansion
            searchInput.focus();
        }
    });
});


</script>

<!---Change the icon of the search box--->


@endsection