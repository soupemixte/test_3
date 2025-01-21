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
          

        <div class="line"></div>

        <article class="info-details">
            <h3>@lang('lang.info')</h3>
            <div>
                <p>@lang('lang.region')<br>{{ $bottle->region }}</p>
                <p>@lang('lang.degree_alcohol')<br>{{ $bottle->degree_alcohol }}</p>
                <p>@lang('lang.sugar_content')<br>{{ $bottle->sugar_content }}</p>
            </div>
            <div class="line"></div>
            <div class="card-list flex flex-col gap5">
                <p>@lang('lang.promoting_agent') {{ $bottle->promoting_agent }}</p>
              
                <p>@lang('lang.producer') {{ $bottle->producer }}</p>
                <p>@lang('lang.grape_variety') {{ $bottle->grape_variety }}</p>
            </div>
            <div class="line"></div>
            <div class="price">
                <p >@lang('lang.price'){{ $bottle->price }}</p>
            </div>
        </article>
    </section>
</main>
@endsection