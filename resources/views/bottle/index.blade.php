@extends('layouts.app')
@section('title', 'Liste des Bouteiilles')
@section('content')



<main> 
        <section class="list_bottle">
            @forelse ($bottles as $bottle)
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
                            <!-- <div class="price">
                                {{ $bottle->price }}
                            </div> -->
                            <a href="{{ route('bottle.details', ['id' => $bottle->id]) }}" class="go_to_bottle">Ajouter au cellier</a>
                        </div>
                    </article>
                @empty
                    <div><p>There are no bottles to display</p></div>
            </div>
            @endforelse
        </section>
        <!-- <div class="list_report">
            <strong>Can't Find what you're looking for ?</strong>
            <p>Send us the details and we'll look into it</p>
        </div> -->

</main>

@endsection