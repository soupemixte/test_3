@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')
    
        <div class="structure">
          
            <header class="filter-wrapper">
                <form action="{{ route('bottle.index') }}" method="GET" class="search-container {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
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
                    <h2>@lang('lang.result_title')</h2>
                    <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
                </div>
            @endif

            @if (!empty($query))
                <div class="results">
                    <h2>Recherche de : "{{ $query }}"</h2>
                    <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
                    <a href="{{ route('bottle.index') }}" class="btn-border">@lang('lang.bottles')</a>
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
                            <div>
                            <div class="card-category">
                           
                <p>@lang('lang.degree_alcohol')<br>{{ $bottle->degree_alcohol }}</p>
                <p>@lang('lang.sugar_content')<br>{{ $bottle->sugar_content }}</p>
                            </div>
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">@lang('lang.view')</a>
                             <a href="{{ route('cellar.return', ['id' => $bottle->id ]) }}" class="btn-border">Ajouter au cellier</a>
                        </div>
                    </article>
                @endforeach
            
            @endif
         
            </section>

            <div class="pagination-wrapper">{{ $bottles->links('pagination::bootstrap-4') }}</div>
          
        </div>
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

@endsection