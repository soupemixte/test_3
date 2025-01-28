@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<!--
    TODO: UX/UI
    TODO: if cellars->isEmpty()
-->

<main class="flex-center heigth80">
    <section class="structure">
        <div class="info-details profile">
            <div class="info-grid mb-5">
                <div class="info-item">
                    <span class="info-label">@lang('lang.user_name') :</span>
                    <span class="info-value">{{ $user->name }}</span>
                </div>
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
            <div class="btn-container flex-center">
            <a href="{{ route('user.edit', $user->id) }}" class="btn-border btn-icon btn-edit">modifier<i class="fa-solid fa-pen-to-square"></i></a>
            
            </div>
        </div>
        <!-- cellars -->
        @if($cellars)
            <section class="flex-col gap10">
                @if($count)
                <div class="flex-center">
                    <h2>Nombres de Celliers : {{ $count }}</h2>
                </div>
                @endif
                <div class="info-details profile-cellar">
                @foreach ($cellars as $cellar)
                <div class="info-grid mb-5">
                    <div class="info-item">
                        <span class="info-label">Titre : </span>
                        <span class="info-value">{{ $cellar->title }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Description : </span>
                        <span class="info-value">{{ $cellar->description }}</span>
                    </div>
                    @if($total)
                    <div class="info-item">
                        <span class="info-label">Inventaire :</span>
                        <span class="info-value">{{ $total }}</span>                          
                    </div>
                    @endif
                </div>
                <div class="btn-container flex-center gap5">
                    <a href="{{ route('cellar.edit', $cellar->id) }}" class="btn-border btn-icon btn-edit">modifier<i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="{{ route('cellar.show', $cellar->id) }}" class="btn-border btn-icon btn-show">voir<i class="fa-solid fa-eye"></i></a>
                    
                </div> 
                @endforeach
                </div>
            @endif
        </section>
        
</section>
</main>

@endsection