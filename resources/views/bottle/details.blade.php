@extends('layouts.app')
@section('title', 'Détails')
@section('content')
<main class="flex-center height80">
    <section class="structure flex-col mt-20 gap20">
        <article class="details-article">
            <picture class="details-image_container">
                <img class="details-image" src="{{ $bottle->image_src ?? asset('img/gallery/bottle_static.webp') }}" alt="{{ $bottle->title }}">
            </picture>
            <h2 class="details-title">{{ $bottle->title }}</h2>

            <div class="btn-container just-right"><a href="{{ route('cellar.add', ['id' => $bottle->id]) }}" class="btn btn-icon">@lang('lang.add_cellar') <i class="fa-solid fa-plus"></i></a></div> 
        </article>

        <div class="line"></div>

        <article class="info-details">
            <h3>Infos détaillées</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Pays :</span>
                    <span class="info-value">{{ $bottle->country }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Région :</span>
                    <span class="info-value">{{ $bottle->region }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Couleur :</span>
                    <span class="info-value">{{ $bottle->color }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Format :</span>
                    <span class="info-value">{{ $bottle->size }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">{{ $bottle->degree_alcohol }} :</span>
                    <span class="info-value">{{ $bottle->degree_alcohol }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">@lang('lang.sugar_content') :</span>
                    <span class="info-value">{{ $bottle->sugar_content }}</span>
                </div>
            </div>
        </article>
    </section>
</main>
@endsection