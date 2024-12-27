@extends('layouts.app')
@section('title', 'Détails')
@section('content')

<!-- <x-header 
    image="{{ asset('img/header/header.jpg') }}" 
    title="Découvrez notre collection" 
    subtitle="C'est ce dont nous sommes fiers" 
/> -->

<main class="flex-center">
    <section class="structure flex-col gap20">
        <article class="details-article">
            <picture class="details-image_container">
                <img class="details-image" src="{{ $bottle->image_src ?? asset('img/gallery/bottle_static.webp') }}" alt="{{ $bottle->title }}">
            </picture>
            <h2 class="details-title">{{ $bottle->title }}</h2>
            <span class="details-price">Prix: {{$bottle->price}}</span>


            <!-- -------- ajout de form ---------- -->

            <form action="{{ route('cellierbottle.store'), }}" method="POST">
            @csrf
            <label for="quantity">
                Quantite
                <input type="number" name="quantity" >
                </label>
                <label for="Cellier_idCellier">
                @foreach( $celliers as $cellier)
                @if($cellier->idCellier == 1)
                <input hidden type="number" name="Cellier_idCellier" value="{{ $cellier->idCellier }}" >
                @endif
                @endforeach
                </label>
                <label for="Bottle_id">
                <input hidden type="number" name="Bottle_id" value="{{ $bottle->id }}" >
                </label>
                <label for="a_commander">
                <input hidden type="number" name="a_commander" value="0" >
                </label>
                <label for="bu">
                <input hidden  type="number" name="bu" value="0" >
                </label>
                <input type="submit" value="Ajouter au cellier">
            </form>



            <div class="quantity-input">
                <!-- <button id="">-</button>
                <input type="text" value="1">
                <button id="">+</button> -->    
            </div>
<!-- <a href="" class="btn btn-border">Ajouter au cellier</a> -->
        </article>

        <div class="line"></div>

        <article class="info-details">
            <h3>Infos détaillées</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem nam ipsam quia quam hic reiciendis sed ipsum voluptatem officiis voluptas, perspiciatis tenetur inventore? Excepturi, quidem consequatur sint aspernatur deleniti aliquid laborum odit amet pariatur earum non quibusdam veritatis nisi officia.</p>
        </article>
    </section>
</main>

@endsection