@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')

<x-header 
    title="{{ __('lang.add_bottle') }}"
    subtitle="{{ __('lang.add_bottle_subtitle') }}"
/>
<main class="flex-center">
    <section class="structure flex-col-center height80">   
    <form class="form" action="{{ route('cellar.storeBottle') }}" method="POST">
        @csrf
        <!-- <div class="form-control">
            <label for="bottle_name">Nom de la Bouteille</label>
            <input type="text" name="bottle_name" value="{{ $bottle->title }}" readonly>
        </div> -->
        <div class="form-title">
            <h2>{{ $bottle->title }}</h2>
        </div>
        <div class="form-control">
            <label for="quantity">Quantité</label>
            <input type="number" name="quantity" id="" min="0">
            @if ($errors->has('quantity'))
                <div class="">
                    {{$errors->first('quantity')}}
                </div>
            @endif
        </div>
        <div class="form-control">
            <label for="cellar_id">Choisir le Cellier</label>
            <select name="cellar_id" id="cellar_id">
                <option value="">Choisir le Nom</option>
                @foreach (Auth::user()->cellars as $cellar)
                    <option value="{{ $cellar->id }}">{{ $cellar->title }}</option>
                @endforeach
            </select>
            @if ($errors->has('cellar_id'))
                <div class="">
                    {{$errors->first('cellar_id')}}
                </div>
            @endif
        </div>

        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">

        <button type="submit" class="btn-border">Ajouter la bouteille</button>
    </form>


    </section>
</main>

@endsection