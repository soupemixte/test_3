@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<!--
    TODO: UX/UI
    TODO: if cellars->isEmpty()
-->

<main class="flex-center heigth80">
    <section class="structure">
        <div class="info-details">
            <h3>@lang('lang.user_name') : {{ $user->name }}</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">@lang('lang.email') :</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">@lang('lang.created') :</span>
                    <span class="info-value">{{ $user->created_at }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Derniere mise a jour :</span>
                    <span class="info-value">{{ $user->updated_at }}</span>
                </div>
            </div>
            <div class="btn-container">
            <a href="{{ route('user.edit', $user->id) }}" class="btn-border">@lang('lang.edit')</a>
            <form action="{{ route('user.destroy', $user->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn-border">@lang('lang.delete')</button>
        </form>
            </div>
        </div>
        <!-- <p>ici</p> -->
        @if($cellars)
        <section class="flex-col gap10">
        @if($count)
            <h2>Nombres de Celliers : {{ $count }}</h2>
        @endif
        @foreach ($cellars as $cellar)
            <article class="card_cellar">
                <div class="card-body"> 
                    <h2 class="card-title">
                        Titre : {{ $cellar->title }}
                    </h2>
                    <p class="card_description">Description : {{ $cellar->description }}</p>
                </div> 
                @if($total)
                    <p class="card-description">Nombre de Bouteilles dans Cellier : {{ $total }}</p>                          

                @endif
                <div class="btn-container-top">
                    <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-border">@lang('lang.view')</a>
                    <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn-border">Modifier</a>
                    <form method="POST" action="{{ route('cellar.destroy', $cellar->id) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn-border">Supprimer</button>
                    </form>
                </div>    
            </article>
        </section>
        @endforeach
        @endif
        
        </section>
        
</section>
</main>

@endsection