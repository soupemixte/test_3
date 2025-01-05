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
                                <p>{{ $cellar->description }}</p>
                            </div>
                        </div>
                        <div>
                        <a href="{{ route('cellar.show', $cellar->id) }}" class="">View</a>
                        </div>
                    </article>
                    @endforeach
                    @endif
                    <a href="{{ route('cellar.create') }}" class="">Ajouter un cellier</a>
        </section>
</main>

@endsection