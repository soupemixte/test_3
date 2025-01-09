@extends('layouts.app')
@section('title', 'Cellars')
@section('content')
<!-- this should be the home page -->
<main class="cellars"> 
    <section class="collection">
        <h2 class="section-title">Collection</h2>
        <!-- <div class=""><a href="{{ route('cellar.create') }}" class="">@lang('lang.add_cellar')</a></div>  -->
        @if ($cellars->isEmpty())
            <p>Aucun cellier disponibles.</p>
        @else
        @foreach ($cellars as $cellar)
            <article class="card_cellar">
                <div class="card-body"> 
                    <h2 class="card-title">
                        {{ $cellar->title }}
                    </h2>
                    <p class="card_description">{{ $cellar->description }}</p>
                </div>                
                <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-border">View</a>
            </article>
            @endforeach
        @endif
                
    </section>
</main>

@endsection