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
            <span class="details-price">@lang('lang.price') {{$bottle->price}}</span>
           
            <a href="{{ route('cellar.add', ['id' => $bottle->id]) }}" class="btn btn-border">@lang('lang.add_cellar')</a>
        </article>

        <div class="line"></div>

        <article class="info-details">
            <h3>@lang('lang.info')</h3>
            <div>
                            <p>{{ $bottle->region }}</p>
                            <p>{{ $bottle->degree_alcool }}</p>
                            <p>{{ $bottle->sugar_content }}</p>
                        </div>
                        <div>
                            <p>{{ $bottle->promoting_agent }}</p>
                            <p>{{ $bottle->producer }}</p>
                            <p>{{ $bottle->grape_variety }}</p>
                        </div>
                        <div class="price">
                            {{ $bottle->price }}
                        </div>
        </article>
    </section>
</main>

@endsection