@extends('layouts.app')
@section('title', 'View all Cellars')
@section('content')

<main class="cellars">    
        <section class="grid">
            @if ($cellars->isEmpty())
                <p>Aucun cellier disponibles.</p>
            @else
            @foreach ($cellars as $cellar)
                    <article class="card_cellar">
                        <div class="card-body">
                            <div class="card-title">
                                <h2>
                                    {{ $cellar->title }}
                                </h2>
                            </div>
                            <div class="description">
                                {{ $cellar->description }}
                            </div>
                        </div>
                    </article>
                    <a href="{{ route('cellar.create') }} " class="">Ajouter un cellier</a>
                @endforeach
        @endif
        </section>
</main>

@endsection