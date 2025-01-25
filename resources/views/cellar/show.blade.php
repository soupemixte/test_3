@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
<main class="flex-center flex-center height80">   
    <section class="structure">
        <h1 class="page-title">{{ $cellar->title }}</h1> 
        <header class="filter-wrapper just-right mb-10">
            <form action="" method="GET" class="search-container {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
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
        <div class="results mb-10">
            <h2>@lang('lang.result_title')</h2>
            <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
            <p><span>Ajouter Les Bouteilles:</span></p>
            <a href="{{ route('bottle.index') }}" class="btn-border">Ajouter</a>
        </div>
        <section class="flex-col gap10">
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
                        <div>
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
