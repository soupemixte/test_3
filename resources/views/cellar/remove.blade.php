@extends('layouts.app')
@section('title', 'Retirer la bouteille')
@section('content')


<main class="flex-center height60">

    <section class="structure flex-col gap10">
    <div class="section-title">
        <h2>Formulaire de retrait bouteille.</h2>
    </div>
    <div class="line"></div>   
    <form class="form" action="{{ route('cellar.removeBottle') }}" method="POST">
        @csrf
        <div class="form-title">
            <h2>{{ $bottle->title }}</h2>
            <!-- <p></p> -->
        </div>
        <div class="info-item mb-5">
            <span class="info-label">Collection : </span>
            <span class="info-value">{{ $cellar->quantity }}</span>
        </div>
        
        <div class="form-control">
            <label for="quantity">@lang('lang.quantity')</label>
            <input type="number" name="quantity" id="" value="{{ old('quantity') }}">

            @if ($errors->has('quantity'))
                <div class="alert_msg">
                    {{$errors->first('quantity')}}
                </div>
            @endif
        </div>
        @if (Auth::user()->cellars && Auth::user()->cellars->count() > 1)
        <div class="form-control">

            <label for="cellar_id">Déplacer vers :</label>
            <select name="cellar_id" id="cellar_id">
            @foreach (Auth::user()->cellars as $cellar)
            @if($cellar->id == session('cellar_id'))
            <option value="{{ $cellar->id }}">{{ $cellar->title}}</option>
            @endif
            @endforeach
            </select>
        </div>
        @endif
        
        <!-- <div>
            <p>Quantité dans le cellier : {{ $cellar->quantity }}</p>
        </div> -->

        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
        <input type="hidden" name="cellar_id" value="{{ $cellar->cellar_id}}">

        <button type="submit" class="btn-border btn-icon btn-remove flex-al just-between gap5">Retirer<i class="fa-solid fa-minus"></i></button>
    </form>
    </section>
</main>
@endsection