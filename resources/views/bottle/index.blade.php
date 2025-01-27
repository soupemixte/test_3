@extends('layouts.app')
@section('title', 'View all Bottles')
@section('content')


<main class="flex-center height80">    
        <div class="structure">
            <header class="filter-wrapper">
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
             <!-- Afficher la quantité trouvée par défaut -->
             @if (empty($query) && empty($color) && empty($country) && empty($size))
                <div class="results">
                    <h2>@lang('lang.result_title') :</h2>
                    <p><span>{{ $bottles->total() }}</span> @lang('lang.bottles')</p>
                </div>
            @endif
            <!--Afficher la quantité trouvée après la requête -->
            @if (!empty($query) || !empty($color) || !empty($country) || !empty($size) || !empty($order))
                <div class="results mb-10">
                    @if (!empty($query))
                        <h2>Recherche de : "<span>{{ $query }}</span>"</h2>
                    @endif
                    @if (!empty($color) || !empty($country) || !empty($size) || !empty($order))
                        <ul>Filtres:
                            @if (!empty($color)) <li>{{ $color }}</li>@endif
                            @if (!empty($color) && (!empty($country) || !empty($size))) @endif
                            @if (!empty($country)) <li>{{ $country }}</li>@endif
                            @if (!empty($country) && !empty($size)) @endif
                            @if (!empty($size)) <li>{{ $size }}</li>@endif
                        </ul>
                    @endif
                    @if (!empty($order))
                        <p>Ordonne par : {{ $order }}</p>
                    @endif
                    <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
                    <a href="{{ route('bottle.index') }}" class="btn-border">@lang('lang.result_title')</a>
                </div>
            @endif
            <section class="grid">
                
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
                        </div>
                        <div class="btn-container">
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border">@lang('lang.view')</a>
                            <a href="{{ route('cellar.add', ['id' => $bottle->id]) }}" class="btn-border btn-go"><i class="fa-solid fa-plus"></i></a>
                        </div>
                    </article>
                @endforeach
            
            </section>

            <div class="pagination-wrapper">{{ $bottles->links('pagination::bootstrap-4') }}</div>
        </div>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>

@endsection