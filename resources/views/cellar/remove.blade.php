@extends('layouts.app')
@section('title', 'Retirer la bouteille')
@section('content')


<main class="flex-center">

    <section class="structure flex-col-center height80">   
    <form class="form" action="{{ route('cellar.removeBottle') }}" method="POST">
        @csrf
        <div class="form-title">
            <h2>{{ $bottle->title }}</h2>
            <!-- <p></p> -->
        </div>
        
        <div class="form-control">
            <label for="quantity">@lang('lang.quantity')</label>
            <input type="number" name="quantity" id="" value="{{ $cellar->quantity, old('quantity') }}">

            @if ($errors->has('quantity'))
                <div class="alert_msg">
                    {{$errors->first('quantity')}}
                </div>
            @endif
        </div>
        <div>
            <p>Quantité dans le cellier : {{ $cellar->quantity }}</p>
        </div>

        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">
        <input type="hidden" name="cellar_id" value="{{ $cellar->cellar_id}}">

        <button type="submit" class="btn-border">Retirer bouteille</button>
    </form>
    </section>
</main>
@endsection