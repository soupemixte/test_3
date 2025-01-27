@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
<main class="flex-center flex-center height80">   
   <section class="structure">
       <header class="filter-wrapper just-between">
           <form action="" method="GET" class="search-container flex-col gap5 {{ !empty($query) ? 'expanded' : '' }}" id="search-form">
               <div class="flex just-between filter-box">
                   <div class="filter-order">
                       <label for="order">Tri :</label>
                       <select class="filter-item" id="type" name="order">
                           <option value="title" {{ $order === 'title' ? 'selected' : '' }}>Title</option>
                           <option value="country" {{ $order === 'country' ? 'selected' : '' }}>Country</option>
                           <option value="region" {{ $order === 'region' ? 'selected' : '' }}>Region</option>
                           <option value="color" {{ $order === 'color' ? 'selected' : '' }}>Color</option>
                       </select>
                   </div>
                   <div class="filter-options">
                       <div class="filter-item">
                           <p>Couleur :</p>
                           <div class="flex-al gap5">
                               @foreach ($colors as $option)
                               <label for="color">{{ $option }}</label>
                               <input type="checkbox" id="color" name="color" value="{{ $option }}" {{ $color === $option ? 'selected' : '' }}>
                               @endforeach
                           </div>
                       </div>
                       <div class="filter-item hidden">
                           <p>Pays :</p>
                           <div class="flex">
                               @foreach ($countries as $option)
                               <label for="country">{{ $option }}</label>
                               <input type="checkbox" id="country" name="country" value="{{ $option }}" {{ $color === $option ? 'selected' : '' }}>
                               @endforeach
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

       @if (empty($query) && empty($color) && empty($country) && empty($size))
           <div class="results">
               <h2>Vous avez <span>{{ $bottles->total() }} bouteilles</span> dans {{ $cellar->title }}</h2>
           </div>
       @endif

        <section class="flex-col gap10">
            
                      
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
       @if (!empty($query) || !empty($color) || !empty($country))
           <div class="results mb-10">
               @if (!empty($query))
                   <h2>Recherche de : "<span>{{ $query }}</span>"</h2>
               @endif
               @if (!empty($color) || !empty($country) || !empty($order))
                   <ul>Filtres:
                       @if (!empty($color)) <li>{{ $color }}</li>@endif
                       @if (!empty($color) && (!empty($country) )) @endif
                       @if (!empty($country)) <li>{{ $country }}</li>@endif
                   </ul>
               @endif
               <p><span>{{ $bottles->total() }}</span>@lang('lang.result_subtitle')</p>
           </div>
       @endif

       <section class="flex-col gap10">
           @foreach ($bottles as $bottle)
               <article class="card_bottle">
                   <picture>
                       <img src="{{ $bottle->image_src ?? asset('img/gallery/bottle_1.webp') }}" alt="{{ $bottle->title }}">
                   </picture>
                   <div class="card-body">
                       <div class="card-title">
                           <h2>{{ $bottle->title }}</h2>
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
                                   <p>Quantité : {{ $cellar_bottle->quantity }}</p>
                               @endif
                           @endforeach
                       </div>
                       <div class="btn-container" style="justify-content: center; margin-top: 1rem;">
                           <a href="{{ route('cellar.add', ['id' => $bottle->id, 'cellar_id' => $cellar->id]) }}" class="btn-icon" style="display: flex; align-items: center; gap: 5px;">
                               <i class="fa-solid fa-plus"></i>
                               <span>Ajouter une<br>bouteille</span>
                           </a>
                           <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn-border" style="display: flex; align-items: center; justify-content: center;">
                               Modifier
                           </a>
                           <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="btn-border" style="display: flex; align-items: center; justify-content: center;">
                               Voir
                           </a>
                           <a href="{{ route('cellar.remove', ['id' => $bottle->id, 'cellar_id' => $cellar->id]) }}" class="btn-border btn-remove">
                               <i class="fa-solid fa-minus"></i>
                           </a>
                       </div>
                   </div>
               </article>
           @endforeach
       </section>
   </section>
</main>

<script src="{{ asset('js/classes/SearchFormHandler.js') }}"></script>
@endsection