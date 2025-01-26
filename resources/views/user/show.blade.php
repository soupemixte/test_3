@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<!--
    TODO: UX/UI
    TODO: if cellars->isEmpty()
-->

<main class="flex-center heigth80">
    <section class="structure">
        <div class="info-details">
            <h3>@lang('lang.user_name') : {{ $user->name }}</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">@lang('lang.email') :</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">@lang('lang.created') :</span>
                    <span class="info-value">{{ $user->created_at }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Derniere mise a jour :</span>
                    <span class="info-value">{{ $user->updated_at }}</span>
                </div>
            </div>
            <div class="btn-container">
            <a href="{{ route('user.edit', $user->id) }}" class="btn-border">@lang('lang.edit')</a>
            <form action="{{ route('user.destroy', $user->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn-border">@lang('lang.delete')</button>
        </form>
            </div>
        </div>
        <section class="flex-col gap10">
        <!-- <p>ici</p> -->
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
        </section>
        @endforeach
    </section>
</main>

@endsection