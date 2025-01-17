@extends('layouts.app')
@section('title', 'Ajouter la bouteille')
@section('content')

<!-- <x-header 
    title="{{ __('lang.add_bottle') }}"
    subtitle="{{ __('lang.add_bottle_subtitle') }}"
/> -->
@if(!$errors->isEmpty())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>     
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>                
@endif
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
            <label for="quantity">@lang('lang.quantity')</label>
            <input type="number" name="quantity" id="" value="{{old('quantity', $quantity)}}">
            @if ($errors->has('quantity'))
                <div class="alert_msg">
                    {{$errors->first('quantity')}}
                </div>
            @endif
        </div>
        <div class="form-control">
            <label for="cellar_id">@lang('lang.cellar_choose')</label>
            <select name="cellar_id" id="cellar_id">
                <option value="">@lang('lang.choose_name')</option>
                @foreach (Auth::user()->cellars as $cellar)
                    <option value="{{ $cellar->id }}">{{ $cellar->title }}</option>
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