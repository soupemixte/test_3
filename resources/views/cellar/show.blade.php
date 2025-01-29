@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
<main class="flex-center height60">   
    <section class="structure flex-col gap10">
    <div class="section-title">
        <h2>Inventaire de : {{ $cellar->title }}.</h2>
    </div>
    <div class="line"></div>
    <header class="filter-wrapper">
            <form action="" method="GET" class="search-container {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
           
                <div class="filter-box">
                 
                    <i class="fa-solid fa-filter"></i>
                    <div class="filter-options">
                        
                            <div class="filter-item">
                                <label for="order">Tri :</label>
                                <select name="order" id="order">Tri :
                                    <option value="title">Titre</option>
                                    <option value="color">Couleur</option>
                                    <option value="region">Region</option>
                                    <option value="country">Country</option>
                                </select>
                            </div>
                        
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
                <h2>Vous avez <span>{{ $bottles->total() }} bouteille(s)</span> dans {{ $cellar->title }}.</h2>
                <div class="flex just-between hidden">

                    <p><span>Ajouter plus de bouteilles:</span></p>
                    <a href="{{ route('bottle.index') }}" class="btn-border">Bouteilles</a>
                </div>
            </div>
        @endif
        <!--Afficher la quantité trouvée après la requête -->
        @if (!empty($query) || !empty($color) || !empty($country) || !empty($size))
        <div class="results flex-col">
                <div>
                    @if (!empty($query) || !empty($color) || !empty($country) || !empty($size) || !empty($order))
                        @if(!empty($query))
                        <h2>Recherche de : "<span>{{ $query }}</span>"</h2>
                        @endif
                        <p><span>{{ $bottles->total() }}</span> @lang('lang.bottles')</p>
                    @endif
                </div>
                <div class="flex-al gap20">
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
                <!-- <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
                <a href="{{ route('bottle.index') }}" class="btn-border">@lang('lang.result_title')</a> -->
            </div>
        @endif

        <div class="line"></div>
        <section class="flex-col gap10">
            <!-- <div class="btn-container-top">
                <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn-border">Modifier</a>
                <form method="POST" action="{{ route('cellar.destroy', $cellar->id) }}">
                @csrf
                @method('delete')
                <button type="submit" class="btn-border">Supprimer</button>
                </form>
            </div>     -->
                      
            @foreach ($bottles as $bottle)
                <article class="card_bottle" id="card_bottle_cellar">
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
                        
                        <div class="btn-container flex-center gap5">
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border btn-icon btn-show flex-center flex-al"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('cellar.remove', ['id' => $bottle->id, 'cellar_id' => $cellar->id]) }}" class="btn-border btn-icon btn-remove flex-center flex-al"><i class="fa-solid fa-minus"></i></a>
                            <a href="{{ route('cellar.add', ['id' => $bottle->id]) }}" class="btn-border btn-icon btn-go flex-center flex-al"><i class="fa-solid fa-plus"></i></a>
                        </div>

                    </div>
                </article>
            @endforeach
        </section>

    </section>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>


    
@endsection