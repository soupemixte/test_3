@extends('layouts.app')
@section('title', 'Cellars')
@section('content')
<main class="cellar"> 
    <section>
        <div class=""><a href="{{ route('cellar.create') }}" class="">@lang('lang.add_cellar')</a></div> 
        @if ($cellars->isEmpty())
            <p>@lang('lang.no_cellar)</p>
        @else
        @foreach ($cellars as $cellar)
            <article class="card_cellar">
                <div class="card-body"> 
                    <h2 class="card-title">
                        {{ $cellar->title }}
                    </h2>
                    <p class="card_description">{{ $cellar->description }}</p>
                </div>                
                <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-border">@lang('lang.view')</a>
            </article>
            @endforeach
        @endif
                
    </section>
</main>

@endsection