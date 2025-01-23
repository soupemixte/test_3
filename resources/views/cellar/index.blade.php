@extends('layouts.app')
@section('title', 'Cellars')
@section('content')
<main class="flex-center"> 
Bienvenue {{ session('username') }} - id: {{ session('user_id') }}
    <section class="structure flex-col mb-20 mt-20 height80 gap20">
        <div class="btn-container just-right"><a href="{{ route('cellar.create') }}" class="btn btn-icon">Ajouter un cellier <i class="fa-solid fa-plus"></i></a></div> 
        @if ($cellars->isEmpty())
            <p>Aucun cellier disponibles.</p>
        @else
        @foreach ($cellars as $cellar)
        @if($cellar->user_id ==  session('user_id')  )
            <article class="card_cellar">
                <div class="card-body">
                    <h2 class="card-title">
                        {{ $cellar->title }}
                    </h2>
                    <p class="card_description">{{ $cellar->description }}</p>
                </div>
                <div class="btn-container">

                    <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-border">@lang('lang.view')</a>
                </div>                
            </article>
            @endif
            @endforeach
        @endif
                
    </section>
</main>

@endsection