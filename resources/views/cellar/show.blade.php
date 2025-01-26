@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
<main class="flex-center flex-center height80">   
    <section class="structure">
        <h1 class="page-title">{{ $cellar->title }}</h1> 
        <header class="filter-wrapper just-between mb-10 pt-20 pb-20">
        

            <form action="" method="GET" class="search-container {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
            <div class="filter-box">
                    <i class="fa-solid fa-filter"></i>
                    <div class="filter-options">
                        <div class="filter-item">
                            <label for="color">Couleur:</label>
                            <select id="color" name="color">
                                <option value="">Tous</option>     
                                @foreach ($colors as $option)
                                    <option value="{{ $option }}" {{ $color === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="country">Pays:</label>
                            <select id="country" name="country">
                                <option value="">Tous</option>
                                @foreach ($countries as $option)
                                    <option value="{{ $option }}" {{ $country === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="size">Volume:</label>
                            <select id="size" name="size">
                                <option value="">Tous</option>
                                @foreach ($sizes as $option)
                                    <option value="{{ $option }}" {{ $size === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

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
        @if (empty($query))
        <div class="results mb-10">
            <!-- Display the search result title -->
            <!-- <h2>@lang('lang.result_title')</h2>
            <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p> -->
            <!-- Display the default title -->
            <h2>Vous avez <span class="total">{{ $bottles->total() }}</span> bouteilles</h2>
            <div class="btn-container">
                <p><span>Ajouter des Bouteilles :</span></p>
                <a href="{{ route('bottle.index') }}" class="btn-border btn-go"><i class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        @endif

        <section class="flex-col gap10">
            @if ($bottles->isEmpty())
            <div class="results">
                    @if (!empty($query))
                        <h2>Recherche de : "{{ $query }}"</h2>
                        <p><span>0</span> résultats trouvés</p>
                        <ul>
                            <li>Désolé, aucun résultat trouvé dans ce cellier.</li>
                            <li>Essayez une autre recherche</li>
                        </ul>
                        <a href="{{ route('cellar.show', ['cellar' => $cellar->id]) }}" class="btn-border">Retour au cellier</a>
                    @else
                        <p>Ce cellier est vide.</p>
                    @endif
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
                        <div class="card-list">
                            @foreach ($cellar_bottles as $cellar_bottle)
                            @if ($cellar->id == $cellar_bottle->cellar_id && $bottle->id == $cellar_bottle->bottle_id)
                                <p>@lang('lang.quantity') : {{ $cellar_bottle->quantity }}</p>
                            @endif
                            @endforeach
                        </div>
                       
                        <!---the info would be placed in the view of the bottle details of the user-->
                         <!--<div class="card-list flex flex-col gap5">
                            <p>@lang('lang.region') : {{ $bottle->region }}</p>
                            <p>@lang('lang.degree_alcohol') : {{ $bottle->degree_alcohol }}</p>
                            <p>@lang('lang.sugar_content') : {{ $bottle->sugar_content }}</p>
                            <p>@lang('lang.promoting_agent') {{ $bottle->promoting_agent }}</p>
                        
                            <p>@lang('lang.producer') : {{ $bottle->producer }}</p>
                            <p>@lang('lang.grape_variety') : {{ $bottle->grape_variety }}</p>

                            <p>@lang('lang.price') : {{ $bottle->price }}</p>
                            @foreach ($cellar_bottles as $cellar_bottle)
                            @if ($cellar->id == $cellar_bottle->cellar_id && $bottle->id == $cellar_bottle->bottle_id)
                                <p>@lang('lang.quantity') : {{ $cellar_bottle->quantity }}</p>
                            @endif
                            @endforeach
                        </div> -->
                        
                        <div class="btn-container">
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">@lang('lang.view')</a>
                            <a href="{{ route('cellar.remove', ['id' => $bottle->id, 'cellar_id' => $cellar->id]) }}" class="btn-border btn-remove"><i class="fa-solid fa-minus"></i></a>
                        </div>

                    </div>
                </article>
            @endforeach
        @endif
        </section>
    </section>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>
    
@endsection
