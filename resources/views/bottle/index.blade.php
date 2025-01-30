@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')


<main class="flex-center height60">    
        <div class="structure flex-col gap10">
        <div class="section-title">
            <h2>Liste de nos bouteilles.</h2>
        </div>
        <div class="line"></div>
            <header class="filter-wrapper">
            <form action="" method="GET" class="search-container" id="search-form">
           
                <div class="filter-box">
                 
                    <i class="fa-solid fa-filter"></i>
                    <div class="filter-options">
                        
                        <div class="filter-section">
                            <div class="filter-item">
                                <label for="order" class="filter-title">Trier par:</label>
                                <select name="order" id="order">
                                    <option value="">Tous ▼</option>
                                    <option value="title">Titre</option>
                                    <option value="color">Couleur</option>
                                    <option value="region">Région</option>
                                    <option value="country">Pays</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="filter-section">
                            <div class="filter-item">
                                <label for="color">Couleur:</label>
                                <select id="color" name="color">
                                    <option value="">Tous ▼</option>
                                    @foreach ($colors as $option)
                                        <option value="{{ $option }}" {{ $color === $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-item">
            
                                <label for="country">Pays:</label>
                                <select id="country" name="country">
                                    <option value="">Tous ▼</option>
                                    @foreach ($countries as $option)
                                        <option value="{{ $option }}" {{ $country === $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-item">
                                <label for="size">Volume:</label>
                                <select id="size" name="size">
                                    <option value="">Tous ▼</option>
                                    @foreach ($sizes as $option)
                                        <option value="{{ $option }}" {{ $size === $option ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>
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
             <!-- Afficher la quantité trouvée par défaut -->
             @if (empty($query) && empty($color) && empty($country) && empty($size))
                <div class="results">
                    <h2>@lang('lang.result_title') :</h2>
                    <p><span>{{ $bottles->total() }}</span> @lang('lang.bottles')</p>
                </div>
            @endif
            <!--Afficher la quantité trouvée après la requête -->
            @if (!empty($query) || !empty($color) || !empty($country) || !empty($size))
            <div class="results flex-col">
                <div class="flex-al just-between">
                @if (!empty($query) || !empty($color) || !empty($country) || !empty($size) || !empty($order))
                        @if(!empty($query))
                      
                        <h2>Recherche de : "<span>{{ $query }}</span>"</h2>
                        @endif
                        <p><span>{{ $bottles->total() }}</span> @lang('lang.bottles')</p>
                        <a href="{{ route('bottle.index') }}" class="btn-icon btn-show flex-al just-between"><i class="fa-solid fa-rotate-left"></i></a>
                    @endif
                </div>
                <div class="flex just-between gap20">
                    @if (!empty($color) || !empty($country) || !empty($size))
                    <ul>Filtres :
                        @if (!empty($color)) <li>{{ $color }}</li>@endif
                        @if (!empty($color) && (!empty($country) || !empty($size))) @endif
                        @if (!empty($country)) <li>{{ $country }}</li>@endif
                        @if (!empty($country) && !empty($size)) @endif
                        @if (!empty($size)) <li>{{ $size }}</li>@endif
                    </ul>
                    @endif
                    @if (!empty($order))
                        <ul>Tri (A - Z) :
                            @if($order === 'title') <li>Nom</li>@endif
                            @if($order === 'country') <li>Pays</li>@endif
                            @if($order === 'region') <li>Region</li>@endif
                            @if($order === 'color') <li>Couleur</li>@endif
                        </ul>
                    @endif
                </div>
                
                <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
            </div>
            @endif
            <!-- <div class="line"></div> -->
            <section class="grid">
                
                @foreach ($bottles as $bottle)
                    <article class="card_bottle">
                        <picture>
                            <img src="{{ $bottle->image_src ?? asset('img/gallery/bottle_1.webp') }}" alt="{{ $bottle->title }}">
                        </picture>
<!-- 
                        <span class="cart">
                            <a href="{{ route('futurelist.add', ['id' => $bottle->id]) }}">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </span> -->
                        
                        <div class="card-body">
                            <div class="card-title flex just-between">
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
                        </div>
                        <div class="btn-container flex-center gap5">
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-icon btn-show flex-al just-between">@lang('lang.view')<i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('cellar.add', ['id' => $bottle->id]) }}" class="btn-icon btn-go flex-al just-between">Ajouter<i class="fa-solid fa-plus"></i></a>

                        </div>
                    </article>
                @endforeach
            
            </section>
            <div class="pagination-wrapper">{{ $bottles->onEachSide(0)->links('pagination::bootstrap-4') }}</div>
        </div>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>

@endsection