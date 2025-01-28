@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')
@if(session('errors'))
    @if(session('errors')->has('password'))
        <div class="alert warning flex-center just-between">
        <p>Assurez vous d'avoir les bonnes informations du compte.</p>
            <button type="button" class="btn-close">X</button>
        </div>
    @endif
@endif
<main class="flex-center">
    <section class="structure flex-col-center height80">
    <form class="form" action="{{ route('cellar.storeBottle') }}" method="POST">
        @csrf
        <div class="form-title">
            <h2>{{ $bottle->title }}</h2>
        </div>
        <div class="form-control">
            <label for="quantity">@lang('lang.quantity')</label>
            <input type="number" name="quantity" id="" value="{{old('quantity')}}" min="1">
            @if ($errors->has('quantity'))
                <div class="alert_msg">
                    {{$errors->first('quantity')}}
                </div>
            @endif
        </div>
        <div class="form-control">

            <label for="cellar_id">Choisir le Cellier</label>
            <select name="cellar_id" id="cellar_id" required>

                @if (Auth::user()->cellars && Auth::user()->cellars->count())
                    @foreach (Auth::user()->cellars as $cellar)
                    
                        <option value="{{ $cellar->id }}"
                        @if($cellar->id == session('cellar_id')) selected 
                        @endif>{{ $cellar->title }}</option>
                    
                    @endforeach
                @else
                    <option value="" disabled>Aucun cellier disponible</option>
                @endif

            </select>
            @if ($errors->has('cellar_id'))
                <div class="alert_msg">
                    {{$errors->first('cellar_id')}}
                </div>
            @endif
        </div>

        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">

        <button type="submit" class="btn-border">@lang('lang.add_bottle')<i class="fa-solid fa-plus"></i></button>
    </form>


    </section>
</main>

@endsection
