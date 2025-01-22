@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')

<main class="flex-center">
    <section class="structure flex-col-center height80">   
    <form class="form" action="{{ route('cellar.storeBottle') }}" method="POST">
        @csrf
        <div class="form-title">
            <h2>{{ $bottle->title }}</h2>
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
        <div class="form-control">
            <label for="cellar_id">@lang('lang.cellar_choose')</label>
            <select name="cellar_id" id="cellar_id">
                <option value="{{ $first_cellar->id }}">{{ $first_cellar->title }}</option>
                @foreach (Auth::user()->cellars as $cellar)
                @if($cellar->id != $first_cellar->id)
                    <option value="{{ $cellar->id }}">{{ $cellar->title }}</option>
                @endif
                @endforeach
            </select>
            @if ($errors->has('cellar_id'))
                <div class="alert_msg">
                    {{$errors->first('cellar_id')}}
                </div>
            @endif
        </div>

        <input type="hidden" name="bottle_id" value="{{ $bottle->id }}">

        <button type="submit" class="btn-border">@lang('lang.add_bottle')</button>
    </form>


    </section>
</main>

@endsection