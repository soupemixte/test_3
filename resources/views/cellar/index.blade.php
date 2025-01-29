@extends('layouts.app')
@section('title', 'Cellars')
@section('content')
<main class="flex-center"> 
    <section class="structure flex-col mb-10 height80 gap10">
        <div class="btn-container"><a href="{{ route('cellar.create') }}" class="btn-border btn-icon btn-go flex-al just-between gap5">Ajouter<i class="fa-solid fa-plus"></i></a></div> 
        @foreach ($cellars as $cellar)
            <article class="card_cellar">
                <div class="card-body"> 
                    <h2 class="card-title">
                        {{ $cellar->title }}
                    </h2>
                    <p class="card_description">{{ $cellar->description }}</p>
                    <div class="btn-container">
                        <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-border btn-icon btn-show flex-al just-between gap5">@lang('lang.view')<i class="fa-solid fa-eye"></i></a>
                    </div>
                </digv> 
                            
            </article>
            @endforeach
    </section>
</main>

@endsection