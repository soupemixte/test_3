@extends('layouts.app')
@section('title', 'Cellar Show')
@section('content')
            

<main class="flex-center">   
    <section class="structure">
        
        <div class="btn-container just-between">
            <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn btn-icon">Edit <i class="fas fa-edit"></i></a>
            <a href="{{ route('cellar.delete', $cellar->id) }}" class="btn btn-icon">Delete <i class="fa-solid fa-trash"></i></a>
        </div>

        <header class="filters">
        {{ session('id_cellier') }}
    
        <h2>{{ $cellar->title }}</h2> 
      
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
                       
                        <button type="button" class="btn-border" data-bs-toggle="modal" data-bs-target="#deleteModal">Supprimer</button>

                    </div>
                </article>
            @endforeach
        @endif
        </section>
    </section>



                
<div class="modal fade container" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="position:absolute ; width:10""0vw; top:22rem" >
    <div class="modal-dialog">
    <div class="modal-content text-light" style="background-color: rgba(0, 0, 0, 0.538);border: 1px solid white;">
        <div class="modal-header container">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
        @lang('Are you sure !?')
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">@lang('No')</button>
        <form method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">@lang('Yes')</button>
        </form>
        </div>
    </div>
    </div>
</div>
</main>    
@endsection
