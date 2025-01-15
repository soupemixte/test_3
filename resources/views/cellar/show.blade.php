@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
            
            
<x-header 
<!---Composants pour le titre et la description de la page--->                
<!-- <x-header 
    title="{{ $cellar->title }}"
    subtitle="{!! $cellar->description !!}"
/> -->

<main class="flex-center">   
    <section class="structure">
        
        <div class="btn-container just-between">
            <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn btn-icon">Edit <i class="fas fa-edit"></i></a>
            <a href="{{ route('cellar.delete', $cellar->id) }}" class="btn btn-icon">Delete <i class="fa-solid fa-trash"></i></a>
        </div>

        <header class="filters">
    
        <h2>{{ $cellar->title }}</h2> 
        <!--Actions de cellier -> supprimer, mettre à jour--->
        <!-- <div class="btn-container just-between">
            <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn btn-icon">@lang('lang.edit') <i class="fas fa-edit"></i></a>
            <a href="{{ route('cellar.delete', $cellar->id) }}" class="btn btn-icon">@lang('lang.delete') <i class="fa-solid fa-trash"></i></a>
        </div> -->
        <!---Filtres--->
        <!-- <header class="filters">
            <form class="filters_category" action="" method="GET">
                <label class="category_box">
                    <input type="radio" name="category" value="rose" hidden>
                    <img src="{{asset('img/icons/rose-wine.png')}}" alt="rose wine">
                    <span>Rosé</span>
                </label>

                <label class="category_box">
                    <input type="radio" name="category" value="rouge" hidden>
                    <img src="{{asset('img/icons/red-wine.png')}}" alt="red wine">
                    <span>Rouge</span>
                </label>

                <label class="category_box">
                    <input type="radio" name="category" value="blanc" hidden>
                    <img src="{{asset('img/icons/white-wine.png')}}" alt="white wine">
                    <span>Blanc</span>
                </label>

                <label class="category_box">
                    <input type="radio" name="category" value="tous" hidden>
                    <img src="{{asset('img/icons/all-wines.png')}}" alt="all wines">
                    <span>Tous</span>
                </label>
            </form>

        </header> -->
        <section class="grid mt-20 mb-10">
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
    </section>
</main>

    
@endsection
