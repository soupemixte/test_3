@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')

<!-- <x-header 
    image="{{ asset('img/header/cave.jpeg') }}" 
    title="Ajouter la bouteille" 
    subtitle="Votre collection est votre vie" 
/> -->

<main class="flex-center">
    <section class="structure flex-col-center height80">   
    <form class="form" action="{{ route('cellar.storeBottle') }}" method="POST">
        @csrf
        <div class="form-control">
            <label for="bottle_name">Nom de la Bouteille</label>
            <input type="text" name="bottle_name" value="{{ $bottle->title }}" readonly>
            @if ($errors->has('bottle_name'))
                <div class="error-message">
                    {{ $errors->first('bottle_name') }}
                </div>
            @endif
        </div>

        <div class="form-control">
            <label for="cellar_id">Choisir le Cellier</label>
            <select name="cellar_id" id="cellar_id" required>
                <option value="">Choisir le Nom</option>
                
                @if (Auth::user()->cellars && Auth::user()->cellars->count())
                    @foreach (Auth::user()->cellars as $cellar)
                        <option value="{{ $cellar->id }}">{{ $cellar->name }}</option>
                    @endforeach
                @else
                    <option value="" disabled>Aucun cellier disponible</option>
                @endif
            </select>
            @if ($errors->has('cellar_id'))
                <div class="error-message">
                    {{ $errors->first('cellar_id') }}
                </div>
            @endif
        </div>

        <button type="submit" class="btn-border">Ajouter la bouteille</button>
    </form>

    </section>
</main>

@endsection